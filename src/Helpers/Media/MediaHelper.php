<?php

namespace Daugt\Helpers\Media;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Plank\Mediable\Media;

class MediaHelper
{
    public static function getMediaById(int $mediaId, $type, $isAvatar = false) {
        $media = Media::find($mediaId);
        return static::getMedia($media, $type, $isAvatar);
    }
    public static function getMedia(?Media $media, $type, $isAvatar = false)
    {
        $default = $isAvatar ? 'avatar' : 'image';
        if ($media) {
            return Cache::flexible("media_{$media->id}_{$type}", [60*60, 120*60], function () use ($media, $type, $default) {
                if ($media->aggregate_type == Media::TYPE_IMAGE) {
                    return $media->findVariant($type) ? $media->findVariant($type)->getTemporaryUrl(now()->addHours(12)) : '/assets/default/' . $default . '.svg?' . random_int(1000, 9999);
                } else if($media->aggregate_type == Media::TYPE_IMAGE_VECTOR) {
                    return $media->getTemporaryUrl(now()->addHours(12));
                } else {
                    if ($type == 'thumbnail') {
                        $url = '/vendor/daugt/icons/default/';
                        switch ($media->aggregate_type) {
                            case Media::TYPE_AUDIO:
                                $url = $url.'audio.svg';
                                break;
                            case Media::TYPE_VIDEO:
                                $url = $url.'video.svg';
                                break;
                            case Media::TYPE_DOCUMENT:
                                $url = $url.'document.svg';
                                break;
                            default:
                                $url = $url.'image.svg';
                                break;
                        }

                        return $url.'?'.random_int(1000, 9999);
                    } elseif (empty($type) || $type == 'optimized') {
                        return $media->getTemporaryUrl(now()->addHours(12));
                    }
                }
            });
        } else {
            return '/vendor/daugt/icons/default/' . $default.'.svg';
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
