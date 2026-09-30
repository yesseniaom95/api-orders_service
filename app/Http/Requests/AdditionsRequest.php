<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Override;

class AdditionsRequest extends FormRequest
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
            'name'              => ['required', 'string', 'max:100'],
            'additional_price'  => ['required', 'numeric', 'min:0'],
            'product_id'        => ['required', 'numeric', 'exists:products,id']
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'El nombre de la adición es obligatorio.',
            'name.max'              => 'El nombre no puede superar los :max caracteres.',

            'additional_price.min'      => 'El precio no puede ser un valor negativo',
            'additional_price.required' => 'El precio de la adición es obligatorio.',

            'product_id.exists'     => 'Uno de los productos seleccionados no existe en el catálogo.',
            'product.required'      => 'El id del producto es obligatorio.'
        ];
    }
}
