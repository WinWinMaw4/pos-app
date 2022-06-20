<?php

namespace App\Http\Controllers;

use App\Models\DailyTotalIncome;
use App\Models\DailyVoucher;
use App\Models\MonthlyIncome;
use App\Models\Voucher;
use App\Models\VoucherList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use function PHPUnit\Framework\isNull;

class IncomeController extends Controller
{

    public function allInComeVouchers(){
        $vouchers = Voucher::orderBy('id','desc')->get();
        return view('income.allList',[
            'vouchers'=>$vouchers
        ]);

    }
    public function toDayInCome(){
        $vouchers = Voucher::latest('id')->whereDate('date',Carbon::today())->get();

        return view('income.toDayInCome',[
            'vouchers'=>$vouchers,
        ]);
    }

    public function dailyInCome(){
        $vouchers = DailyVoucher::latest('id')->whereMonth('date',Carbon::now()->month)->get();
        return view('income.dailyInCome',[
            'vouchers'=>$vouchers
        ]);
    }
    public function monthlyInCome(){
        $monthlyIncome = MonthlyIncome::latest('id')->whereYear('date',Carbon::now()->year)->get();
        return view('income.monthlyIncome',[
            'monthlyInCome'=>$monthlyIncome
        ]);
    }

    public function totalToday(Request $request){
        $todayTotal = new DailyVoucher();

        $shital = DailyVoucher::whereDate('date', $request->date)->first();
       if($shital){
           //           $todayTotal->date = $request->date;
           $todayTotal = DailyVoucher::findOrFail($shital->id);
           $todayTotal->total_voucher = $request->total_voucher;
           $todayTotal->total_price = $request->total_price;
           $todayTotal->update();
           return redirect()->back()->with('status',' we updated');
       }else{

           $todayTotal->date = today();
           $todayTotal->total_voucher = $request->total_voucher;
           $todayTotal->total_price = $request->total_price;
           $todayTotal->save();
           return redirect()->back()->with('status',' we added');
       }
        return $request;


    }

    public function totalMonthly(Request $request){
        $monthlyIncome = new MonthlyIncome();
        $shital = MonthlyIncome::whereMonth('date', Carbon::now()->month)->first();
        if($shital){
            //           $monthlyIncome->date = $request->date;
            $monthlyIncome = MonthlyIncome::findOrFail($shital->id);
            $monthlyIncome->total_day = $request->total_voucher;
            $monthlyIncome->total_price = $request->total_price;
            $monthlyIncome->update();
            return redirect()->back()->with('status',' we updated');
        }else{
            $monthlyIncome->date = today();
            $monthlyIncome->total_day = $request->total_voucher;
            $monthlyIncome->total_price = $request->total_price;
            $monthlyIncome->save();
            return redirect()->back()->with('status',' we added');
        }
        return $request;


    }

}


