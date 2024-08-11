<?php

namespace Daugt\Misc;

use Illuminate\Support\Collection;
use Daugt\Data\Content\ContentTypeData;
use Daugt\Data\Listing\ListingTypeData;

class ListingTypeRegistry
{

    /**
     * @var Collection<string, ListingTypeData>
     */
    protected static Collection $listingTypes;

    public static function registerListingTypes(array $listingTypes): void
    {
        if(!isset(self::$listingTypes)) {
            self::$listingTypes = new Collection();
        }
        foreach ($listingTypes as $key => $listingType) {
            self::$listingTypes->put($key, ListingTypeData::from($listingType));
        }
    }

    public static function getListingTypes(): Collection
    {
        $types = self::$listingTypes;

        ContentTypeRegistry::getContentTypes()->each(function (ContentTypeData $contentType, string $key) use(&$types){
            if($contentType->categorized) {
                $types->put($key . '_categories', ListingTypeData::from([
                    'name' => __('daugt::blocks.content_type_categories', ['contentType' => $contentType->name])
                ]));
            }
        });

        return $types;
    }

    public static function getListingType(string $key): ListingTypeData | null
    {
        return self::$listingTypes->get($key);
    }
}
