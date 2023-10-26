<?php

namespace Felixbeer\SiteCore;

use Felixbeer\SiteCore\Blocks\BlocksRenderer;
use Felixbeer\SiteCore\Blocks\BlockSynth;
use Felixbeer\SiteCore\Livewire\Blocks\BlockEditor;
use Felixbeer\SiteCore\Livewire\Blocks\EditTemplate;
use Felixbeer\SiteCore\Livewire\Blocks\TemplateEditor;
use Felixbeer\SiteCore\Livewire\Navigation\EditNavigation;
use Felixbeer\SiteCore\Livewire\Navigation\NavigationEditor;
use Felixbeer\SiteCore\Livewire\Pages\PageEditor;
use Felixbeer\SiteCore\Livewire\Pages\PagesTable;
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
        //Blade::component('site-core::blocks.header', Header::class);
        //Blade::component('site-core::templates.floating-homepage', FloatingHomepage::class);
        Blade::component('site-core::modal', 'components.modal.index');
        Blade::directive('svg', function ($expression) {
            return "<?php echo svg($expression); ?>";
        });
        Blade::component('site-core::blocks-renderer', BlocksRenderer::class);

        Blade::componentNamespace('Felixbeer\\SiteCore\\Blocks\\View\\Blocks\\', 'Blocks');
        Blade::componentNamespace('Felixbeer\\SiteCore\\Blocks\\View\\Templates\\', 'Templates');
        Blade::componentNamespace('App\\Blocks\\', 'Blocks');
        Blade::componentNamespace('App\\Templates\\', 'Templates');

        Livewire::propertySynthesizer(BlockSynth::class);
        Livewire::component('site-core::block-editor', BlockEditor::class);
        Livewire::component('site-core::template-editor', TemplateEditor::class);
        Livewire::component('site-core::blocks.edit-template', EditTemplate::class);
        Livewire::component('site-core::navigation-editor', NavigationEditor::class);
        Livewire::component('site-core::navigation.edit-navigation', EditNavigation::class);
        Livewire::component('site-core::pages.page-editor', PageEditor::class);
        Livewire::component('site-core::pages.pages-table', PagesTable::class);

    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
