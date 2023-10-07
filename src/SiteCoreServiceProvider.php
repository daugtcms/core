<?php

namespace Felixbeer\SiteCore;

use Felixbeer\SiteCore\Commands\SyncIcons;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\HorizonApplicationServiceProvider;
use Laravel\Horizon\HorizonServiceProvider;

class SiteCoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'site-core');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'site-core');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        Model::unguard();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('site-core.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/site-core'),
            ], 'site-core-assets');

            $this->publishes([
                base_path('vendor/laravel/horizon/public') => public_path('vendor/horizon'),
            ], 'horizon-assets');

            // Publish wire-elements-modal views
            $this->publishes([
                __DIR__.'/../resources/views/vendor/wire-elements-modal' => base_path('resources/views/vendor/wire-elements-modal'),
            ], 'site-core-views');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/site-core'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/site-core'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/site-core'),
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
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'site-core');

        $this->mergeConfigFrom(__DIR__.'/../config/horizon.php', 'horizon');

        // Register the main class to use with the facade
        $this->app->singleton('site-core', function () {
            return new SiteCore;
        });

        $newConfig = config('filesystems.disks');
        $newConfig['sitecore-media'] = [
            'driver' => 's3',
            'key' => env('SITECORE_MEDIA_ACCESS_KEY_ID'),
            'secret' => env('SITECORE_MEDIA_SECRET_ACCESS_KEY'),
            'region' => env('SITECORE_MEDIA_DEFAULT_REGION'),
            'bucket' => env('SITECORE_MEDIA_BUCKET'),
            'url' => env('SITECORE_MEDIA_URL'),
            'endpoint' => env('SITECORE_MEDIA_ENDPOINT'),
            'use_path_style_endpoint' => true,
            'visibility' => 'private',
            'throw' => false,
        ];
        config(['filesystems.disks' => $newConfig]);

        $this->app->register(HorizonServiceProvider::class);
        $this->app->register(HorizonApplicationServiceProvider::class);
    }
}
