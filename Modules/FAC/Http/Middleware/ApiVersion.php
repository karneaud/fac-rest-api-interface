<?php

namespace Modules\FAC\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
/**
 * Class APIVersion
 * @package App\Http\Middleware
 */
class ApiVersion
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard)
    {
        config(['fac.version' => $guard ]);
        return $next($request);
    }
}