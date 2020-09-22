<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            "category"=> "required|string",
            "description" => "string",
            "amount" => "required|numeric",
            "user_id"=> "required|exists:users,id"
        ];
    }
    public function messages() {
        return [
            "user_id.exists"=> " Not an existing user id"
        ];
    }
}
