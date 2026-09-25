<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Maneja una petición entrante agregando encabezados de seguridad HTTP a la respuesta.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        // Oculta la firma de tecnologías del servidor
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        // Evita ataques de Clickjacking prohibiendo la carga de la API en iframes
        $response->headers->set('X-Frame-Options', 'DENY');

        // Previene la inspección/adivinación del tipo MIME (Sniffing)
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Habilita el filtro de protección XSS en navegadores legados
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Restringe el envío de información sobre el origen en peticiones cruzadas
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Política de seguridad de contenido básica para la API REST
        $response->headers->set('Content-Security-Policy', "default-src 'none'; frame-ancestors 'none';");

        // Forza conexiones puras vía HTTPS en entorno de Producción (HSTS)
        if (app()->environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        if (function_exists('header_remove')) {
            header_remove('X-Powered-By');
        }
        $response->headers->remove('X-Powered-By');

        return $response;
    }
}