<?php

namespace Sitebrew\Helpers\Media;

use Illuminate\Support\Facades\Storage;
use Plank\Mediable\Media;

class MediaHelper
{
    public static function getMediaById(int $mediaId, $type, $isAvatar = false) {
        $media = Media::findOrFail($mediaId);
        return static::getMedia($media, $type, $isAvatar);
    }
    public static function getMedia(?Media $media, $type, $isAvatar = false)
    {
        $default = $isAvatar ? 'avatar' : 'image';
        if ($media) {
            if ($media->aggregate_type == Media::TYPE_IMAGE) {
                return $media->findVariant($type) ? $media->findVariant($type)->getUrl() : '/assets/default/' . $default . '.svg?' . random_int(1000, 9999);
            } else if($media->aggregate_type == Media::TYPE_IMAGE_VECTOR) {
                return $media->getUrl();
            } else {
                if ($type == 'thumbnail') {
                    $url = Storage::disk('sitebrew-media')->url('/default/');
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
                    return $media->getUrl();
                }
            }
        } else {
            return Storage::disk('sitebrew-media')->url('/default/'.$default.'.svg');
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

    public static function getTypeName($type): string
    {
        return match ($type) {
            'posting' => 'Postings',
            'meditation' => 'Meditationen',
            'seelenkonferenz' => 'Seelenkonferenzen',
            'inspiration' => 'Inspirationen',
            'antwort' => 'Antworten',
            'audiovideo' => 'Audio & Video',
            'dokument' => 'Dokumente',
            'shop' => 'Shop-Posts',
            'blog' => 'Blog',
            default => '',
        };
    }
}
