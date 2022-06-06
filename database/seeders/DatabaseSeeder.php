<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        User::create([
//            "name"=>"SaYarGyi",
//            "email"=>"sayargyi@gmail.com",
//            "password"=>Hash::make('password')
//        ]);
//        User::create([
//            "name"=>"WinWinMaw",
//            "email"=>"wwm@gmail.com",
//            "password"=>Hash::make('password')
//        ]);

        Category::created([
            "name"=>"Fast Food",
            "user_id"=> 2,
        ]);
        Category::created([
            "name"=>"Coffee",
            "user_id"=> 2,
        ]);
        Category::created([
            "name"=>"Drink",
            "user_id"=> 2,
        ]);
        Category::created([
            "name"=>"Cake",
            "user_id"=> 2,
        ]);
        Category::created([
            "name"=>"Bread",
            "user_id"=> 2,
        ]);

        \App\Models\User::factory(10)->create();
//        Category::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
