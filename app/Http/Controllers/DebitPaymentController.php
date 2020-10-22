<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DebitPayment;
use App\Debit;
use App\Http\Requests\DebitPaymentRequest;

class DebitPaymentController extends Controller
{
    public function store(DebitPaymentRequest $req) {

        $data = $req->validated();
        $currentPayment = DebitPayment::findOrFail($data['Debit_id'])->sum('amount'); 
        $Debit = Debit::findOrFail($data['Debit_id'])->amount;
        
        if($Debit >= $data['amount'] && $currentPayment< $Debit){
            DebitPayment::create($data);
            return response()->json([
                "status"=>203,
                "message"=>"You have paid ".$data['amount'],
                "currentPayment"=>$currentPayment-$data['amount'],
                "currentDebit"=>$Debit
               ]);
        } else {
            return response()->json([
                "status"=>400,
                "message"=>"You should not pay amount beyond the Debit ",
                "currentPayment"=>$currentPayment,
                "currentDebit"=>$Debit
               ]);
        }
    }
}
