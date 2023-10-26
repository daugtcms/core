<?php

namespace Sitebrew;

use Sitebrew\Commands\SyncIcons;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\HorizonApplicationServiceProvider;
use Laravel\Horizon\HorizonServiceProvider;

class SitebrewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'sitebrew');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'sitebrew');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        Model::unguard();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('sitebrew.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/sitebrew'),
            ], 'sitebrew-assets');

            $this->publishes([
                base_path('vendor/laravel/horizon/public') => public_path('vendor/horizon'),
            ], 'horizon-assets');

            // Publish wire-elements-modal views
            $this->publishes([
                __DIR__.'/../resources/views/vendor/wire-elements-modal' => base_path('resources/views/vendor/wire-elements-modal'),
            ], 'sitebrew-views');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/sitebrew'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/sitebrew'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/sitebrew'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([
                SyncIcons::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'sitebrew');

        $this->mergeConfigFrom(__DIR__.'/../config/horizon.php', 'horizon');

        // Register the main class to use with the facade
        $this->app->singleton('sitebrew', function () {
            return new Sitebrew;
        });

        $newConfig = config('filesystems.disks');
        $newConfig['sitebrew-media'] = [
            'driver' => 's3',
            'key' => env('SITEBREW_MEDIA_ACCESS_KEY_ID'),
            'secret' => env('SITEBREW_MEDIA_SECRET_ACCESS_KEY'),
            'region' => env('SITEBREW_MEDIA_DEFAULT_REGION'),
            'bucket' => env('SITEBREW_MEDIA_BUCKET'),
            'url' => env('SITEBREW_MEDIA_URL'),
            'endpoint' => env('SITEBREW_MEDIA_ENDPOINT'),
            'use_path_style_endpoint' => true,
            'visibility' => 'private',
            'throw' => false,
        ];
        config(['filesystems.disks' => $newConfig]);

        $this->app->register(HorizonServiceProvider::class);
        $this->app->register(HorizonApplicationServiceProvider::class);
    }
}
