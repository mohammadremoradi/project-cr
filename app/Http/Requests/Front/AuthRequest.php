<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'identity' => 'required|max:64|regex:/^[a-zA-Z0-9_.@\+]*$/',
        ];
    }


    public function attributes()
    {
        return [
            'identity' => 'email or phone'
        ];
    }
}
