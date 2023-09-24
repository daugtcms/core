<?php

namespace Felixbeer\SiteCore\Livewire;

use Felixbeer\SiteCore\Blocks\View\Blocks\Block;
use Felixbeer\SiteCore\Blocks\View\Blocks\Header;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;

class BlockEditor extends Component
{

    public $title = '';

    public Collection $blocks;

    public function mount()
    {
        $this->blocks = collect([new Header()]);
    }

    public function render()
    {
        if(empty($this->title)) {
            $this->title = Lang::get('site-core::blocks.title');
        }
        return view('site-core::livewire.block-editor', [
            'availableBlocks' => config('site-core.available_blocks')
        ]);
    }

    public function addBlock(string $blockName) {
        $this->blocks->add(new $blockName());
        return $this->blocks;
    }

    public function getBlocks() {
        return $this->blocks;
    }
}
