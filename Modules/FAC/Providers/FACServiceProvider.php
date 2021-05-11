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
        $this->app->router->group([
                'namespace' => "Modules\\".$this->moduleName."\Http\Controllers",
            ], function ($router) {
                require __DIR__.'/../Routes/web.php';
            });

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
