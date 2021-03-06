<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UserRequestRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return [
            "name" => "required",
            "email" => "required|unique:users",
            "phone" => "required|unique:users",
            "balance" => "integer",
            "password" => "required|min:6"
        ];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute validation error message.';
    }
}
