<?php

namespace Daugt\Livewire\Blocks;

use Daugt\Data\Blocks\BlockData;
use Daugt\Data\Theme\ThemeBlockData;
use Daugt\Models\Blocks\BlockDefaults;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;
use Daugt\Misc\ThemeRegistry;
use Daugt\Models\Blocks\Template;

class EditBlockDefaults extends ModalComponent
{
    public string $blockId = '';
    public ThemeBlockData $themeBlock;

    public $data = [];

    public function mount(string $blockId = null)
    {
        $this->blockId = $blockId;
        $this->themeBlock = ThemeRegistry::getThemeBlock($blockId) ?? ThemeRegistry::getThemeTemplate($blockId);
        $this->data = BlockDefaults::where('name', $blockId)->first()->attributes ?? [];
    }

    public function updated($name, $value)
    {
    }

    public function save()
    {
        $defaults = BlockDefaults::where('name', $this->blockId)->first();

        if (!$defaults) {
            $defaults = new BlockDefaults();
            $defaults->name = $this->blockId;
        }
        $defaults->attributes = $this->data;
        $defaults->save();

        $this->closeModalWithEvents([
            BlockDefaultsEditor::class => 'refreshComponent',
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

        return view('daugt::livewire.blocks.edit-block-defaults', [
        ]);
    }
}
