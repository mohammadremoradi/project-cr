<?php

namespace App\Http\Requests\admin\client;

// use App\Enums\FileType;

use App\Enums\FileType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use BenSampo\Enum\Rules\EnumValue;

class ConsumerFileRequest extends FormRequest
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
        if ($this->isMethod('post')) {

            return [
                'file' => 'required|mimes:png,jpg,jpeg,gif,zip,pdf,docx,doc',
                'type' => ['required', new EnumValue(FileType::class)],
            ];
        } else {
            return [
                'activation' => 'in:1,2',
            ];
        }
    }
}
