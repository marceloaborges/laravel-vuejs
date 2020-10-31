<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name'           => "required|min:5|max:60|unique:roles,name,{$id},id",
            'description'    => "required|min:10|max:200",
        ];
    }

    public function messages()
    {

        return [
            'name.required'         => 'O campo nome é de preenchimento obrigatório',
            'name.unique'           => 'O nome escolhido já esta em uso',
            'name.min'              => 'O campo nome deve conter no mínimo 5 caractéres',
            'name.max'              => 'O campo nome deve conter no máximo 60 caractéres',
            'description.required'  => 'O campo descrição é de preenchimento obrigatório',
            'description.min'       => 'O campo descrição deve conter no mínimo 10 caractéres',
            'description.max'       => 'O campo descrição deve conter no máximo 200 caractéres',
        ];

    }
}
