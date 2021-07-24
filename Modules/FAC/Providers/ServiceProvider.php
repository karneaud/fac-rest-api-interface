<?php

namespace Modules\FAC\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'FAC';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'fac';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        
		$this->registerRoutes();
        $this->registerConfig();
        $this->loadMigrationsFrom($this->module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
		$this->commands(\Modules\FAC\Console\RegisterUserCommand::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            $this->module_path($this->moduleName, 'Config/config.php') => $this->config_path($this->moduleNameLower . '.php')
        ], 'config');
        $this->mergeConfigFrom(
            $this->module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    	$this->mergeConfigFrom(
            $this->module_path($this->moduleName, 'Config/guard.php'), 'auth.guards'
        );
    }

	protected function registerRoutes() {
    	$this->app->routeMiddleware([
        	'api-version' => \Modules\FAC\Http\Middleware\ApiVersion::class, 
        	'verify' => \Modules\FAC\Http\Middleware\VerifyRequest::class ]);
    	$this->app->router->group([
                'namespace' => "Modules\\".$this->moduleName."\Http\Controllers",
        		'middleware' => ['nocache', 'hideserver', 'security', 'csp', 'cors'],
        		'prefix' => 'fac'
            ], function ($router) {
                require __DIR__.'/../Routes/web.php';
            });
    }

    private function module_path($name, $path = '')
    {
        $module = app('modules')->find($name);

        return $module->getPath() . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }

    private function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }



    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
        	
        ];
    }
}
