<?php

namespace Daugt\Livewire\Media;

use Illuminate\Support\Collection;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Daugt\Jobs\Media\SaveUploadedFile;

class MediaUploader extends ModalComponent
{
    use WithFileUploads;

    #[Rule(['files.*' => 'file'])]
    public $files = [];

    public Collection $savedFiles;

    public function mount(): void
    {
        $this->savedFiles = collect();
    }

    public function updatedFiles($value): void
    {
        foreach ($value as $file) {
            if (! $this->savedFiles->contains($file->getRealPath())) {
                $this->savedFiles->push($file->getRealPath());
                SaveUploadedFile::dispatch($file->getRealPath(), pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            }
        }
    }

    public function close(): void
    {
        $this->closeModalWithEvents([
            MediaManager::class => 'refreshComponent',
        ]);
    }

    public function render()
    {
        return view('daugt::livewire.media.media-uploader', [
        ]);
    }

    public function save()
    {
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
        return 'md';
    }
}
