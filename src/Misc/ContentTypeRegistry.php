<?php

namespace Sitebrew\Misc;

use Illuminate\Support\Collection;
use Sitebrew\Data\Content\ContentTypeData;
use Sitebrew\Data\Theme\ThemeData;

class ContentTypeRegistry
{
    /**
     * @var Collection<string, ContentTypeData>
     */
    protected static Collection $contentTypes;

    public static function registerContentTypes(array $contentTypes)
    {
        if (!isset(self::$contentTypes)) {
            self::$contentTypes = new Collection();
        }

        foreach ($contentTypes as $key => $contentType) {
            self::$contentTypes->put($key, ContentTypeData::from($contentType));
        }
    }

    public static function getContentTypes()
    {
        return self::$contentTypes;
    }

    public static function getContentType(string $name)
    {
        return self::$contentTypes->get($name) ?? null;
    }
}
