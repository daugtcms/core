<?php

namespace Sitebrew;

use Sitebrew\Livewire\Content\ScheduleContent;
use Sitebrew\Livewire\Listing\ListingEditor;
use Sitebrew\Livewire\Media\EditMedia;
use Sitebrew\Livewire\Media\MediaManager;
use Sitebrew\Livewire\Media\MediaPicker;
use Sitebrew\Livewire\Media\MediaUploader;
use Sitebrew\Livewire\MemberArea\CoursePosts;
use Sitebrew\Livewire\MemberArea\Dashboard;
use Sitebrew\Livewire\Shop\EditOrder;
use Sitebrew\Livewire\Shop\EditProduct;
use Sitebrew\Livewire\Shop\OrderList;
use Sitebrew\Livewire\Shop\ProductTable;
use Sitebrew\Livewire\Table\SelectTableItems;
use Sitebrew\Livewire\Users\EditUser;
use Sitebrew\Livewire\Users\UserTable;
use Sitebrew\View\Blocks\Misc\BlocksRenderer;
use Sitebrew\View\Blocks\Misc\BlockSynth;
use Sitebrew\Livewire\Blocks\BlockEditor;
use Sitebrew\Livewire\Blocks\EditTemplate;
use Sitebrew\Livewire\Blocks\TemplateEditor;
use Sitebrew\Livewire\Listing\EditListing;
use Sitebrew\Livewire\Content\ContentEditor;
use Sitebrew\Livewire\Content\ContentTable;
use Sitebrew\View\Blocks\Misc\TemplateRenderer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Sitebrew\View\Components\Shop\ShoppingCart;

class SitebrewBladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        Blade::component('sitebrew::modal', 'components.modal.index');
        Blade::directive('svg', function ($expression) {
            return "<?php echo svg($expression); ?>";
        });
        Blade::directive('number', function ($number) {
            return "<?php echo number_format($number, 2, ',', '.'); ?>";
        });

        Blade::component('sitebrew::shop.shopping-cart', ShoppingCart::class);
        Blade::component('sitebrew::blocks-renderer', BlocksRenderer::class);
        Blade::component('sitebrew::template-renderer', TemplateRenderer::class);

        Blade::componentNamespace('Sitebrew\\View\\Blocks\\', 'Blocks');
        Blade::componentNamespace('Sitebrew\\View\\Blocks\\Templates\\', 'Templates');
        Blade::componentNamespace('App\\Blocks\\', 'Blocks');
        Blade::componentNamespace('App\\Templates\\', 'Templates');

        Livewire::propertySynthesizer(BlockSynth::class);
        Livewire::component('sitebrew::block-editor', BlockEditor::class);
        Livewire::component('sitebrew::template-editor', TemplateEditor::class);
        Livewire::component('sitebrew::blocks.edit-template', EditTemplate::class);
        Livewire::component('sitebrew::listing.listing-editor', ListingEditor::class);
        Livewire::component('sitebrew::listing.edit-listing', EditListing::class);
        Livewire::component('sitebrew::content.content-table', ContentTable::class);
        Livewire::component('sitebrew::media.media-manager', MediaManager::class);
        Livewire::component('sitebrew::media.media-uploader', MediaUploader::class);
        Livewire::component('sitebrew::media.media-picker', MediaPicker::class);
        Livewire::component('sitebrew::media.edit-media', EditMedia::class);
        Livewire::component('sitebrew::users.user-table', UserTable::class);
        Livewire::component('sitebrew::users.edit-user', EditUser::class);
        Livewire::component('sitebrew::shop.product-table', ProductTable::class);
        Livewire::component('sitebrew::shop.edit-product', EditProduct::class);
        Livewire::component('sitebrew::table.select-table-items', SelectTableItems::class);
        Livewire::component('sitebrew::shop.order-list', OrderList::class);
        Livewire::component('sitebrew::shop.edit-order', EditOrder::class);
        Livewire::component('sitebrew::member-area.dashboard', Dashboard::class);
        Livewire::component('sitebrew::member-area.course-posts', CoursePosts::class);
        Livewire::component('sitebrew::content.schedule-content', ScheduleContent::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
