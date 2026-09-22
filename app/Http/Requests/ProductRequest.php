<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'min:5','max:150'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'is_available'  => ['sometimes', 'boolean'],
            'is_combo'      => ['sometimes', 'boolean'],
            'tracks_stock'  => ['sometimes', 'boolean'],
            'current_stock' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required'   => 'La categoría es obligatoria.',
            'category_id.integer'    => 'El ID de la categoría debe ser un número entero.',
            'category_id.exists'     => 'La categoría seleccionada no existe en la base de datos.',

            'name.required'          => 'El nombre del producto es obligatorio.',
            'name.min'               => 'El nombre debe tener al menos :min caracteres.',
            'name.max'               => 'El nombre no puede superar los :max caracteres.',

            'price.required'         => 'El precio del producto es obligatorio.',
            'price.numeric'          => 'El precio debe ser un número válido.',
            'price.min'              => 'El precio no puede ser un valor negativo.',

            'is_available.boolean'   => 'El campo disponibilidad debe ser verdadero o falso.',
            'is_combo.boolean'       => 'El campo combo debe ser verdadero o falso.',
            'tracks_stock.boolean'   => 'El campo de seguimiento de stock debe ser verdadero o falso.',

            'current_stock.integer'  => 'El stock actual debe ser un número entero.',
            'current_stock.min'      => 'El stock actual no puede ser un número negativo.',
        ];
    }
}
