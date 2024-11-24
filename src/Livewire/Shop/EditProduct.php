<?php

namespace Daugt\Livewire\Shop;

use Daugt\Data\Shop\ProductHasAccess;
use Daugt\Data\Theme\AttributeData;
use Daugt\Enums\Shop\AccessType;
use Daugt\Enums\Shop\BillingType;
use Daugt\Models\Content\Content;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Daugt\Data\Blocks\TemplateData;
use Daugt\Enums\Listing\ListingUsage;
use Daugt\Enums\Shop\BillingDurationUnit;
use Daugt\Livewire\Content\CoursesTable;
use Daugt\Models\Blocks\Template;
use Daugt\Models\Content\Course;
use Daugt\Models\Listing\Listing;
use Daugt\Models\Listing\Navigation;
use Livewire\Attributes\Rule;
use Daugt\Models\Shop\Product;

class EditProduct extends Component
{
    public Product $product;

    #[Rule('required')]
    public $name = '';

    public ?array $description;

    #[Rule('required')]
    public $price = 0;

    public string $stripe_tax_code_id = '';

    #[Rule('nullable|url')]
    public ?string $external_url = null;

    #[Rule('nullable|bool')]
    public $shipping = false;

    #[Rule('nullable|bool')]
    public $multi = false;

    public array $media;

    public array $categories;

    public bool $isExternal = false;

    /**
     * @var Collection<ProductHasAccess>
     */
    public Collection $hasAccess;

    public function mount($product = null)
    {
        if (isset($product->id)) {
            $this->name = $product->name;
            $this->description = $product->description;
            $this->price = $product->price;

            $this->isExternal = !empty($product->external_url);
            $this->external_url = $product->external_url;

            $this->shipping = $product->shipping;
            $this->multi = $product->multi;
            $this->product = $product;

            $this->media = $product->getMedia('media')->map(function ($media) {
                return ['id' => $media->id, 'variant' => 'optimized'];
            })->toArray();

            $this->categories = $product->categories->map(function ($cat) {
                return $cat->id;
            })->toArray();
        }

        if(empty($product->stripe_tax_code_id)) {
            $this->stripe_tax_code_id = config('daugt.stripe.default_tax_code');
        } else {
            $this->stripe_tax_code_id = $product->stripe_tax_code_id;
        }

        $this->initAccess();
    }

    public function save()
    {
        $this->validate();

        $properties = [...$this->only(['name', 'description', 'price', 'external_url', 'shipping', 'multi', 'stripe_tax_code_id']), 'billing_type' => BillingType::ONE_TIME];

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

        /*if(empty($this->product->description)) {
            $template = Template::where('usage', TemplateUsage::SHOP_PRODUCT)->first();
            $templateAttributes = Arr::collapse([$template->data, ['product' => $this->product->id]]);
            $template = new TemplateData($template->id, $templateAttributes);
            $this->product->description = ['template' => $template->toArray(), 'blocks' => []];
            $this->product->save();
        }*/

        $this->product->detachMediaTags('media');

        collect($this->media)->each(function ($media) {
            $this->product->attachMedia($media['id'], 'media');
        });

        $this->product->categories()->sync($this->categories);


        $this->product->posts()->detach();

        $posts = $this->hasAccess->filter(function ($access) {
            return $access->accessType == 'post';
        });

        $posts->each(function ($post) {
            $this->product->posts()->attach($post->accessId, [
                'type' => $post->type,
                'start_date' => $post->startDate,
                'end_date' => $post->endDate,
                'duration' => $post->duration,
                'duration_unit' => $post->durationUnit,
            ]);
        });

        $this->product->courses()->detach();

        $courses = $this->hasAccess->filter(function ($access) {
            return $access->accessType === 'course';
        });

        $courses->each(function ($course) {
            $this->product->courses()->attach($course->accessId, [
                'type' => $course->type,
                'start_date' => $course->startDate,
                'end_date' => $course->endDate,
                'duration' => $course->duration,
                'duration_unit' => $course->durationUnit,
            ]);
        });

        $this->redirect(route('daugt.admin.shop.product.index'));
    }

    private function initAccess(): void
    {
        $this->hasAccess = collect();

        if (isset($this->product->id)) {
            $this->product->posts->each(function ($post) {
                $this->hasAccess->push(ProductHasAccess::from([
                    'productId' => $this->product->id,
                    'accessId' => $post->id,
                    'accessName' => $post->title,
                    'accessType' => 'post',
                    'type' => $post->pivot->type,
                    'startDate' => $post->pivot->start_date,
                    'endDate' => $post->pivot->end_date,
                    'duration' => $post->pivot->duration,
                    'durationUnit' => $post->pivot->duration_unit,
                ]));
            });

            $this->product->courses->each(function ($course) {
                $this->hasAccess->push(ProductHasAccess::from([
                    'productId' => $this->product->id,
                    'accessId' => $course->id,
                    'accessName' => $course->name,
                    'accessType' => 'course',
                    'type' => $course->pivot->type,
                    'startDate' => $course->pivot->start_date,
                    'endDate' => $course->pivot->end_date,
                    'duration' => $course->pivot->duration,
                    'durationUnit' => $course->pivot->duration_unit,
                ]));
            });
        }
    }

    private function updateAccess($value, $accessType)
    {
        foreach ($value as $postId) {
            $this->hasAccess->push(ProductHasAccess::from([
                'productId' => $this->product->id,
                'accessId' => $postId,
                'accessName' => $accessType === 'post' ? Content::find($postId)->title : Listing::find($postId)->name,
                'accessType' => $accessType
            ]));
        }
    }

    public function removeAccess($index) {
        $this->hasAccess->forget($index);
    }

    public function setAccessType($index, $value) {
        $this->hasAccess[$index]->type = AccessType::from($value);
    }

    #[On('updatePosts')]
    public function updatePosts($value)
    {
        $this->updateAccess($value, 'post');
    }

    #[On('updateCourses')]
    public function updateCourses($value)
    {
        $this->updateAccess($value, 'course');
    }

    #[Layout('daugt::components.layouts.admin')]
    public function render()
    {

        return view('daugt::livewire.shop.edit-product', [
            // 'courses' => Listing::where('usage', ListingUsage::COURSE)->get(),
        ]);
    }

    public function setIsExternal(bool $value)
    {
        $this->isExternal = $value;
        if($this->isExternal) {
            $this->shipping = false;
            $this->multi = false;
        } else {
            $this->external_url = null;
        }
    }
}
