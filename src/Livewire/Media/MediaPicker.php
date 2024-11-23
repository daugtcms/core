<?php

namespace Daugt\Livewire\Media;

use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Plank\Mediable\Media;
use Daugt\Data\Media\MediaPickerData;

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
    public ListingItemData $currentItem;*/

    protected $listeners = ['refreshComponent' => '$refresh', 'mediaSelected' => 'mediaSelected'];

    public function mount()
    {
        $this->selectedMedia = collect();
        $this->fetchedMedia = collect();
    }

    #[Layout('daugt::components.layouts.admin')]
    public function render()
    {
        return view('daugt::livewire.media.media-picker', [

        ]);
    }

    public function mediaSelected($media, $key = '') {
        if (!empty($key) && $key != $this->id) {
            return;
        }

        $this->selectedMedia = collect($media)->map(function($item) {
            return MediaPickerData::from($item);
        });

        $mediaIds = $this->selectedMedia->pluck('id');

        $fetchedMediaList = Media::whereIn('id', $mediaIds)->get()->keyBy('id');

        $this->fetchedMedia = $mediaIds->map(function($id) use ($fetchedMediaList) {
            return $fetchedMediaList[$id];
        });

        $this->dispatch('picker-updated', $this->selectedMedia->values(), $this->id);

    }

    public function removeMedia($mediaId) {
        $this->selectedMedia = $this->selectedMedia->filter(function($item) use ($mediaId) {
            return $item->id != $mediaId;
        });
        $this->fetchedMedia = Media::whereIn('id', $this->selectedMedia->pluck('id'))->get();
        $this->dispatch('picker-updated', $this->selectedMedia->values(), $this->id);
    }

    public function updateMediaOrder($items): void
    {
        $orderItems = collect($items)->map(function ($item) {
            return $item['value'];
        })->toArray();

        $this->fetchedMedia = $this->fetchedMedia->sortBy(function ($item) use ($orderItems) {
            return array_search($item->id, $orderItems);
        })->values();

        $this->selectedMedia = $this->selectedMedia->sortBy(function ($item) use ($orderItems) {
            return array_search($item->id, $orderItems);
        })->values();

        $this->dispatch('picker-updated', $this->selectedMedia->values(), $this->id);
    }
}
