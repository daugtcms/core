<?php

namespace Daugt\Helpers\Content;

use Daugt\Misc\ContentTypeRegistry;
use Daugt\Models\Content\Content;

class ContentResolver
{
    public static function resolve($first = null, $second = null)
    {
        $types = ContentTypeRegistry::getContentTypes();

        // If the first parameter is empty, show the first content type without a path
        $contentTypeWithoutPath = $types->search(function ($type) use ($first) {
            return empty($type->path);
        });

        if (!$first && $contentTypeWithoutPath) {
            return [
                'type' => $contentTypeWithoutPath,
                'slug' => null,
            ];
        }

        // Check if the first parameter is a content type (could also be a content slug)
        $firstIsContentType = $types->contains(function ($type) use ($first) {
            return $type->path === $first;
        });

        if (!$firstIsContentType) {
            $second = $first;
            $first = $types->search(function ($type) use ($first) {
                return empty($type->path);
            });
        }

        return [
            'type' => $first,
            'slug' => $second,
        ];
    }

    public static function getContent($type, $slug = null)
    {
        $query = Content::where('type', $type)->where('enabled', true);

        if ($slug) {
            $query->where('slug', $slug);
        } else {
            $query->whereNull('slug')->orWhere('slug', '');
        }

        return $query->firstOrFail();
    }
}
