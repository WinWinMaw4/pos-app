<?php

namespace App\Http\Controllers;

use App\Models\DailyTotalIncome;
use App\Models\Item;
use App\Models\Voucher;
use App\Models\VoucherList;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
    //
    public function voucherDetail($voucherId){

        $voucher = Voucher::where('id',$voucherId)->get();
        $voucherLists= VoucherList::where('voucher_id',$voucherId)->paginate(10);
        return view('income.voucherDetail',[
            'voucher'=>$voucher,
            'voucherLists'=>$voucherLists,
        ]);
    }
    public function voucherListDaily($voucherDate){
        $vouchers = Voucher::whereDate('created_at', $voucherDate)->paginate(10);
        return view('income.inComeWithDate',[
            'vouchers'=>$vouchers
        ]);

    }

    public function storeVoucher(Request $request){

        DB::beginTransaction();
        try{

            $voucher = new Voucher();
            $uniqid = Str::random(4);
            $voucher->date = Carbon::today()->format('Y-m-d');
            $voucher->customer_name = $request->customer_name.$uniqid;
            $voucher->invoice_number = $request->invoice_number;
            $voucher->total_price = 0;
            $voucher->save();
            $countTotalId =0;
            foreach ($request->voucher_list as $list){
                $item = Item::find($list['product_id']);
                    $countTotalId ++;
                $voucherList = new VoucherList();
                $voucherList->voucher_id = $voucher->id;
                $voucherList->item_id = $list['product_id'];
                $voucherList->quantity = $list['quantity'];
                $voucherList->item_name = $item->name;
                $voucherList->unit_price = $item->price;
                $voucherList->cost = $list['quantity'] * $item->price;
                $voucherList->date = Carbon::today()->format('Y-m-d');
                $voucherList->save();

            }

            $total = VoucherList::where('voucher_id',$voucher->id)->sum('cost');
            $voucher->total_item = $countTotalId;
            $voucher->total_price =$total;
            $voucher->update();

            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            throw $e;

        }

        return response()->json($voucher);
//        return response()->json([
////            "status" => 200,
////            "data"=>['message' => 'New Voucher created','total'=>$total],
//        ]);
    }

}
