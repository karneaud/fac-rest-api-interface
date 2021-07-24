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
    	if(!$request->hasHeader('Signature') || !($user = $this->auth->guard($guard)->user()))
        	return response('Unauthorized', 401);
    	
    	try {
        	$error = false;
        	switch(true)
        	{
            	case (bool) $request->is('fac/api/v1/tokenize') :
            		$error = $this->testHASH(sprintf("%s|%s|%s", 
                				$request->input('card'),
                            	$user->api_key,
                            	$request->input('cvv')), $request->header('Signature'));
            		break;
            	default : $error = $this->testHASH(sprintf("%s|%s|%s", 
                			$request->input('order_id'),
                            $user->api_key,
                            number_format ($request->input('amount'), 2, ".","")), $request->header('Signature')); 
            		break;
        		
        	}
        
        	if(!$error) throw new \Exception('Unverified request!'); 
        	
        } catch(\Exception $e) {
        	Log::alert("{$e->getMessage()}  for KEY #{$user->api_key} with request ");
        	return response($e->getMessage(), 401);
        }
    
        return $next($request);
    }

	private function testHASH($string, $sig) {
    	return hash('sha256', $string) == $sig;
    }
}
