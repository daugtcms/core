<?php

namespace Daugt\Livewire\Media;

use Livewire\Features\SupportAttributes\AttributeCollection;
use LivewireUI\Modal\ModalComponent;
use Plank\Mediable\Media;
use Daugt\Helpers\Media\MediaHelper;

class EditMedia extends ModalComponent
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

    public function delete(): void
    {
        MediaHelper::deleteMedia($this->media->id);

        $this->close(withForce: true, andDispatch: [
            MediaManager::class => 'refreshComponent',
        ]);
    }

    public function render()
    {

        return view('daugt::livewire.media.edit-media', [

        ]);
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
}
