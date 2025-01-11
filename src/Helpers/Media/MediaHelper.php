<?php

namespace Daugt\Helpers\Media;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Plank\Mediable\Media;

class MediaHelper
{
    public static function getMediaById(int $mediaId, $type, $isAvatar = false, $ttl = 12) {
        $media = Media::find($mediaId);
        return static::getMedia($media, $type, $isAvatar, $ttl);
    }
    /**
     * Get a media URL, with caching.
     *
     * @param Media|null $media
     * @param string $type
     * @param bool $isAvatar
     * @param int $ttl (in hours)
     * @return string
     */
    public static function getMedia(?Media $media, $type, $isAvatar = false, $ttl = 12)
    {
        // Decide which default SVG to use
        $default = $isAvatar ? 'avatar' : 'image';

        // If there's no Media at all, return the default immediately (no cache).
        if (!$media) {
            return '/vendor/daugt/icons/default/' . $default . '.svg';
        }

        // Build a cache key that uniquely identifies this media and "type"
        $cacheKey = "media_{$media->id}_{$type}";

        // 1) Try fetching a previously cached URL
        $cachedUrl = Cache::get($cacheKey);
        if ($cachedUrl) {
            // If we found something in cache, return it immediately (no DB query)
            return $cachedUrl;
        }

        // 2) Not cached yet: decide behavior based on media type
        switch ($media->aggregate_type) {
            // ----- IMAGES -----
            case Media::TYPE_IMAGE:
                // Find the requested variant
                $variant = $media->findVariant($type);
                if (!$variant) {
                    // If the variant doesn't exist, return fallback (not cached)
                    return '/assets/default/' . $default . '.svg?' . random_int(1000, 9999);
                }

                // We have a real variant URL. Let's cache it, so we skip DB next time.
                $url = $variant->getTemporaryUrl(now()->addHours($ttl));
                Cache::put($cacheKey, $url, 3600); // 1 hour, or whatever TTL you prefer
                return $url;

            // ----- SVG / VECTORS -----
            case Media::TYPE_IMAGE_VECTOR:
                // We do want to cache vectors
                $url = $media->getTemporaryUrl(now()->addHours($ttl));
                Cache::put($cacheKey, $url, 3600);
                return $url;

            // ----- OTHER TYPES (AUDIO, VIDEO, DOCUMENT, ETC.) -----
            default:
                // If "thumbnail," return the default icon (no caching).
                if ($type === 'thumbnail') {
                    $url = '/vendor/daugt/icons/default/';
                    switch ($media->aggregate_type) {
                        case Media::TYPE_AUDIO:
                            $url .= 'audio.svg';
                            break;
                        case Media::TYPE_VIDEO:
                            $url .= 'video.svg';
                            break;
                        case Media::TYPE_DOCUMENT:
                            $url .= 'document.svg';
                            break;
                        default:
                            $url .= 'image.svg';
                            break;
                    }
                    // Return fallback icon with random query string. No caching.
                    return $url . '?' . random_int(1000, 9999);
                }

                // If type is "optimized" or empty, let’s cache the direct file URL
                if (empty($type) || $type == 'optimized') {
                    $url = $media->getTemporaryUrl(now()->addHours($ttl));
                    Cache::put($cacheKey, $url, 3600);
                    return $url;
                }

                // If for some reason none of these matched, fallback
                return '/assets/default/' . $default . '.svg?' . random_int(1000, 9999);
        }
    }


    public static function deleteMedia($id)
    {
        $media = Media::findOrFail($id);
        $media->getAllVariants()->each(function ($variant) {
            $variant->delete();
        });
        $media->delete();
    }

    public static function deleteAllMediaFromModel($model, $tag = null)
    {
        if ($tag) {
            $model->getMedia($tag)->each(function ($media) {
                static::deleteMedia($media->id);
            });
        } else {
            $model->media()->each(function ($media) {
                static::deleteMedia($media->id);
            });
        }
    }
}
