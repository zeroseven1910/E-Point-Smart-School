<?php

namespace Illuminate\Routing\Middleware;

use Closure;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class ValidateSignature
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ?string $absolute = 'true')
    {
        if (! $request->hasValidSignature($absolute !== 'false')) {
            throw new InvalidSignatureException;
        }

        return $next($request);
    }
}
