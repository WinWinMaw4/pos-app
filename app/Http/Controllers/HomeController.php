<?php

namespace App\Http\Controllers;

use App\Models\DailyVoucher;
use App\Models\Item;
use App\Models\MonthlyIncome;
use App\Models\Voucher;
use App\Models\VoucherList;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

        $dailyVouchers = DailyVoucher::where('date','>=',Carbon::now()->subdays(15))->get();
        $todayVouchers = Voucher::whereDate('date',Carbon::now()->today())->get();
        $weeklyVouchers = DailyVoucher::whereDate('date',Carbon::now()->subdays(7))->get();
//        $weeklyVouchers = DailyVoucher::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $Day = DailyVoucher::where('date','>=',Carbon::now()->subdays(7))->get();
        $voucherLists = VoucherList::whereDate('date',Carbon::now()->today())->get();
        $monthlyInCome = MonthlyIncome::whereYear('date',Carbon::now()->year)->get();
        //total sale item
//        $result = Item::addSelect([
//            'total_sales' => VoucherList::whereColumn('item_id','Items.id')
//            ->selectRaw('sum(quantity) as total_sales')
//        ])->orderBy('total_sales','desc')->take(3)->get();
//        $dailyVouchers = Voucher::addSelect([
//            'total_daily_vouchers'=> VoucherList::whereColumn('voucher_id','Vouchers.id')
//            ->whereMonth('date',Carbon::now()->month)
//            ->selectRaw('count(voucher_id) as total_daily_vouchers')
//        ])->get();

        $today_popular_item = Item::addSelect([
            'total_sales' => VoucherList::whereColumn('item_id','Items.id')
                ->whereDate('date',today())
                ->selectRaw('sum(quantity) as total_sales')
        ])->orderBy('total_sales','desc')->take(8)->get();

        $total_sale = VoucherList::whereDate('date',today())->sum('quantity');
        return view('dashboard',[
            "dailyVouchers"=>$dailyVouchers,
            "todayVouchers"=>$todayVouchers,
            "weeklyVouchers"=>$weeklyVouchers,
            "monthlyInCome"=>$monthlyInCome,
            "voucherLists"=>$voucherLists,
            'today_popular_item'=>$today_popular_item,
            'total_sale'=>$total_sale,
            'Day'=>$Day
        ]);
    }



}
