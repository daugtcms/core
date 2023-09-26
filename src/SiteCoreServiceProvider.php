<?php

namespace Felixbeer\SiteCore;

use Felixbeer\SiteCore\Blocks\BlockSynth;
use Felixbeer\SiteCore\Blocks\View\Blocks\Header;
use Felixbeer\SiteCore\Livewire\BlockEditor;
use Felixbeer\SiteCore\Livewire\NavigationEditor;
use Felixbeer\SiteCore\View\Components\Tiptap;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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

        Blade::component('tiptap', TipTap::class);
        Blade::component('site-core::blocks.header', Header::class);

        Livewire::propertySynthesizer(BlockSynth::class);
        Livewire::component('site-core::block-editor', BlockEditor::class);
        Livewire::component('site-core::navigation-editor', NavigationEditor::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('site-core.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/site-core'),
            ], 'site-core-assets');

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
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'site-core');

        // Register the main class to use with the facade
        $this->app->singleton('site-core', function () {
            return new SiteCore;
        });
    }
}
