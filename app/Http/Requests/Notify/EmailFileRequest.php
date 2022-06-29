<?php

namespace App\Http\Requests\Notify;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EmailFileRequest extends FormRequest
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
        if($this->isMethod('post')){
            return [
                'file' => 'required|mimes:png,jpg,jpeg,gif,zip,pdf,docx,doc',
            ];
        }
        else{
            return [
                'file' => 'mimes:png,jpg,jpeg,gif,zip,pdf,docx,doc',
            ];
        }
    }
}
