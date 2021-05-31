<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUsuarioRequest extends FormRequest
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
            'apellido'=>'required',
            'nombre'=>'required',
            'dni'=>'required',
            'fecha_de_nacimiento'=>'required',
            'domicilio'=>'required',
            'telefono_celular'=>'required',
            'id_linea_telefono'=>'required',
            'telefono_de_emergencia'=>'required',
            'id_linea_telefono_emergencia'=>'required',
            'email'=>'required'
        ];
    }
}
