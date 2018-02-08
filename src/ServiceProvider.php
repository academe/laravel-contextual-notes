<?php

namespace Academe\Laravel\ContextualNotes;

/**
 *
 */

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * The global name of the service in the locator.
     */
    const PROVIDES = 'academe-contextual-notes';

    /**
     * Return the path to the default config file within this package.
     */
    protected function getConfigFilePath()
    {
        return __DIR__ . '/../config/' . static::PROVIDES . '.php';
    }

    public function boot()
    {
        // The config file can be published.

        $this->publishes([
            $this->getConfigFilePath() => config_path(static::PROVIDES . '.php'),
        ], 'config');

        // Database migrations.

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations', 'migrations');
    }

    public function provides() {
        return [
            static::PROVIDES,
        ];
    }

    public function register()
    {
        // The published config file (if it has been published) is merged with
        // the default.

        $this->mergeConfigFrom(
            $this->getConfigFilePath(),
            static::PROVIDES
        );

        $this->app->singleton(static::PROVIDES, function($app) {
            return new Service();
        });
    }
}
