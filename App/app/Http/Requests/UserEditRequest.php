<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserEditRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "fullname"=>['required'],
            "phone" => ['required'],
//            "password" => ['required', Password::min(4)],
            "role"=>['required'],
            "karcher_id"=>['required'],
        ];// need add password ->[]
    }
}
