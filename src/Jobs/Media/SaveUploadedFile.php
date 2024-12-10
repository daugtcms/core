<?php

namespace Daugt\Jobs\Media;

use Daugt\Jobs\BaseJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Plank\Mediable\Facades\ImageManipulator;
use Plank\Mediable\Facades\MediaUploader;

class SaveUploadedFile extends BaseJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $path;

    public string $filename;

    public int $user_id;

    public bool $user_upload;

    public ?Model $attach_to;

    public string $attach_tag;

    public function __construct($path, $filename = '', bool $user_upload = false, ?Model $attach_to = null, string $attach_tag = 'media')
    {
        $this->path = $path;
        $this->filename = $filename;
        $this->user_id = Auth::id();
        $this->user_upload = $user_upload;
        $this->attach_to = $attach_to;
        $this->attach_tag = $attach_tag;
    }

    public function handle()
    {
        $path = '/' . $this->path;
        $filename = $this->filename;

        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $pathPrefix = !empty($this->user_upload) ? 'user-uploads' : 'media';
        $newPath = '/' . $pathPrefix . '/' . Str::random(64) . '.' . $extension;
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
        $media->user_id = $this->user_id;
        $media->user_upload = $this->user_upload;

        $media->save();

        if(!empty($this->attach_to)) {
            $this->attach_to->attachMedia($media->id, $this->attach_tag);
        }

        if ($media->aggregate_type === 'image') {
            ImageManipulator::createImageVariant($media, 'thumbnail');
            ImageManipulator::createImageVariant($media, 'optimized');
        }

        return $media;
    }
}