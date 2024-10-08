<?php

namespace Daugt\View\Blocks\Misc;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;
use Daugt\Data\Blocks\TemplateData;
use Daugt\Models\Blocks\Template;
use Daugt\View\Blocks\Block;

class BlocksRenderer extends Component
{
    private Block $templateBlock;

    private Collection $blocks;

    private string $context = 'frontend';

    public function __construct(array $data = null, string $context = 'frontend')
    {
        dd($context);
        if (isset($data)) {
            $this->restoreState($data);
        }
        $this->context = $context;
    }

    public function restoreState($data): void
    {
        dd($data);
        $template = null;
        if (isset($data['template'])) {
            $templateData = TemplateData::from($data['template']);
            $template = Template::findOrFail($templateData->template);
            $templateAttributes = Arr::collapse([$template->data, $templateData->attributes]);
        } else {
            //$this->template = $this->templates[0];
            //$templateAttributes = $this->template->data;
        }

        $this->templateBlock = new Block($this->template->view_name);
        $this->templateBlock->attributes = $templateAttributes;

        if (isset($data['blocks'])) {
            $this->blocks = collect($data['blocks'])->map(function ($block) {
                $blockAttributes = $block['attributes'];
                data_forget($blockAttributes, 'uuid');
                $newBlock = new Block($block['block']);
                $newBlock->attributes = $blockAttributes;
                $newBlock->uuid = $block['attributes']['uuid'];

                return $newBlock;
            });
        }
    }

    public static function fromTemplate(Block $templateBlock, Collection $blocks): BlocksRenderer
    {
        $renderer = new BlocksRenderer();
        $renderer->templateBlock = $templateBlock;
        $renderer->blocks = $blocks;
        $renderer->context = 'editor';

        return $renderer;
    }

    public function render(): View|Closure|string
    {
        // TODO: Add placeholder
        $content = '';

        $blocks = collect($this->blocks)->map(function (Block $block) {
            $slot = Blade::render($block->getView(), $block->attributes);

            if ($this->context === 'editor') {
                return Blade::render("<x-daugt::blocks.block-item uuid=\"$block->uuid\">$slot</x-daugt::blocks.block-item>");
            } else {
                return $slot;
            }

            return $slot;
        })->values();
        if (! $blocks->isEmpty()) {
            $content = $blocks->implode("\n");
            if ($this->context === 'editor') {
                $content = Blade::render("<x-daugt::blocks.block-list>$content</x-daugt::blocks.block-list>");
            }
        }

        $slot = Blade::render($this->templateBlock->getView(), $this->templateBlock->attributes + ['slot' => $content]);
        if ($this->context === 'editor') {
            return Blade::render("<x-daugt::layouts.base>$slot</x-daugt::layouts.base>");
        } else {
            return $slot;
        }
    }
}
