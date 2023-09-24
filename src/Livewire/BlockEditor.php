<?php

namespace Felixbeer\SiteCore\Livewire;

use Felixbeer\SiteCore\Blocks\View\Blocks\Block;
use Felixbeer\SiteCore\Blocks\View\Blocks\Header;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Livewire\Component;

class BlockEditor extends Component
{

    public $title = '';

    public Collection $blocks;

    public ?Block $activeBlock;

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

    public function updated($name, $value) {
        if(Str::startsWith($name, 'activeBlock')) {
            $this->blocks = $this->blocks->map(function($block) use ($name, $value) {
                if($block->uuid === $this->activeBlock->uuid) {
                    $block = $this->activeBlock;
                }
                return $block;
            });
            $this->dispatch('$refresh');
        }
    }

    public function addBlock(string $blockName) {
        $this->blocks->add(new $blockName());
        return $this->blocks;
    }

    public function getBlocks() {
        return $this->blocks;
    }

    public function setActiveBlock(string $uuid) {
        $this->activeBlock = $this->blocks->firstWhere('uuid', $uuid);
    }

    public function unsetActiveBlock() {
        $this->activeBlock = null;
    }

    public function removeBlock(string $uuid) {
        $this->blocks = $this->blocks->filter(function($block) use ($uuid) {
            return $block->uuid !== $uuid;
        });
        $this->unsetActiveBlock();
    }
}
