<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditPayment extends Model
{
    protected $guarded = [];

    public function credits() {
        return $this->belongsTo(Credit::class);
    }
    
    
}
