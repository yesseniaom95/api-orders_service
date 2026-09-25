<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Override;

class CategoryRequest extends FormRequest
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
            'name'          => ['required', 'string', 'min:5', 'max:100'],
            'icon'          => ['required', 'string', 'min:5', 'max:50'],
            'sort_order'    => ['required', 'integer', 'min:1']
        ];
    } 

    public function messages()
    {
        return [
            'name.required'         => 'El nombre de la categoria es obligatoria.',
            'name.min'              => 'El nombre debe tener al menos :min caracteres.',
            'name.max'              => 'El nombre no puede superar los :max caracteres.',

            'icon.required'         => 'El icono es obligatorio.',
            'icon.min'              => 'El icono debe tener al menos :min caracteres.',
            'icon.max'              => 'El icono no puede superar los :max caracteres.',

            'sort_order.required'   => 'El numero de orden para la categoria es obligatorio.',
            'sort_order.min'        => 'El numero debe tener al menos :min caracter',
            
        ];
    }
}
