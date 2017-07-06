<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'=>'required',
            'image'=>'required|image',
            'phone'=>'required',
            'birthday'=>'required|date'
        ];

        if ($this->has('email')){
            $rules['email'] = 'email|unique:contacts,email';
        }

        return $rules;
    }
}
