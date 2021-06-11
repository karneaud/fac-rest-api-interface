<?php

namespace Modules\FAC\Providers;

use App\User;
use Modules\FAC\Services\Auth\Guard;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
   
    public function boot()
    {
    	 // $this->registerPolicies();
    	 $this->app['auth']->extend('api-key', function ($app, $name, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\Guard...
            /*
             * $this->app['auth']->extend('jwt', function ($app, $name, array $config) {
            $guard = new JWTGuard(
                $app['tymon.jwt'],
                $app['auth']->createUserProvider($config['provider']),
                $app['request']
            );

            $app->refresh('request', $guard, 'setRequest');

            return $guard;
        });
             * */
         	$guard = new Guard($this->app['auth']->createUserProvider($config['provider']), $app['request'], 'api_key', 'api_key' );
         	$app->refresh('request', $guard, 'setRequest');
         	return $guard;
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

   
}
