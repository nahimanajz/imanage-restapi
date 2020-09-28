<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class SignupRequest extends FormRequest
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
            "name" => "required",
            "email" => "required|email|unique:users",
            "phone" => "required|unique:users",
            "balance" => "integer",
            "password" => "min:6|required_with:password_confirmation|same:password_confirmation|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/",
            "password_confirmation"=> "required|min:6"
        ];
    }
    public function messages() {
        return [
            "name.required" => "you need to register you name",
            "email.unique" => "Please try another email",
            "phone.required" => "you need to enter your phone number",
            "password.regex" => "you need to enter strong password"
        ];
    }
    public function failedValidation(Validator $validator)  {
     throw new HttpResponseException(response()->json(['message' => $validator->errors()->all()]));
    
    }
    
}
