<?php

namespace Sitebrew;

use Sitebrew\Blocks\BlocksRenderer;
use Sitebrew\Blocks\BlockSynth;
use Sitebrew\Livewire\Blocks\BlockEditor;
use Sitebrew\Livewire\Blocks\EditTemplate;
use Sitebrew\Livewire\Blocks\TemplateEditor;
use Sitebrew\Livewire\Navigation\EditNavigation;
use Sitebrew\Livewire\Navigation\NavigationEditor;
use Sitebrew\Livewire\Pages\PageEditor;
use Sitebrew\Livewire\Pages\PagesTable;
use Sitebrew\View\Components\Tiptap;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class SitebrewBladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Blade::component('tiptap', TipTap::class);
        //Blade::component('sitebrew::blocks.header', Header::class);
        //Blade::component('sitebrew::templates.floating-homepage', FloatingHomepage::class);
        Blade::component('sitebrew::modal', 'components.modal.index');
        Blade::directive('svg', function ($expression) {
            return "<?php echo svg($expression); ?>";
        });
        Blade::component('sitebrew::blocks-renderer', BlocksRenderer::class);

        Blade::componentNamespace('Sitebrew\\Blocks\\View\\Blocks\\', 'Blocks');
        Blade::componentNamespace('Sitebrew\\Blocks\\View\\Templates\\', 'Templates');
        Blade::componentNamespace('App\\Blocks\\', 'Blocks');
        Blade::componentNamespace('App\\Templates\\', 'Templates');

        Livewire::propertySynthesizer(BlockSynth::class);
        Livewire::component('sitebrew::block-editor', BlockEditor::class);
        Livewire::component('sitebrew::template-editor', TemplateEditor::class);
        Livewire::component('sitebrew::blocks.edit-template', EditTemplate::class);
        Livewire::component('sitebrew::navigation-editor', NavigationEditor::class);
        Livewire::component('sitebrew::navigation.edit-navigation', EditNavigation::class);
        Livewire::component('sitebrew::pages.page-editor', PageEditor::class);
        Livewire::component('sitebrew::pages.pages-table', PagesTable::class);

    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
