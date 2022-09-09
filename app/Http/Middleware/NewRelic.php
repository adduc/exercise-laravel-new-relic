<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NewRelic
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (extension_loaded('newrelic')) {
            newrelic_name_transaction($this->getTransactionName($request));
        }

        return $response;
    }


    public function getTransactionName(Request $request): string
    {
        if (is_string($request->route()->action['uses'] ?? null)) {
            $route = $request->route()->action['uses'];
        } elseif ($request->route()?->uri) {
            $uri = '/' . $request->route()->uri;
            $route = $uri == '//' ? '/' : $uri;
        } else {
            $route = 'undefined';
        }

        return $route;
    }
}
