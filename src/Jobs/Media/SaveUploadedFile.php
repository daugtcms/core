<?php

namespace Daugt\Jobs\Media;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Plank\Mediable\Facades\ImageManipulator;
use Plank\Mediable\Facades\MediaUploader;

class SaveUploadedFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $path;

    public string $filename;

    public function __construct($path, $filename = '')
    {
        $this->path = $path;
        $this->filename = $filename;
    }

    public function handle()
    {
        $path = '/' . $this->path;
        $filename = $this->filename;

        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $newPath = '/media/' . Str::random(64) . '.' . $extension;
        // dump(config('filesystems.disks.storage'));

        // move file out of livewire-tmp and give random 64 character filename
        Storage::disk('s3')->move($path, $newPath);

        /*$media = MediaUploader::fromSource($path)
            ->useFilename(Str::random(64))
            ->setAllowedAggregateTypes([Media::TYPE_IMAGE, Media::TYPE_AUDIO, Media::TYPE_IMAGE_VECTOR, Media::TYPE_VIDEO, Media::TYPE_PDF, Media::TYPE_ARCHIVE])
            ->beforeSave(function (Media $model) use ($filename) {
                $model->name = $filename;
                $model->user_id = Auth::id();
            })->upload();*/
        $media = MediaUploader::importPath('s3', $newPath);

        $media->name = $filename;
        $media->user_id = Auth::id();

        $media->save();

        if ($media->aggregate_type === 'image') {
            ImageManipulator::createImageVariant($media, 'thumbnail');
            ImageManipulator::createImageVariant($media, 'optimized');
        }

        return $media;
    }
}