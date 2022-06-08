<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DailyVoucher;
use App\Models\Item;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherList;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=>"SaYarGyi",
            "email"=>"sayargyi@gmail.com",
            "password"=>Hash::make('password')
        ]);
        User::create([
            "name"=>"WinWinMaw",
            "email"=>"wwm@gmail.com",
            "password"=>Hash::make('password')
        ]);

        Category::create([
            "name"=>"Men",
            "user_id"=> 2,
        ]);
        Category::create([
            "name"=>"Woman",
            "user_id"=> 2,
        ]);
        Category::create([
            "name"=>"Child",
            "user_id"=> 2,
        ]);
        Category::create([
            "name"=>"jewelery",
            "user_id"=> 2,
        ]);
        Category::create([
            "name"=>"Shoe",
            "user_id"=> 2,
        ]);


        $items = \Illuminate\Support\Facades\Http::get("https://fakestoreapi.com/products")->object();
        foreach ($items as $item){
            Item::factory()->create([
                "name"=>$item->title,
                "price"=>$item->price,
                "photo" => $item->image,
                "description"=>Str::limit($item->description,20),
                "category_id"=>rand(1,5),
            ]);
        }


        $period = CarbonPeriod::create('2022-06-1', '2022-06-8');


        foreach ($period as $date){
            $dailyVoucher = new DailyVoucher();
            $dailyVoucher->date = $date->format('Y-m-d');
//            $dailyVoucher->total_voucher = rand(1,15);
            $dailyVoucher->save();
            $dailyVoucherCount = 0;
            $dailyVoucherTotalPrice = 0;

            for($v=1;$v<rand(10,20);$v++){
                $dailyVoucherCount ++;
                $voucher = new Voucher();
                $voucher->date = $date->format('Y-m-d');
                $voucher->customer_name = 'Customer'.Str::random(4);
                $voucher->invoice_number = uniqid();
                $voucher->save();

                $totalItem = 0;
                $totalCost = 0;

                for($i=1;$i<rand(5,15);$i++){
                    $item = Item::where("id",rand(1,20))->first();
                    $totalItem ++ ;
                    $quantity = rand(1,15);
                    $cost =$item->price * $quantity;
                    $totalCost += $cost;
                    VoucherList::factory()->create([
                        "voucher_id"=>$voucher->id,
                        "item_id"=>$item->id,
                        "item_name"=>$item->name,
                        "quantity"=>$quantity,
                        "unit_price"=>$item->price,
                        "cost"=>$cost,
                        "date"=>$date->format('Y-m-d'),
                    ]);
                }

                $voucher->update([
                   "total_price" => $totalCost,
                    "total_item" => $totalItem,
                ]);

                $dailyVoucherTotalPrice += $totalCost;

            }

            $dailyVoucher->update([
                "total_price" => $dailyVoucherTotalPrice,
                "total_voucher"=>$dailyVoucherCount

            ]);


        }





        \App\Models\User::factory(10)->create();
//        Category::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
