<?php

namespace Sitebrew\Livewire\Media;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Sitebrew\Jobs\Media\SaveUploadedFile;

class MediaUploader extends ModalComponent
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

    public function close() {
        $this->closeModalWithEvents([
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

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }
}
