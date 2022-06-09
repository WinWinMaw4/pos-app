<?php

namespace App\Http\Controllers;

use App\Models\DailyVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboardView(){
        $dailyVouchers = DailyVoucher::whereMonth('date',Carbon::now()->month)->get();
        return view('dashboard',[
            "dailyVouchers"=>$dailyVouchers
        ]);
    }


}
