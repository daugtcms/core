<?php

namespace Daugt\View\Blocks;

use Closure;
use Daugt\Data\Blocks\BlockData;
use Daugt\Enums\Blocks\AttributeType;
use Daugt\Helpers\Media\MediaHelper;
use Daugt\Models\Blocks\BlockDefaults;
use Daugt\Models\Content\Content;
use Daugt\Models\Listing\Listing;
use Daugt\Models\Listing\ListingItem;
use Daugt\Models\Shop\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Nette\NotImplementedException;
use Daugt\Misc\ThemeRegistry;
use Plank\Mediable\Media;

class Block extends Component
{
    public string $uuid;

    public string $name;

    public $attributes = [];

    public static function getMetadata(): array
    {
        throw new NotImplementedException();
    }

    public function getAttributeValues(): array
    {
        throw new NotImplementedException();
    }

    public function __construct(string $name = null)
    {
        $this->uuid = Str::uuid();
        if (isset($name)) {
            $this->name = $name;
        }
    }

    public static function fromBlockData(BlockData $blockData)
    {
        $block = new Block($blockData->block);
        $block->uuid = $blockData->uuid;
        $block->attributes = $blockData->attributes;
        return $block;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $this->propagateAttributes();
        return Blade::render($this->getView(), $this->attributes);
    }

    public function getView(): string
    {
        return (ThemeRegistry::getThemeBlock($this->name) ?? ThemeRegistry::getThemeTemplate($this->name))->getView();
    }

    public function propagateAttributes() {
        $blockDefaults = BlockDefaults::where('name', $this->name)->first();
        if($blockDefaults) {
            // use array_filter to remove empty arrays/strings
            $this->attributes = array_merge($blockDefaults->attributes, array_filter($this->attributes));
        } else {
            $this->attributes = array_filter($this->attributes);
        }
        foreach ((ThemeRegistry::getThemeBlock($this->name) ?? ThemeRegistry::getThemeTemplate($this->name))->attributes as $key => $value) {
            switch($value->type) {
                case AttributeType::LISTING:
                    if(!isset($this->attributes[$key])) {
                        // set attribute to first item of listing of given type
                        if($value->options['type']) {
                            $listing = Listing::where('type', $value->options['type'])->with('items')->first();
                            $this->attributes[$key] = $listing;
                        }
                    } else {
                        $listing = Listing::where('id', $this->attributes[$key])->with('items')->first();
                        $this->attributes[$key] = $listing;
                    }
                    break;
                case AttributeType::LISTING_ITEM:
                    if(isset($this->attributes[$key])) {
                        $query = ListingItem::query();
                        if(is_array($this->attributes[$key])) {
                            $query = $query->whereIn('id', collect($this->attributes[$key]));
                        } else {
                            $query = $query->where('id', $this->attributes[$key]);
                        }
                        if(isset($value->options['listingType'])) {
                            $query->where('listing_type', $value->options['listingType']);
                        }
                        $this->attributes[$key] = $query->get();
                        if(!isset($value->options['multi']) || !$value->options['multi']) {
                            $this->attributes[$key] = $this->attributes[$key][0];
                        }
                    }
                    break;
                case AttributeType::MEDIA:
                    if(isset($this->attributes[$key]) && isset($this->attributes[$key][0]) && isset($this->attributes[$key][0]['id'])) {
                        $mediaVariants = collect($this->attributes[$key])->mapWithKeys(function($media) {
                            return [$media['id'] => $media['variant']];
                        });

                        $mediaIds = collect($this->attributes[$key])->pluck('id');

                        $mediaList = Media::whereIn('id', $mediaIds)->get()->keyBy('id');

                        $this->attributes[$key] = $mediaIds->map(function($id) use($value, $mediaList, $mediaVariants) {
                            $media = $mediaList[$id];
                            $variant = $mediaVariants[$id] ?? null;

                            $result = ['url' => MediaHelper::getMedia($media, $variant)];

                            if (isset($value->options['withMetadata']) && $value->options['withMetadata']) {
                                $result = array_merge($media->toArray(), $result);
                            }

                            return $result;
                        });

                        if (!isset($value->options['multi']) || !$value->options['multi']) {
                            $this->attributes[$key] = $this->attributes[$key][0];
                        }
                    } else {
                        $this->attributes[$key] = null;
                    }
                    break;
                case AttributeType::PRODUCT:
                    if($this->attributes[$key] instanceof Product) {
                        break;
                    }
                    $product = Product::where('id', $this->attributes[$key])->withMedia(['media'])->firstOrFail();
                    $this->attributes[$key] = $product;
                    break;
                case AttributeType::CONTENT_LIST:
                    if(empty($this->attributes[$key])) {
                        $this->attributes[$key] = [];
                        return;
                    }
                    $list = collect();
                    if($this->attributes[$key]['type']) {
                        $list = Content::where('type', $this->attributes[$key]['type'])->where('enabled', true)->orderBy('published_at', 'desc')->limit(3)->get();
                    }
                    $attributes = [
                        'items' => $list,
                        'type' => $this->attributes[$key]['type']
                    ];
                    $this->attributes[$key] = $attributes;
                    break;
                /*case AttributeType::LINK:
                    if(isset($this->attributes[$key])) {
                        $this->attributes[$key] = json_decode
                    } else {
                        $this->attributes[$key] = null;
                    }
                    break;*/
                default:
                    if(!isset($this->attributes[$key])) {
                        $this->attributes[$key] = null;
                    }
                    break;
            }
        }
    }
}
