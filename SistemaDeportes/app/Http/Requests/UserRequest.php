<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

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
			'password'=> 'required_with:password_confirmation | confirmed | string | min:6',
			'current_password'=> 'required',
			'role_id'=> 'required',
			'nombre_rol'=> 'required',
			
        ];
    }

	public function verifica_password($validator){
		$validator->after(function($validator){
			if(!Hash::check($this->current_password, $this->user()->password)){
				$validator->errors()->add('current_password','Las contraseñas no son las mismas');
			}
		});
		return;	
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
			'nombre_rol'=> 'El Rol de Usuario es un campo obligatorio'
		];
	}
}
