<?php

namespace App\Http\Controllers;

use App\Models\DailyTotalIncome;
use App\Models\DailyVoucher;
use App\Models\Voucher;
use App\Models\VoucherList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use function PHPUnit\Framework\isNull;

class IncomeControler extends Controller
{

    public function allInComeVouchers(){
        $vouchers = Voucher::latest('id')->paginate(10);
        return view('income.allList',[
            'vouchers'=>$vouchers
        ]);

    }
    public function toDayInCome(){
        $vouchers = Voucher::latest('id')->whereDate('date',Carbon::today())->paginate(10);
        return view('income.toDayInCome',[
            'vouchers'=>$vouchers,
        ]);
    }

    public function dailyInCome(){
        $vouchers = DailyVoucher::latest('id')->whereMonth('date',Carbon::now()->month)->paginate(10);
        return view('income.dailyInCome',[
            'vouchers'=>$vouchers
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


}
