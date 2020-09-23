<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap= 'users';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     * 
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'email' => $this->email,
            'name'=> $this->name,
            'phone'=> $this->phone,
            'balance'=> $this->balance,
            
        ];
    }
    public function with($request) {
        return [
            "version"=>"1.0.0",
            "developer_url"=> url("https://janvierdev.netlify.app")
        ];
    }
}
