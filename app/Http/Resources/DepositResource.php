<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class DepositResource extends JsonResource
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
            "deposit_id" => $this->id,
            "amount" => $this->amount,
            "deposited_date"=> Carbon::instance($this->created_at)->toDateString()

        ];
    }
}
