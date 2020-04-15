<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Position extends FormRequest
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
            //Establecemos el campo name como obligatorio
            //validación desde el servidor
            'name' => 'required'
        ];
    }
}
