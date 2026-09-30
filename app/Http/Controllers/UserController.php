<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ValidateSignature;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService)
    {}
    public function listUser()
    {
        $user = $this->userService->listUser();

        return response()->json(
            [
                $user
            ],200);
    }

    public function registerUser(RegisterRequest $request)
    {
        $user = $this->userService->registerUser($request->validated());

        return response()->json(
            [
                'message' => 'Usuario registrado exitosamente',
                'data' => $user
            ],200);
    }
}
