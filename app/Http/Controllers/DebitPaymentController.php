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

        $currentPayment = DebitPayment::where('debit_id', $data['debit_id'])->sum('amount'); 
        $debit = Debit::findOrFail($data['debit_id'])->amount;
        $response = [
            "status"=> 201, 
            "amount"=>(int)$data['amount'],
            "currentPayment" => $currentPayment,
            "debit" => $debit,
            "message"=>"Payment was made"
        ];
        
        if($debit < $data['amount']){
            $response['message'] ='You\'re Trying to pay money beyond your debit';
            $response['status']= 400;            
        } else if($currentPayment == $debit){
            $response['message'] = 'Payment is already made';
            $response['status']= 400;            
        }else {
            DebitPayment::create($data);
        }
        return response()->json($response);

    }
 
}
