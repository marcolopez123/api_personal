<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
            'username'=>'required',
            'password'=>'required',
        ];
    }
    public function messages()

    {
        return [
            'username.required'=>'El usuario obligatorio',
            'password.required'=>'La contraseña es obligatorio',
        ];
    }
}
