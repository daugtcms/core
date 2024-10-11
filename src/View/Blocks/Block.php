<?php

namespace Daugt\View\Blocks;

use Closure;
use Daugt\Data\Blocks\BlockData;
use Daugt\Enums\Blocks\AttributeType;
use Daugt\Helpers\Media\MediaHelper;
use Daugt\Models\Blocks\BlockDefaults;
use Daugt\Models\Listing\Listing;
use Daugt\Models\Listing\ListingItem;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Nette\NotImplementedException;
use Daugt\Misc\ThemeRegistry;

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
                case AttributeType::MEDIA:
                    if(isset($this->attributes[$key]) && isset($this->attributes[$key][0]) && isset($this->attributes[$key][0]['id'])) {
                        if(isset($value->options) && $value->options['multiple']) {
                            $this->attributes[$key] = $this->attributes[$key]->map(function($media) {
                                return ['url' => MediaHelper::getMediaById($media['id'], $media['variant'])];
                            });
                        } else {
                            $this->attributes[$key] = ['url' => MediaHelper::getMediaById($this->attributes[$key][0]['id'], $this->attributes[$key][0]['variant'])];
                        }
                    } else {
                        $this->attributes[$key] = null;
                    }
                    break;
                default:
                    if(!isset($this->attributes[$key])) {
                        $this->attributes[$key] = "";
                    }
                    break;
            }
        }
    }
}
