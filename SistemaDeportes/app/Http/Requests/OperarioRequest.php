<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperarioRequest extends FormRequest
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
            'name'=>'required | alpha ',
			'email'=>'email | required |unique:users,email',
			'password'=> 'required_with:password_confirmation | confirmed | string | min:6',
			'role_id'=>'required',
			'nombre_rol'=> 'required',

        ];
    }

	public function messages()
	{
		return [
			'name.required'=> 'El Usuario es un campo obligatorio',
			'name.alpha'=> 'El Usuario no puede contener espacios, ni números o carácteres especiales',
			'email.required'=> 'El Correo es un campo obligatorio',
			'email.email'=> 'El Correo debe contener formato ejemplo@dominio.com',
			'password.required'=> 'La Contraseña es una campo obligatorio',
			'password.min'=> 'La Contraseña debe contener por lo menos 6 carácteres',
			'nombre_rol'=> 'El Rol de Personal es un campo obligatorio',
			'role_id'=> 'El Rol de Personal es un campo obligatorio'
		];
	}
}
