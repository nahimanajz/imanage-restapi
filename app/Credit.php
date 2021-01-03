<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function creditPayments() {
        return $this->hasMany(CreditPayment::class);
    }
    
}
