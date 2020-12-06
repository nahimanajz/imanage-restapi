<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\CreditPayment;


class CreditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $creationDate = Carbon::instance($this->created_at)->toDateTimeString();
        $rd = Carbon::now()->diffInDays($this->timeToPay);
        $delayedDays = $this->created_at->diffInDays($this->timeToPay);
               
        return [
            "id"=>$this->id,
            "creditor" => $this->creditor,
            "phone" => $this->phone,
            "amount"=> $this->amount,
            "timeToPay" => $this->timeToPay,
            "user"=> $this->user->name,
            "date"=>$creationDate,
            "remainingDays"=> ( $rd >=0) ? $rd." Days":'Already Delayed to Pay '.$delayedDays.' Days',
            "payedAmount"=> CreditPayment::where('credit_id', $this->id)->sum('amount') 
            
            

        ];
    }
}
