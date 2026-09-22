<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(
            private AuthService $authService
    ) {}

    public function login(LoginRequest $request)
    {
        try {
            $result = $this->authService->login(
                $request->validated()
            );

            return response()->json([
                'message' => 'Inicio de sesión exitoso',
                'user' => $result['user'],
                'token' => $result['token'],
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 401);
        }
    }
    
    public function register(RegisterRequest $request)
    {

        $result = $this->authService->register(
            $request->validated()
        );

        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'user' => $result['user'],
        ], 201);  
    
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return response()->json([
            'message' => 'Sesión cerrada correctamente'
        ]);
    }
}
