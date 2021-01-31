<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CreditPayment;
use App\Credit;
use App\Http\Requests\CreditPaymentRequest;

class CreditPaymentController extends Controller
{
    public function store(CreditPaymentRequest $req) {

        $data = $req->validated();
        $currentPayment = CreditPayment::where('credit_id', $data['credit_id'])->sum('amount'); 
        $credit = Credit::findOrFail($data['credit_id'])->amount;
        
        if($credit >= $data['amount'] && $currentPayment< $credit){
            CreditPayment::create($data);
            return response()->json([
                "status"=>203,
                "message"=>"You have paid ".$data['amount'],
                "currentPayment"=>$currentPayment+$data['amount'],
                "currentCredit"=>$credit
               ]);
        } else {
            return response()->json([
                "status"=>400,
                "message"=>"You should not pay amount beyond the credit ",
                "currentPayment"=>$currentPayment,
                "currentCredit"=>$credit
               ]);
        }
    }
}
