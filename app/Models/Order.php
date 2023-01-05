<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    protected $appends = ['total_payments'];

    protected $casts = [
        'order_datetime' => 'datetime:Y-m-d H:i'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }

    public function first_voucher()
    {
        return $this->hasOne(Voucher::class)->oldest();
    }

    public function getTotalPaymentsAttribute()
    {
        return $this->payments->sum('amount');
    }
}
