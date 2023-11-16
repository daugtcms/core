<?php

namespace Sitebrew\Livewire\Media;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Sitebrew\Jobs\Media\SaveUploadedFile;
use WireElements\Pro\Components\Modal\Modal;

class MediaUploader extends Modal
{
    use WithFileUploads;

    #[Rule(['files.*' => 'file'])]
    public $files = [];

    public Collection $savedFiles;

    public function mount()
    {
        $this->savedFiles = collect();
    }

    public function updatedFiles($value)
    {
        foreach ($value as $file) {
            if(!$this->savedFiles->contains($file->getRealPath()))  {
                $this->savedFiles->push($file->getRealPath());
                SaveUploadedFile::dispatch($file->getRealPath(), pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            }
        }
    }

    public function closeModal() {
        $this->close(
            andDispatch: [
            MediaManager::class => 'refreshComponent'
        ]);
    }

    public function render()
    {
        return view('sitebrew::livewire.media.media-uploader', [
        ]);
    }

    public function save() {
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
            'size' => 'md'
        ];
    }
}
