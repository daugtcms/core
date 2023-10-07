<?php

namespace Felixbeer\SiteCore;

use Felixbeer\SiteCore\Blocks\BlockSynth;
use Felixbeer\SiteCore\Blocks\View\Blocks\Header;
use Felixbeer\SiteCore\Livewire\Blocks\BlockEditor;
use Felixbeer\SiteCore\Livewire\Blocks\EditTemplate;
use Felixbeer\SiteCore\Livewire\Blocks\TemplateEditor;
use Felixbeer\SiteCore\Livewire\Navigation\EditNavigation;
use Felixbeer\SiteCore\Livewire\Navigation\NavigationEditor;
use Felixbeer\SiteCore\View\Components\Tiptap;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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

        Livewire::propertySynthesizer(BlockSynth::class);
        Livewire::component('site-core::block-editor', BlockEditor::class);
        Livewire::component('site-core::template-editor', TemplateEditor::class);
        Livewire::component('site-core::blocks.edit-template', EditTemplate::class);
        Livewire::component('site-core::navigation-editor', NavigationEditor::class);
        Livewire::component('site-core::navigation.edit-navigation', EditNavigation::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
