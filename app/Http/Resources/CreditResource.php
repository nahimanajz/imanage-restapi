<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            "creditor" => $this->creditor,
            "phone" => $this->phone,
            "amount"=> $this->amount,
            "timeToPay" => $this->timeToPay,
            "user"=> $this->user->name,
            "date"=> $this->created_at
        ];
    }
}
