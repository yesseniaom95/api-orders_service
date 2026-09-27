<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class OrdersRequest extends FormRequest
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

            'table_id'      => ['required', 'integer', 'exists:tables,id'],
            'user_id'       => ['required'],
            'origin'        => ['required', Rule::in(['app_mesero', 'caja_pc'])],
            'app_uuid'      => ['nullable', 'string', 'min:5','max:36'],
            'status'        => ['required', Rule::in(['abierto', 'en_preparacion', 'listo', 'cerrado', 'cancelado'])],
            'total_amount'  => ['nullable', 'numeric', 'min:0'],

            'items'                 => ['required', 'array', 'min:1'],
            'items.*.product_id'    => ['required', 'integer', 'exists:products,id'],
            'items.*.quantity'      => ['required', 'integer', 'min:1'],
            'items.*.kitchen_notes' => ['nullable', 'string', 'max:255'],
            'items.*.status'        => ['nullable', 'string', Rule::in(['pendiente', 'en_preparacion', 'entregado'])],

            'items.*.additions'              => ['nullable', 'array'],
            'items.*.additions.*.id'=> ['required_with:items.*.additions', 'integer', 'exists:additions,id'],

        ];
    }

    public function messages()
    {
        return [
            'table_id.required' => 'El id de la mesa es obligatorio.',
            'table_id.exists'   => 'La mesa seleccionada no existe.',
            'origin.required'   => 'El origen es obligatorio.',
            'origin.in'         => 'El origen enviado no es válido (permitidos: app_mesero, caja_pc).',

            'status.required' => 'El status es obligatorio.',
            'status.min'      => 'El status debe tener al menos :min caracteres.',
            'status.max'      => 'El status no puede superar los :max caracteres.',

            // Mensajes de Ítems
            'items.required'            => 'Debes incluir al menos un producto en la orden.',
            'items.min'                 => 'La orden debe contener al menos 1 ítem.',
            'items.*.product_id.required'=> 'El ID del producto es obligatorio.',
            'items.*.product_id.exists'  => 'Uno de los productos seleccionados no existe en el catálogo.',
            'items.*.quantity.required'  => 'La cantidad del producto es obligatoria.',
            'items.*.quantity.min'       => 'La cantidad debe ser de al menos 1.',

            // Mensajes de Adiciones
            'items.*.additions.*.id.exists' => 'Una de las adiciones seleccionadas no existe.',
        ];
    }
}
