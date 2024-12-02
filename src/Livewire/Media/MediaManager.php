<?php

namespace Daugt\Livewire\Media;

use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;
use Plank\Mediable\Media;
use Daugt\Data\Media\MediaPickerData;

class MediaManager extends ModalComponent
{
    use WithPagination;

    public bool $isPicker = false;

    // id is used to identify the component when multiple instances are used on the same page
    public string $id;

    public Collection $selectedMedia;

    public array $selectedMediaArray = [];

    #[Url]
    public string $search = '';

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

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->selectedMedia = collect($this->selectedMediaArray);
        $this->selectedMedia = $this->selectedMedia->map(function ($item) {
            return MediaPickerData::from($item);
        });
        unset($this->selectedMediaArray);

        if (! isset($this->selectedMedia)) {
            $this->selectedMedia = collect();
        }
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    #[Layout('daugt::components.layouts.admin')]
    public function render()
    {
        $query = Media::whereNull('original_media_id')->where('user_upload', false)->orderBy('created_at', 'desc')->with('variants');
        if (! empty($this->search)) {
            $query->where('name', 'ILIKE', '%' . $this->search . '%');
        }
        $media = $query->paginate(48);

        return view('daugt::livewire.media.media-manager', [
            'files' => $media,
        ]);
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function selectFile($id, $variant = 'optimized')
    {
        if ($this->isPicker) {
            if ($this->selectedMedia->contains('id', $id)) {
                $this->selectedMedia = $this->selectedMedia->reject(function ($item) use ($id) {
                    return $item->id == $id;
                })->values();
            } else {
                $media = Media::findOrFail($id);

                if ($media->hasVariant($variant)) {
                    $element = new MediaPickerData($id, $variant);
                } else {
                    $element = new MediaPickerData($id);
                }

                $this->selectedMedia->push($element);
            }
        } else {
            $this->dispatch('openModal', 'daugt::media.edit-media', [
                'media' => $id,
            ]);
        }
    }

    public function close()
    {
        $this->closeModalWithEvents(
            [
                ['mediaSelected', [$this->selectedMedia, $this->id]],
            ]
        );
    }
}
