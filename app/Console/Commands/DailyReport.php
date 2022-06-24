<?php

namespace App\Console\Commands;

use App\Models\DailyVoucher;
use Illuminate\Console\Command;

class DailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Daily Report';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $todayTotal = new DailyVoucher();
        $totalVoucher = count(\App\Models\Voucher::whereDate('date',today())->get());
        $totalPrice = \App\Models\VoucherList::whereDate('date',\Illuminate\Support\Carbon::today() )->sum('cost');

        $shital = DailyVoucher::whereDate('date', today())->first();
        if($shital){
            $todayTotal = DailyVoucher::findOrFail($shital->id);
            $todayTotal->total_voucher = $totalVoucher;
            $todayTotal->total_price = $totalPrice;
            $todayTotal->update();
        }else{
            $todayTotal->date = today();
            $todayTotal->total_voucher = $totalVoucher;
            $todayTotal->total_price = $totalPrice;
            $todayTotal->save();
        }
        return 0;
    }
}
