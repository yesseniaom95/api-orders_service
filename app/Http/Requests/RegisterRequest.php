<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed'],
            'role'     => ['required', Rule::in(['mesero', 'admin', 'cajero'])],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'El nombre del usuario es obligatorio.',
            'name.max'              => 'El nombre no puede superar los :max caracteres.',

            'email.required'        => 'El correo del usuario es obligatorio.',
            'email.email'           => 'Debe ingresar una dirección de correo válida.',
            'email.unique'          => 'El correo electrónico ya se encuentra registrado',

            'password.required'     => 'La contraseña es obligatoria.',
            'password.min'          => 'La contraseña debe tener :min caracteres',
            'password.max'          => 'la contraseña no puede superar los :max caracteres.',
            'password.confirmed'    => 'La confirmación de la contraseña no coincide',

            'role.in'               => 'El rol seleccionado no es válido. Debe ser: mesero, admin o cajero.',

        ];
    }

}
