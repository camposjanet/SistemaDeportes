<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'apellido'=>'required|regex:/^[\pL\s\-]+$/u',
            'nombre'=>'required|regex:/^[\pL\s\-]+$/u',
            'dni'=>'required|numeric|unique:usuarios',
            'fecha_de_nacimiento'=>'date|required|before:tomorrow',
            'domicilio'=>'required',
            'telefono_celular'=>'required|max:45',
            'id_linea_telefono'=>'required',
            'telefono_de_emergencia'=>'required|max:45',
            'id_linea_telefono_emergencia'=>'required',
            'email'=>'email|max:100',
            'foto' => 'required'
        ];
    }
}
