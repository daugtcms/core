<?php

namespace Sitebrew\Livewire\Media;

use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Plank\Mediable\Media;
use Sitebrew\Data\Media\MediaPickerData;

class MediaPicker extends Component
{
    public bool $isOpen = false;

    public Collection $selectedMedia;

    public Collection $fetchedMedia;

    // id is used to identify the component when multiple instances are used on the same page
    public string $id;

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

    protected $listeners = ['refreshComponent' => '$refresh', 'mediaSelected' => 'mediaSelected'];

    public function mount()
    {
        $this->selectedMedia = collect();
        $this->fetchedMedia = collect();
    }

    #[Layout('sitebrew::components.layouts.admin')]
    public function render()
    {
        return view('sitebrew::livewire.media.media-picker', [

        ]);
    }

    public function mediaSelected($media, $key = '') {
        if(!empty($key) && $key != $this->id) {
            return;
        }
        $this->selectedMedia = collect($media);
        $this->selectedMedia = $this->selectedMedia->map(function($item) {
            return MediaPickerData::from($item);
        });

        $this->fetchedMedia = Media::whereIn('id', $this->selectedMedia->pluck('id'))->get();
        $this->dispatch('picker-updated', $media, $this->id);
    }
}
