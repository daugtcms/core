<?php

namespace Daugt\Livewire\Blocks;

use Daugt\Misc\ThemeRegistry;
use Daugt\Models\Blocks\Template;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BlockDefaultsEditor extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    #[Layout('daugt::components.layouts.admin')]
    public function render()
    {
        return view('daugt::livewire.blocks.block-defaults-editor', [
            'templates' => ThemeRegistry::getThemeTemplates(),
            'blocks' => ThemeRegistry::getThemeBlocks(),
        ]);
    }
}
