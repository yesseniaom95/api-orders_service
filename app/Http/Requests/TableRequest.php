<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Override;

class TableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'table_number' => ['required', 'string', 'min:1', 'max:20'],
            'zone'         => ['required', 'string', 'min:5','max:50'],
            'status'       => ['required', 'string', 'min:5', 'max:20']
        ];
    }

    public function messages()
    {
        return [
            'table_number.required'     => 'El numero de mesa es obligatorio.',
            'table_number.min'          => 'El numero debe tener al menos :min caracteres.',
            'table_number.max'          => 'El numero no puede superar los :max caracteres.',

            'zone.required'             => 'El nombre de zona es obligatorio.',
            'zone.min'                  => 'El nombre de zona debe tener al menos :min caracteres.',
            'zone.max'                  => 'El nombre de zona no puede superar los :max caracteres.',

            'status.required'             => 'El status es obligatorio.',
            'status.min'                  => 'El status debe tener al menos :min caracteres.',
            'status.max'                  => 'El status no puede superar los :max caracteres.',
        ];
    }

}
