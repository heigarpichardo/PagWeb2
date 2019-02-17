<?php

namespace SisServicios\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CobrosFormRequest extends FormRequest
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
            /*'id_cuotas'=>'required|max:100',
            'monto'=>'required|max:100',
            'fecha'=>'required|date',
            'id_empleado'=>'required|max:100',
            'comentario'=>'required|max:100'*/
        ];
    }
}
