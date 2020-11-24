<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'oldpassword'=>'required|current_password| string |min:6',
            'newpassword'=> 'required|required_with:newpassword_confirmation|confirmed|min:6',
            
        ];
    }

    public function sanitize(){

        return $this->only('new_password');
    }
}
