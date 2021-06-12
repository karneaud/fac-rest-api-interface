<?php

namespace Modules\FAC\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Auth\Factory as Auth;
/**
 * Class VerifyRequest
 * @package App\Http\Middleware
 */
class VerifyRequest
{
	/**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param \Illuminate\Contracts\Auth\Factory $auth
     *
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure $next
     * @param  string  $guard
     * 
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
    	if(!$request->hasHeader('X-Signature') || !($user = $this->auth->guard($guard)->user()))
        	return response('Unauthorized', 401);
    	
    	try {
        	if(sha1("{$request->input('order_id')}|{$user->api_key}|{$request->input('amount')}") != $request->header('X-Signature')) throw new \Exception('Unverified request!');
        } catch(\Exception $e) {
        	Log::alert("{$e->getMessage()}  for KEY #{$user->api_key} with request {$request->input('order_id')} {$request->input('amount')} "  );
        	return response($e->getMessage(), 401);
        }
    
        return $next($request);
    }
}