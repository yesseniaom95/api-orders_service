<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Maneja la verificación de roles recibidos como parámetros en las rutas.
     * Soporta listas separadas por comas o plecas: 'role:admin,mesero,cajero' o 'role:admin|mesero|cajero'
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // 1. Verificar si el usuario está autenticado
        if (!$user) {
            return response()->json([
                'message' => 'No autenticado.'
            ], 401);
        }

        // 2. Normalizar la lista de roles permitidos
        $allowedRoles = [];
        foreach ($roles as $roleGroup) {
            // Reemplaza comas o plecas por un delimitador único
            $cleanRoles = str_replace(['|', ' '], ',', $roleGroup);
            $allowedRoles = array_merge($allowedRoles, explode(',', $cleanRoles));
        }

        $allowedRoles = array_unique(array_filter($allowedRoles));

        // 3. Validar si el rol del usuario está dentro de los permitidos
        // Asumiendo que el usuario tiene una columna 'role' en la tabla users
        if (!in_array($user->role, $allowedRoles)) {
            return response()->json([
                'message' => 'Acceso no autorizado. No tienes los permisos requeridos para esta acción.'
            ], 403);
        }

        return $next($request);
    }
}