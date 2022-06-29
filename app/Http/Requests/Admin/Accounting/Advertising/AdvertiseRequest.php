<?php

namespace App\Http\Requests\Admin\Accounting\Advertising;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdvertiseRequest extends FormRequest
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
            'price' => 'required|numeric',
            'receipt' => 'nullable|mimes:png,jpg,jpeg,gif,zip,pdf,docx,doc',
            'sourse_id' => 'exists:sourses,id',
            'user_id' => 'exists:users,id',
            'published_at' => 'required|numeric',
            'statistics' => 'numeric',
        ];
    }
}
