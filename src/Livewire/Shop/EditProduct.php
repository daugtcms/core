<?php

namespace Sitebrew\Livewire\Shop;

use Livewire\Attributes\On;
use Livewire\Features\SupportAttributes\AttributeCollection;
use Plank\Mediable\Media;
use Sitebrew\Enums\Blocks\TemplateUsage;
use Sitebrew\Enums\Shop\BillingType;
use Sitebrew\Helpers\Media\MediaHelper;
use Sitebrew\Livewire\Content\CoursesTable;
use Sitebrew\Models\Content\Course;
use Sitebrew\Models\Navigation\Navigation;
use Livewire\Attributes\Rule;
use Sitebrew\Models\Shop\Product;
use Sitebrew\Models\User;
use WireElements\Pro\Components\Modal\Modal;

class EditProduct extends Modal
{
    public int|Product $product;

    #[Rule('required')]
    public $name = '';

    public ?array $description;

    #[Rule('required')]
    public $price = 0;

    #[Rule('nullable|url')]
    public ?string $external_url = null;

    #[Rule('nullable|bool')]
    public $shipping = false;

    #[Rule('nullable|bool')]
    public $multi = false;

    public ?int $content_id = null;

    public ?int $course_id = null;

    public $starts_at;

    public $ends_at;

    public array $media;

    public bool $isExternal = false;

    public bool $isCourse = false;

    public function mount(Product $product = null)
    {
        if ($product) {
            $this->name = $product->name;
            $this->description = $product->description;
            $this->price = $product->price;

            $this->isExternal = !empty($product->external_url);
            $this->external_url = $product->external_url;

            $this->shipping = $product->shipping;
            $this->multi = $product->multi;
            $this->product = $product;

            $this->isCourse = !empty($product->course_id);
            $this->content_id = $product->content_id;
            $this->course_id = $product->course_id;
            $this->starts_at = $product->starts_at ? $product->starts_at->format('Y-m-d') : $product->starts_at;
            $this->ends_at = $product->ends_at ? $product->ends_at->format('Y-m-d') : $product->ends_at;

            $this->media = $product->getMedia('media')->map(function ($media) {
                return ['id' => $media->id, 'variant' => 'optimized'];
            })->toArray();
        }
    }

    public function save()
    {
        $this->validate();
        $properties = [...$this->only(['name', 'description', 'price', 'external_url', 'shipping', 'multi', 'content_id', 'course_id', 'starts_at', 'ends_at']), 'billing_type' => BillingType::ONE_TIME];

        if (isset($this->product->id)) {
            $this->product->update(
                $properties
            );
            $this->product->save();
        } else {
            $this->product = Product::create(
                $properties
            );
        }

        $this->product->detachMediaTags('media');

        collect($this->media)->each(function ($media) {
            $this->product->attachMedia($media['id'], 'media');
        });

        $this->close(andDispatch: [
            ProductTable::class => 'refreshComponent',
        ]);
    }

    #[On('updateContent')]
    public function updateContent($value)
    {
        if(!is_numeric($value)) { $this->content_id = null; } else { $this->content_id = (int) $value; };
    }

    public function render()
    {

        return view('sitebrew::livewire.shop.edit-product', [
            'courses' => Course::all(),
        ]);
    }

    public static function attributes(): array
    {
        return [
            'size' => 'xl',
        ];
    }

    public function setIsExternal(bool $value)
    {
        $this->isExternal = $value;
        if($this->isExternal) {
            $this->shipping = false;
            $this->multi = false;

            // clear all values
            $this->setIsCourse(true);
            $this->setIsCourse(false);
        } else {
            $this->external_url = null;
            $this->setIsCourse($this->isCourse);
        }
    }

    public function setIsCourse(bool $value)
    {
        $this->isCourse = $value;
        if($this->isCourse) {
            $this->content_id = null;
        } else {
            $this->course_id = null;
            $this->ends_at = null;
            $this->starts_at = null;
        }
    }

    public function openBlockEditor() {
        $data = [];
        if(!empty($this->description)) {
            $data = $this->description;
        } else {
            $data['template']['attributes']['product'] = $this->product->id;
        }

        $this->dispatch('modal.open', component: 'sitebrew::block-editor', arguments: ['usage' => TemplateUsage::SHOP_PRODUCT, 'data' => $data, 'id' => 'product-' . $this->product->id ] );
    }

    #[On('saveBlocks')]
    public function saveBlocks($data, $id)
    {
        if($id == 'product-' . $this->product->id) {
            $this->description = $data;
        }
    }


}
