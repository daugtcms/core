<?php

namespace Sitebrew\Livewire\Media;

use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;
use Plank\Mediable\Media;
use Sitebrew\Data\Media\MediaPickerData;

class MediaManager extends ModalComponent
{
    use WithPagination;

    public bool $isPicker = false;

    // id is used to identify the component when multiple instances are used on the same page
    public string $id;

    public Collection $selectedMedia;

    /*#[Rule([
        'currentItem' => ['nullable'],
        'currentItem.name' => [
            'required',
        ],
        'currentItem.url' => [
            'required',
        ],
    ])]
    public NavigationItemData $currentItem;*/

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        if(!isset($this->selectedMedia)) {
            $this->selectedMedia = collect();
        }
    }

    #[Layout('sitebrew::components.layouts.admin')]
    public function render()
    {
        $media = Media::whereNull('original_media_id')->with('variants')->paginate(100);
        return view('sitebrew::livewire.media.media-manager', [
            'files' => $media,
        ]);
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public function selectFile($id, $variant = 'optimized') {
        if($this->isPicker) {
            if($this->selectedMedia->contains('id', $id)) {
                $this->selectedMedia = $this->selectedMedia->reject(function($item) use ($id) {
                    return $item->id == $id;
                });
            } else {
                $media = Media::findOrFail($id);

                if($media->hasVariant($variant)) {
                    $element = new MediaPickerData($id, $variant);
                } else {
                    $element = new MediaPickerData($id);
                }

                $this->selectedMedia->push($element);
            }
        }
    }

    public function close() {
        $this->closeModalWithEvents([
            MediaPicker::class => ['mediaSelected', [$this->selectedMedia, $this->id]],
        ]);
    }
}
