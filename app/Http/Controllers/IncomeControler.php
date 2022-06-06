<?php

namespace App\Http\Controllers;

use App\Models\DailyTotalIncome;
use App\Models\Voucher;
use App\Models\VoucherList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use function PHPUnit\Framework\isNull;

class IncomeControler extends Controller
{
    public function toDayInCome(){
        $vouchers = Voucher::latest('id')->whereDate('created_at',Carbon::today())->paginate(20);
        return view('income.toDayInCome',[
            'vouchers'=>$vouchers,
        ]);
    }
    public function dailyInCome(){
        $vouchers = DailyTotalIncome::latest('id')->whereMonth('created_at',Carbon::now()->month)->paginate(20);
        return view('income.currentMonthInCome',[
            'vouchers'=>$vouchers
        ]);
    }

    public function totalToday(Request $request){
        $todayTotal = new DailyTotalIncome();

        $shital = DailyTotalIncome::whereDate('date', $request->date)->first();
       if($shital){
           //           $todayTotal->date = $request->date;
           $todayTotal = DailyTotalIncome::findOrFail($shital->id);
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