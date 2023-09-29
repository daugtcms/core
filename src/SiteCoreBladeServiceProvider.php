<?php

namespace Felixbeer\SiteCore;

use Felixbeer\SiteCore\Blocks\View\Blocks\Header;
use Felixbeer\SiteCore\View\Components\Tiptap;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SiteCoreBladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Blade::component('tiptap', TipTap::class);
        Blade::component('site-core::blocks.header', Header::class);
        Blade::component('site-core::modal', 'components.modal.index');
        Blade::directive('svg', function ($expression) {
            return "<?php echo svg($expression); ?>";
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
