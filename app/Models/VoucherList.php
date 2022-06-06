<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherList extends Model
{
    use HasFactory;
    public function items(){
        return $this->belongsTo(Item::class,'item_id');
    }
}
