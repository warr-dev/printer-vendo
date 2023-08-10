<?php

namespace App\Http\Middleware;

use App\Models\Client;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InjectClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve a model based on some condition
        $client = Client::getClientByIp($request->ip());
        if(!$client)
            abort(403,'cant verify device');
        // Attach the model to the request
        $request->merge(compact('client'));   
        return $next($request);
    }
}
