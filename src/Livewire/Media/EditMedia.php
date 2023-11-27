<?php

namespace Sitebrew\Livewire\Media;

use Livewire\Features\SupportAttributes\AttributeCollection;
use Plank\Mediable\Media;
use Sitebrew\Helpers\Media\MediaHelper;
use WireElements\Pro\Components\Modal\Modal;

class EditMedia extends Modal
{
    public int|Media $media;

    public function mount(Media $media = null)
    {
        if ($media) {
            $this->media = $media;
        }
    }

    public function save()
    {
    }

    public function delete() {
        MediaHelper::deleteMedia($this->media->id);

        $this->close(withForce: true, andDispatch: [
            MediaManager::class => 'refreshComponent',
        ]);
    }

    public function render()
    {

        return view('sitebrew::livewire.media.edit-media', [

        ]);
    }

    public static function attributes(): array
    {
        return [
            'size' => 'fullscreen',
        ];
    }
}
