<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCreditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "creditor"=> "required|string",
            "phone"=>"required|string",
            "amount"=>"required|integer",
            "timeToPay"=>"required|date_format:Y-m-d H:i:s|after:yesterday",
            "user_id" => "required|exists:users,id"
        ];
    }
    public function messages() {
        return [
            "creditor.required"=> "You need to write names someone who gave you this money",
            "phone.required"=>"Please write his phone number",
            "amount.required"=> "Write the money your debitor gave you",
            "timeToPay.after"=>"Do not write past date"
        ];
    }
    public function failedValidation(Validator $validator)  {
        throw new HttpResponseException(response()->json(['message' => $validator->errors()->all(),"error"=>true]));
       
    }
    
}
