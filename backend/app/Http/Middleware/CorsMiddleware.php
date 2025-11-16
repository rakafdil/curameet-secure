<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $allowedOrigins = [
            'http://localhost:3000',
            'http://backend-secure.test',
            'https://curameet.duckdns.org',
            'https://api.curameet.duckdns.org',
            'https://curameet-secure.duckdns.org',
            'https://api.curameet-secure.duckdns.org',
        ];

        $origin = $request->headers->get('Origin');

        $headers = [
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, PATCH, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'Origin, Content-Type, Accept, Authorization, X-Requested-With',
            'Access-Control-Allow-Credentials' => 'true',
        ];

        if (in_array($origin, $allowedOrigins)) {
            $headers['Access-Control-Allow-Origin'] = $origin;
        }

        if ($request->getMethod() === 'OPTIONS') {
            return response('OK', 200)->withHeaders($headers);
        }

        $response = $next($request);

        foreach ($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        if ($response->headers->has('Content-Security-Policy')) {
            $response->headers->remove('Content-Security-Policy');
        }

        return $response;
    }
}

