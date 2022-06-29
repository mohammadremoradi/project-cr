<?php

namespace App\Http\Requests\Admin\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ClientRequest extends FormRequest
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
            'fullname' => 'nullable|max:50|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'age' => 'nullable|max:20|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'degree' => 'nullable|max:50|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'date_degree' => 'nullable|max:50|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'language' => 'nullable|max:50|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'job' => 'nullable|max:100|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'money' => 'nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'phone' => 'nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌+, ]+$/u',
            'material' => "in:single,married",
            'age_wife' => 'nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'wife_degree' => 'nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'wife_date_degree' => 'nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'number_children' => 'nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'child1' => 'nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'child2' => 'nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'child3' => 'nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'child4' => 'nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'child5' => 'nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'child6' => 'nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'about_us' => 'nullable|max:200|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'discription' => 'max:5000|min:5|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u',
            'cansultant_name' => 'max:100|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',
            'course_id' => 'exists:courses,id',
            'published_at' => 'numeric',
            'status' => 'in:consulting,done,cancel',
            'intrest' => 'in:0%,50%,75%',
            'hours' =>'nullable|between:0,100|integer',
            'user_id' => 'exists:users,id',
            'tag_id' => 'exists:tags,id',
            'response' => 'max:200|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.‌, ]+$/u',

            'search' => 'max:500|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u',

        ];
    }
}
