<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            "id"=> $this->id,
            "category" => $this->category,
            "description"=> $this->description,
            "amount" =>$this->amount,
            "user"=> $this->user->name,
            "date" => $this->created_at
        ];
    }
}
