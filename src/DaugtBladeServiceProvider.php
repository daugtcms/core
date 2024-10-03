<?php

namespace Daugt;

use Daugt\Livewire\Blocks\BlockDefaultsEditor;
use Daugt\Livewire\Blocks\EditBlockData;
use Daugt\Livewire\Content\EditContent;
use Daugt\Livewire\Content\ScheduleContent;
use Daugt\Livewire\Listing\ListingEditor;
use Daugt\Livewire\Media\EditMedia;
use Daugt\Livewire\Media\MediaManager;
use Daugt\Livewire\Media\MediaPicker;
use Daugt\Livewire\Media\MediaUploader;
use Daugt\Livewire\MemberArea\CoursePosts;
use Daugt\Livewire\MemberArea\Dashboard;
use Daugt\Livewire\Shop\EditOrder;
use Daugt\Livewire\Shop\EditProduct;
use Daugt\Livewire\Shop\OrderList;
use Daugt\Livewire\Shop\ProductTable;
use Daugt\Livewire\Table\SelectTableItems;
use Daugt\Livewire\Users\EditUser;
use Daugt\Livewire\Users\UserTable;
use Daugt\View\Blocks\Misc\BlockSynth;
use Daugt\Livewire\Blocks\EditBlockDefaults;
use Daugt\Livewire\Blocks\TemplateEditor;
use Daugt\Livewire\Listing\EditListing;
use Daugt\Livewire\Content\ContentEditor;
use Daugt\Livewire\Content\ContentTable;
use Daugt\View\Blocks\Misc\ContentRenderer;
use Daugt\View\Blocks\Misc\TemplateRenderer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Daugt\View\Components\Shop\ShoppingCart;

class DaugtBladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        Blade::component('daugt::modal', 'components.modal.index');
        Blade::directive('number', function ($number) {
            return "<?php echo number_format($number, 2, ',', '.'); ?>";
        });

        Blade::component('daugt::shop.shopping-cart', ShoppingCart::class);
        Blade::component('daugt::content-renderer', ContentRenderer::class);
        Blade::component('daugt::template-renderer', TemplateRenderer::class);

        Blade::componentNamespace('Daugt\\View\\Blocks\\', 'Blocks');
        Blade::componentNamespace('Daugt\\View\\Blocks\\Templates\\', 'Templates');
        Blade::componentNamespace('App\\Blocks\\', 'Blocks');
        Blade::componentNamespace('App\\Templates\\', 'Templates');

        // foreach directory in storage/app/blocks
        foreach (glob(storage_path('app/blocks/*'), GLOB_ONLYDIR) as $dir) {
            $themeName = basename($dir);
            Blade::anonymousComponentPath($dir, $themeName);
        }

        Livewire::propertySynthesizer(BlockSynth::class);
        Livewire::component('daugt::block-defaults-editor', BlockDefaultsEditor::class);
        Livewire::component('daugt::blocks.edit-block-defaults', EditBlockDefaults::class);
        Livewire::component('daugt::listing.listing-editor', ListingEditor::class);
        Livewire::component('daugt::listing.edit-listing', EditListing::class);
        Livewire::component('daugt::content.content-table', ContentTable::class);
        Livewire::component('daugt::media.media-manager', MediaManager::class);
        Livewire::component('daugt::media.media-uploader', MediaUploader::class);
        Livewire::component('daugt::media.media-picker', MediaPicker::class);
        Livewire::component('daugt::media.edit-media', EditMedia::class);
        Livewire::component('daugt::users.user-table', UserTable::class);
        Livewire::component('daugt::users.edit-user', EditUser::class);
        Livewire::component('daugt::shop.product-table', ProductTable::class);
        Livewire::component('daugt::shop.edit-product', EditProduct::class);
        Livewire::component('daugt::table.select-table-items', SelectTableItems::class);
        Livewire::component('daugt::shop.order-list', OrderList::class);
        Livewire::component('daugt::shop.edit-order', EditOrder::class);
        Livewire::component('daugt::member-area.dashboard', Dashboard::class);
        Livewire::component('daugt::member-area.course-posts', CoursePosts::class);
        Livewire::component('daugt::content.schedule-content', ScheduleContent::class);
        Livewire::component('daugt::content.edit-content', EditContent::class);
        Livewire::component('daugt::content.content-editor', ContentEditor::class);
        Livewire::component('daugt::blocks.edit-block-data', EditBlockData::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
