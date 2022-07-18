<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function categories(){
        return $this->belongsTo(Category::class);
    }
    public function voucherList(){
        return $this->hasMany(VoucherList::class);
    }
}
