<?php

namespace Daugt\Livewire\Blocks;

use Daugt\Data\Blocks\BlockData;
use Daugt\Livewire\Content\ContentEditor;
use LivewireUI\Modal\ModalComponent;

class EditBlockData extends ModalComponent
{

    public array|BlockData $block;

    public $data;

    public function mount(array $block)
    {
        $this->block = BlockData::from($block);
        $this->data = $this->block->attributes;
    }

    public function save()
    {
        $this->block->attributes = $this->data;
        $this->closeModalWithEvents([
            ContentEditor::class => ['blockUpdate', [$this->block]],
        ]);
    }

    public static function behavior(): array
    {
        return [
            'close-on-backdrop-click' => false,
            'close-on-escape' => false,
        ];
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public function render()
    {

        return view('daugt::livewire.blocks.edit-block-data', [
        ]);
    }
}
