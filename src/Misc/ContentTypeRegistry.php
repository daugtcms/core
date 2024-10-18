<?php

namespace Daugt\Misc;

use Illuminate\Support\Collection;
use Daugt\Data\Content\ContentTypeData;
use Daugt\Data\Theme\ThemeData;

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

    /**
     * @return Collection<string, ContentTypeData>
     */
    public static function getContentTypes()
    {
        return self::$contentTypes;
    }

    public static function getContentType(string $name)
    {
        return self::$contentTypes->get($name) ?? null;
    }
}
