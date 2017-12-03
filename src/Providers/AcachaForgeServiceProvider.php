<?php

namespace Acacha\Groups\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

/**
 * Class AcachaGroupsServiceProvider.
 */
class AcachaGroupsServiceProvider extends ServiceProvider
{
    const NAMESPACE = 'Acacha\Groups\Http\Controllers';

    public function register()
    {
        if (!defined('ACACHA_GROUPS_PATH')) {
            define('ACACHA_GROUPS_PATH', realpath(__DIR__.'/../../'));
        }

        $this->registerEloquentFactoriesFrom(ACACHA_GROUPS_PATH . '/database/factories');

        $this->mergeConfigFrom(
            ACACHA_GROUPS_PATH.'/config/groups.php', 'groups'
        );
    }

    /**
     * Boot
     */
    public function boot()
    {
        $this->defineRoutes();
        $this->loadViews();
        $this->loadMigrations();
    }

    /**
     * Define routes.
     */
    private function defineRoutes()
    {
        $this->defineWebRoutes();
        $this->defineApiRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    private function defineWebRoutes()
    {
        $this->app->make('router')->middleware('web')
            ->namespace(AcachaGroupsServiceProvider::NAMESPACE)
            ->group(ACACHA_GROUPS_PATH .'/routes/web.php');
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function defineApiRoutes()
    {
        $this->app->make('router')->prefix('api')->middleware(['api','bindings','throttle'])
            ->namespace(AcachaGroupsServiceProvider::NAMESPACE)
            ->group(ACACHA_GROUPS_PATH .'/routes/api.php');
    }

    /**
     * Load views
     */
    private function loadViews()
    {
        $this->loadViewsFrom(ACACHA_GROUPS_PATH.'/resources/views', 'acacha-groups');
    }

    /**
     * Load migrations.
     */
    private function loadMigrations()
    {
        $this->loadMigrationsFrom(ACACHA_GROUPS_PATH.'/database/migrations');
    }

    /**
     * Register factories.
     *
     * @param  string  $path
     * @return void
     */
    protected function registerEloquentFactoriesFrom($path)
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }

    /**
     * Publish config.
     */
    protected function publishConfig()
    {
        $this->publishes([
            ACACHA_GROUPS_PATH .'/config/groups.php' => config_path('groups.php'),
        ]);
    }
}
