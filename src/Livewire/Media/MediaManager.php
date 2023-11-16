<?php

namespace Sitebrew\Livewire\Media;

use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Plank\Mediable\Media;
use Sitebrew\Data\Media\MediaPickerData;
use WireElements\Pro\Components\Modal\Modal;

class MediaManager extends Modal
{
    use WithPagination;

    public bool $isPicker = false;

    // id is used to identify the component when multiple instances are used on the same page
    public string $id;

    public Collection $selectedMedia;

    public array $selectedMediaArray = [];

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
        $this->selectedMedia = collect($this->selectedMediaArray);
        $this->selectedMedia = $this->selectedMedia->map(function ($item) {
            return MediaPickerData::from($item);
        });
        unset($this->selectedMediaArray);

        if (!isset($this->selectedMedia)) {
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

    public static function behavior(): array
    {
        return [
            'close-on-backdrop-click' => false,
            'close-on-escape' => false,
        ];
    }

    public static function attributes(): array
    {
        return [
            'size' => '6xl'
        ];
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
        }
    }

    public function closeModal()
    {
        $this->close(
            andDispatch: [
                'mediaSelected' => [$this->selectedMedia, $this->id]
            ]);
    }
}
