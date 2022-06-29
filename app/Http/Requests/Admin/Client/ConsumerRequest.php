<?php

namespace App\Http\Requests\Admin\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ConsumerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->is_admin == 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'passport' => 'nullable|min:5|max:20|unique:consumers,passport',
            'email' => 'nullable|email|unique:users,email',
            'user_id' => 'exists:users,id',
            'phone' => 'min:2|max:19|unique:users,phone,except,id',
            'name' => 'max:50|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            // 'status_id' => 'exists:consumer_statuses,id',
            // 'client_id' => 'exists:first_clients,id',
        ];
    }
}
