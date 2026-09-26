<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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

            'table_id'      => ['required'],
            'user_id'       => ['required'],
            'origin'        => ['required'],
            'app_uuid'      => ['required', 'string', 'max:36'],
            'status'        => ['required'],
            'total_amount'  => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
