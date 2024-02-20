<?php

namespace Sitebrew\Livewire\Blocks;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Sitebrew\Data\Blocks\BlockData;
use Sitebrew\Data\Blocks\BlockEditorData;
use Sitebrew\Data\Blocks\TemplateData;
use Sitebrew\Enums\Blocks\BlockEditorSidebar;
use Sitebrew\Models\Blocks\Template;
use Sitebrew\View\Blocks\Block;
use Sitebrew\View\Blocks\Misc\BlocksRenderer;
use Sitebrew\View\ThemeRegistry;
use WireElements\Pro\Components\Modal\Modal;

class BlockEditor extends Modal
{
    public $listeners = [
        'blockSelected' => 'setActiveBlock',
    ];

    public $title = '';

    public BlockEditorSidebar $sidebarState = BlockEditorSidebar::TEMPLATE;

    public Collection $blocks;

    public ?Block $activeBlock;

    public Collection $templates;

    public Template $template;

    public Block $templateBlock;

    public $id = 0;

    public function mount($usage, array $data = null): void
    {
        if (empty($this->templates)) {
            $this->templates = Template::where('usage', $usage)->get();
        }

        $this->template = $this->templates[0];

        $this->restoreState($data ?? []);
    }

    public function restoreState(array $data): void
    {
        if (isset($data['template']['template'])) {
            $templateData = TemplateData::from($data['template']);
            $this->template = Template::findOrFail($templateData->template);
            $templateAttributes = Arr::collapse([ThemeRegistry::getThemeTemplateAttributes($this->template->block_name), $this->template->data, $templateData->attributes]);
        } else {
            $this->template = $this->templates[0];
            $templateAttributes = Arr::collapse([ThemeRegistry::getThemeTemplateAttributes($this->template->block_name), $this->template->data, $data['template']['attributes'] ?? []]);
        }
        $this->templateBlock = new Block($this->template->block_name);
        $this->templateBlock->attributes = $templateAttributes;

        if (isset($data['blocks'])) {
            $this->blocks = collect($data['blocks'])->map(function ($block) {
                $blockAttributes = $block['attributes'];
                $blockAttributes = Arr::collapse([ThemeRegistry::getThemeBlockAttributes($block['block']), $blockAttributes]);
                $newBlock = new Block($block['block']);
                $newBlock->attributes = $blockAttributes;
                $newBlock->uuid = $block['uuid'];

                return $newBlock;
            });
        } else {
            $this->blocks = collect([]);
        }
    }

    public function render()
    {
        if (empty($this->title)) {
            $this->title = Lang::get('sitebrew::blocks.title');
        }

        return view('sitebrew::livewire.blocks.block-editor', [
            'availableBlocks' => $this->getAvailableBlocks(),
            'viewContent' => BlocksRenderer::fromTemplate($this->templateBlock, $this->blocks)->render(),
        ]);
    }

    public function save()
    {
        $template = new TemplateData($this->template->id, $this->templateBlock->attributes);

        $blocks = BlockData::collection([]);
        $this->blocks->map(function ($block) use (&$blocks) {
            // get index of available_blocks
            $blocks[] = new BlockData($block->name, $block->uuid, $block->attributes);
        })->values();

        // $this->dispatch('save-blocks', (new BlockEditorData($template, $blocks))->toArray());
        $this->close(
            andDispatch: [
                'saveBlocks' => [(new BlockEditorData($template, $blocks))->toArray(), $this->id],
            ]
        );
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
        }
    }

    public function addBlock(string $blockName)
    {
        $block = new Block($blockName);

        $block->attributes = ThemeRegistry::getThemeBlockAttributes($blockName);

        $this->blocks->add($block);
        $this->setActiveBlock($this->blocks->last()->uuid);

        return $this->blocks;
    }

    public function getBlocks()
    {
        return $this->blocks;
    }

    public function setActiveBlock(string $uuid)
    {
        $this->activeBlock = $this->blocks->firstWhere('uuid', $uuid);
        $this->sidebarState = BlockEditorSidebar::BLOCK;
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
        // $this->activeBlock = new Block();
        $this->sidebarState = BlockEditorSidebar::TEMPLATE;
    }

    public function setSidebarState(string $state)
    {
        $state = BlockEditorSidebar::from($state);
        if ($state != BlockEditorSidebar::BLOCK) {
            $this->unsetActiveBlock(false);
        }
        $this->sidebarState = $state;
    }

    public function reorder($list)
    {
        $this->blocks = collect($list)->map(function ($uuid) {
            return $this->blocks->firstWhere('uuid', $uuid);
        });
    }

    public static function attributes(): array
    {
        return [
            // Set the modal size to 2xl, you can choose between:
            // xs, sm, md, lg, xl, 2xl, 3xl, 4xl, 5xl, 6xl, 7xl, fullscreen
            'size' => 'fullscreen',
        ];
    }

    public static function behavior(): array
    {
        return [
            'remove-state-on-close' => true,
        ];
    }

    public function getAvailableBlocks()
    {
        return ThemeRegistry::getThemeBlocks();
        $blocks = $this->template->available_blocks;
        if (! empty($blocks)) {
            return collect($blocks)->map(function ($block) {
                return config('sitebrew.available_blocks')[$block];
            })->values();
        } else {
            return config('sitebrew.available_blocks');
        }
    }
}
