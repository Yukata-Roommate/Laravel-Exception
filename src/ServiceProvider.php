<?php

namespace YukataRm\Laravel\Exception;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

use YukataRm\Laravel\Exception\Commands\PublishStubsCommand;

use YukataRm\Laravel\Exception\Facades\Exception;
use YukataRm\Laravel\Exception\Facades\Manager;

/**
 * Exception Service Provider
 *
 * @package YukataRm\Laravel\Exception
 */
class ServiceProvider extends BaseServiceProvider
{
    /*----------------------------------------*
     * Boot
     *----------------------------------------*/

    /**
     * boot
     *
     * @return void
     */
    public function boot(): void
    {
        $this->bootCommands();
        $this->bootLangs();
        $this->bootViews();
    }

    /**
     * boot commands
     *
     * @return void
     */
    protected function bootCommands(): void
    {
        if (!$this->app->runningInConsole()) return;

        $this->commands([
            PublishStubsCommand::class,
        ]);
    }

    /**
     * boot langs
     *
     * @return void
     */
    protected function bootLangs(): void
    {
        $path = __DIR__ . "/../langs";

        $this->loadTranslationsFrom($path, "yr-exception");

        $this->publishes([
            $path => $this->app->langPath("vendor/yr-exception"),
        ]);
    }

    /**
     * boot views
     *
     * @return void
     */
    protected function bootViews(): void
    {
        $this->loadViewsFrom(__DIR__ . "/../resources/views", "yr-exception");
    }

    /*----------------------------------------*
     * Register
     *----------------------------------------*/

    /**
     * register
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfigs();
        $this->registerFacade();
    }

    /**
     * register configs
     *
     * @return void
     */
    protected function registerConfigs()
    {
        $this->mergeConfigFrom(__DIR__ . "/../configs/yr-exception.php", "yr-exception");
    }

    /**
     * register Facade
     *
     * @return void
     */
    protected function registerFacade()
    {
        $this->app->singleton(Exception::class, function () {
            return new Manager();
        });
    }
}
