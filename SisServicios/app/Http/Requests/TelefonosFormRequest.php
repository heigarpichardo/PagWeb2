<?php

namespace SisServicios\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TelefonosFormRequest extends FormRequest
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
            'tipo_telefono' =>'required',
            'descripcion' =>'required|max:100' 
        ];
    }
}
