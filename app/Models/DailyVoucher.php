<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyVoucher extends Model
{
    use HasFactory;

    public function vouchers(){
        return $this->hasMany(VoucherList::class,'voucher_id');
    }
}
