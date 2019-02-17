<?php

namespace SisServicios\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InscripcionFormRequest extends FormRequest
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
            'id_estudiante'     =>'required|max:100',
            'id_año_escolar'    =>'required|max:100',
            'id_nivel'          =>'required|max:100',
            'fecha_inscripcion' =>'required|date',
            'monto'             =>'required|max:100',
            'descuento'         =>'max:100'
        ];
    }
}
