<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\DebitPayment;

class DebitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $date = Carbon::instance($this->created_at)->toDateTimeString();
        $rd = Carbon::now()->diffInDays($this->timeToPay);
        $delayedDays = $this->created_at->diffInDays($this->timeToPay);

        return [
            "id"=> $this->id,
            "debitor" => $this->debitor,
            "phone" => $this->phone,
            "amount"=> $this->amount,
            "timeToPay" => $this->timeToPay,
            "user"=> $this->user->name,
            "date"=> $date,
            "remainingDays"=> ( $rd <=0) ? $rd." Days":'Already Delayed to Pay '.$delayedDays.' Days',
            "payedAmount"=> DebitPayment::where('debit_id', $this->id)->sum('amount')

        ];
    }
}
