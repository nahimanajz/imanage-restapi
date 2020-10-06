<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
        return [
            "id"=>$this->id,
            "creditor" => $this->creditor,
            "phone" => $this->phone,
            "amount"=> $this->amount,
            "timeToPay" => $this->timeToPay,
            "user"=> $this->user->name,
            "date"=>$creationDate,
            "remaining days to pay"=> Carbon::now()->diffInDays($paymentDate)
        ];
    }
}
