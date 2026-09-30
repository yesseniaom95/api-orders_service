<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Override;

class ComboOptionsRequest extends FormRequest
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
            'combo_id'  => ['required', 'numeric','exists:products,id'],
            'step_name' => ['required', 'string', 'max:100', 'min:5'],
            'option_product_id' => ['required','numeric', 'exists:products,id']
        ];
    }

    public function messages()
    {
        return [
            'combo_id.exists'       => 'El id del combo no existe.',
            'combo_id.required'     => 'El id del combo es obligatorio.',

            'step_name.required'    => 'El nombre es obligatorio.',
            'step_name.max'         => 'El nombre no puede superar los :max caracteres.',

            'option_product_id.exists' => 'El id del producto no existe.',
            'option_product_id.required'    => 'El id del producto es obligatorio.'

        ];
    }
}
