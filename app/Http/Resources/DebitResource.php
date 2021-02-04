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
            "amount"=> $this->amount." Rwf",
            "timeToPay" => date('D M Y', strtotime($this->timeToPay)),
            "user"=> $this->user->name,
            "date"=> $this->created_at->isoFormat("dddd DD YYYY"),
            "remainingDays"=> ( $rd >=0) ? $rd." Days Remaining":'Already Delayed to Pay '.$delayedDays.' Days',
            "payedAmount"=> DebitPayment::where('debit_id', $this->id)->sum('amount')

        ];
    }
}
