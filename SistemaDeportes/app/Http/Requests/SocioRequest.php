<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocioRequest extends FormRequest
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
            'nombre_apellido'=>'required',
            'dni'=>'required|max:9|unique:socios',
            'fecha_de_nacimiento'=>'date|required|before:tomorrow',
            'id_tipo_socio'=>'required',
            'domicilio'=>'required',
            'telefono_celular'=>'required|max:45',
            'telefono_de_emergencia'=>'required|max:45',
            'email'=>'email|max:100',
            'estado'=>'required',
            'foto' => 'required'
        ];
    }
}
