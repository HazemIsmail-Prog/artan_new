<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Voucher extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function voucher_details()
    {
        return $this->hasMany(VoucherDetail::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}
