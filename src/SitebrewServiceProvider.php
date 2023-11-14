<?php

namespace Sitebrew;

use Aws\S3\S3Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter as S3Adapter;
use League\Flysystem\AwsS3V3\PortableVisibilityConverter as AwsS3PortableVisibilityConverter;
use League\Flysystem\Filesystem;
use League\Flysystem\Visibility;
use Plank\Mediable\Facades\ImageManipulator;
use Plank\Mediable\ImageManipulation;
use Sitebrew\Commands\SyncIcons;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\HorizonApplicationServiceProvider;
use Laravel\Horizon\HorizonServiceProvider;
use Sitebrew\Extensions\CloudflareR2Adapter;
use Sitebrew\Helpers\Media\MediaHelper;

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

        ImageManipulator::defineVariant(
            'thumbnail',
            ImageManipulation::make(function (Image $image) {
                $image->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            })->outputWebpFormat()->setOutputQuality(50)
        );

        ImageManipulator::defineVariant(
            'optimized',
            ImageManipulation::make(function (Image $image) {
                $image->resize(1920, 1920, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            })->outputWebpFormat()->setOutputQuality(50)
        );

        $loader = AliasLoader::getInstance();
        $loader->alias('MediaHelper', MediaHelper::class);

        Storage::extend('s3', function ($app, $config) {
            // this is inspired by the createS3Driver method in vendor/laravel/framework/src/Illuminate/Filesystem/FilesystemManager.php
            $s3Config = [
                'credentials' => [
                    'key'    => $config['key'],
                    'secret' => $config['secret'],
                ],
                'region' => $config['region'],
                'version' => 'latest',
                'endpoint' => $config['endpoint'],
                'bucket' => $config['bucket'],
                'url' => $config['url'],
                'use_path_style_endpoint' => $config['use_path_style_endpoint'] ?? false
            ];

            $client = new S3Client($s3Config);

            $adapter = new CloudflareR2Adapter($client, $config['bucket']);

            return new \Illuminate\Filesystem\AwsS3V3Adapter(
                new Filesystem($adapter, $config), $adapter, $s3Config, $client
            );
        });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('sitebrew.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../public/vendor/sitebrew' => public_path('vendor/sitebrew'),
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

        $this->mergeConfigFrom(__DIR__.'/../config/mediable.php', 'mediable');

        $this->mergeConfigFrom(__DIR__.'/../config/wire-elements-modal.php', 'wire-elements-modal');

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
