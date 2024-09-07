<?php

namespace Daugt;

use Aws\S3\S3Client;
use Daugt\Misc\ThemeRegistry;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter as S3Adapter;
use League\Flysystem\AwsS3V3\PortableVisibilityConverter as AwsS3PortableVisibilityConverter;
use League\Flysystem\Filesystem;
use League\Flysystem\Visibility;
use Plank\Mediable\Facades\ImageManipulator;
use Plank\Mediable\ImageManipulation;
use Plank\Mediable\Media;
use Daugt\Commands\SyncIcons;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\HorizonApplicationServiceProvider;
use Laravel\Horizon\HorizonServiceProvider;
use Daugt\Commands\SyncStripeTaxCodes;
use Daugt\Extensions\CloudflareR2Adapter;
use Daugt\Helpers\Media\MediaHelper;
use Daugt\Livewire\Shop\ProductTable;
use Daugt\Misc\ContentTypeRegistry;
use Daugt\Misc\ListingTypeRegistry;
use Daugt\Misc\TemplateUsageRegistry;
use Daugt\Models\Blocks\Template;
use Daugt\Models\Content\Content;
use Daugt\Models\Listing\Listing;
use Daugt\Models\Listing\ListingItem;
use Daugt\Models\Shop\Order;
use Daugt\Models\Shop\OrderItem;
use Daugt\Models\Shop\Product;
use Daugt\Models\User;

class DaugtServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // TODO: structure this into different service providers
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Admin');
        });

        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'daugt');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'daugt');

        $themes = include __DIR__ . '/../resources/data/themes.php';
        ThemeRegistry::registerThemes($themes);

        $contentTypes = include __DIR__ . '/../resources/data/content_types.php';
        ContentTypeRegistry::registerContentTypes($contentTypes);

        $templateUsages = include __DIR__ . '/../resources/data/template_usages.php';
        TemplateUsageRegistry::registerTemplateUsages($templateUsages);

        $listingTypes = include __DIR__ . '/../resources/data/listing_types.php';
        ListingTypeRegistry::registerListingTypes($listingTypes);

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
            // this is inspired by the createS3Driver method in vendor/laravel/framework/Daugt/Illuminate/Filesystem/FilesystemManager.php
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
                __DIR__.'/../config/config.php' => config_path('daugt.php'),
            ], 'daugt-config');

            $this->publishes([
                __DIR__.'/../public/vendor/daugt' => public_path('vendor/daugt'),
            ], 'daugt-assets');

            /*$this->publishes([
                base_path('vendor/laravel/horizon/public') => public_path('vendor/horizon'),
            ], 'horizon-assets');*/

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'daugt-migrations');

            $this->publishes([
                __DIR__ . '/../routes/daugt.php' => base_path('routes/daugt.php'),
            ], 'daugt-routes');

            // Publish wire-elements-modal views
            /*$this->publishes([
                __DIR__.'/../resources/views/vendor/wire-elements-modal' => base_path('resources/views/vendor/wire-elements-modal'),
            ], 'daugt-views');*/

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/daugt'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/daugt'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/daugt'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([
                SyncIcons::class,
                SyncStripeTaxCodes::class
            ]);
        }

        Relation::enforceMorphMap([
            'product' => Product::class,
            'content' => Content::class,
            'template' => Template::class,
            'listing' => Listing::class,
            'listing-item' => ListingItem::class,
            'user' => User::class,
            'media' => Media::class,
            'order' => Order::class,
            'order-item' => OrderItem::class
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'daugt');

        $this->mergeConfigFrom(__DIR__.'/../config/horizon.php', 'horizon');

        $this->mergeConfigFrom(__DIR__.'/../config/mediable.php', 'mediable');

        $this->mergeConfigFrom(__DIR__.'/../config/wire-elements-pro.php', 'wire-elements-pro');

        $this->mergeConfigFrom(__DIR__.'/../config/permission.php', 'permission');

        $this->mergeConfigFrom(__DIR__.'/../config/stripe-webhooks.php', 'stripe-webhooks');

        $this->mergeConfigFrom(__DIR__.'/../config/honeypot.php', 'honeypot');

        $this->mergeConfigFrom(__DIR__.'/../config/data.php', 'data');


        // Register the main class to use with the facade
        $this->app->singleton('daugt', function () {
            return new Daugt;
        });

        $newConfig = config('filesystems.disks');
        $newConfig['daugt-media'] = [
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
