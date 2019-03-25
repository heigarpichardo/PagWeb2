<?php

namespace SisServicios\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComprobantesFormRequest extends FormRequest
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
            'final' => 'required',
            'secuencia' => 'required',
            'serial' => 'required|max:1',
            'tipo' => 'required'
        ];
    }
}
