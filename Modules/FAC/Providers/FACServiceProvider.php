<?php

namespace Modules\FAC\Providers;

use Illuminate\Support\ServiceProvider;

class FACServiceProvider extends ServiceProvider
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

    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            $this->module_path($this->moduleName, 'Config/config.php') => $this->config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            $this->module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

	protected function registerRoutes() {
    	$this->app->routeMiddleware(['api-version' => Modules\FAC\Http\Middleware\ApiVersion::class ]);
    	$this->app->router->group([
                'namespace' => "Modules\\".$this->moduleName."\Http\Controllers",
        		'middleware' => ['nocache', 'hideserver', 'security', 'csp', 'cors'],
            ], function ($router) {
                require __DIR__.'/../Routes/web.php';
        		// register api routes
        		$router->group(['prefix' => 'api', 'middleware' => ['auth:api', 'throttle', 'api-version:1' ]], function($router) {
                	 require __DIR__.'/../Routes/api.v1.php';
                });
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
        return [];
    }
}
