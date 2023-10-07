<?php

namespace Felixbeer\SiteCore\Livewire\Blocks;

use Felixbeer\SiteCore\Blocks\View\Blocks\Block;
use Felixbeer\SiteCore\Blocks\View\Blocks\Header;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BlockEditor extends Component
{
    public $title = '';

    public $currentlyEditingBlock = false;

    public Collection $blocks;

    public ?Block $activeBlock;

    public function mount()
    {
        $this->blocks = collect([new Header()]);
    }

    #[Layout('site-core::components.layouts.app')]
    public function render()
    {
        if (empty($this->title)) {
            $this->title = Lang::get('site-core::blocks.title');
        }

        return view('site-core::livewire.blocks.block-editor', [
            'availableBlocks' => config('site-core.available_blocks'),
        ]);
    }

    public function updated($name, $value)
    {
        if (Str::startsWith($name, 'activeBlock')) {
            $this->blocks = $this->blocks->map(function ($block) {
                if ($block->uuid === $this->activeBlock->uuid) {
                    $block = $this->activeBlock;
                }

                return $block;
            });
            $this->dispatch('$refresh');
        }
    }

    public function addBlock(string $blockName)
    {
        $this->blocks->add(new $blockName());

        return $this->blocks;
    }

    public function getBlocks()
    {
        return $this->blocks;
    }

    public function setActiveBlock(string $uuid)
    {
        $this->activeBlock = $this->blocks->firstWhere('uuid', $uuid);
        $this->currentlyEditingBlock = true;
    }

    public function removeBlock(string $uuid)
    {
        $this->blocks = $this->blocks->filter(function ($block) use ($uuid) {
            return $block->uuid !== $uuid;
        });
        $this->unsetActiveBlock();
    }

    public function unsetActiveBlock()
    {
        // setting the active block to a new instance of Block to prevent Livewire from throwing an error and crashing
        // hence also the introduction of the helper boolean
        $this->activeBlock = new Block();
        $this->currentlyEditingBlock = false;
    }
}
