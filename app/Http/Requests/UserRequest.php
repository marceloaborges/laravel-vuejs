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

        // Pega o id do item, sendo permitindo criar uma regra de exceção e comparação do id a ser editado
        $id = $this->segment(3);

        return [
            'name'      => "required | min:10 | max:100 | unique:users,name,{$id},id",
            'email'     => "required | email | min:10 | max:255 | unique:users,email,{$id},id",
            'password'  => 'required | min:8',
            'password2' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'O campo nome é de preenchimento obrigatório',
            'name.min'              => 'O campo nome deve conter no mínimo 8 caracteres',
            'password.required'     => 'O campo senha é de preenchimento obrigatório',
            'password.min'          => 'O campo senha deve deve conter no mínimo 10 caracteres',
            'password2.required'    => 'O campo confirmar senha é de preenchimento obrigatório',
            'password2.same'        => 'O campo confirmar não confere',
        ];
    }
}