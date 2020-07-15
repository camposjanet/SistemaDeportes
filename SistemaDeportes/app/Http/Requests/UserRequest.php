<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>'required | alpha',
			'email'=>'email | required',
			'password'=> 'required | string | min:6',
			'nombre_rol'=> 'requerid'
			
        ];
    }
	
	public function messages()
	{
		return [
			'name.required'=> 'El :attribute es un campo obligatorio',
			'name.alpha'=> 'El :attribute no puede contener espacios, ni números o carácteres especiales',
			'email.required'=> 'El :attribute es un campo obligatorio',
			'email.email'=> 'El :attribute debe contener formato ejemplo@dominio.com',
			'password.required'=> 'La :attribute es una campo obligatorio',
			'password.min'=> 'La :attribute debe contener por lo menos 6 carácteres'
		];
	}

	public function attributes()
	{
		'name'=> 'Nombre de Usuario',
		'email'=> 'Correo',
		'password'=> 'Contraseña'

	}
}
