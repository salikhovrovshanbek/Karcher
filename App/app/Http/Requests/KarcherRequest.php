<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KarcherRequest extends FormRequest
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
            'name'=>['required|string'],
            'longitude'=>['required'],
            'latitude'=>['required'],
            'address'=>['required'],
            'director'=>['required'],
            'phone'=>['required'],
            'countPersons'=>['required'],
        ];
    }
}
