<?php

namespace Daugt\Livewire\Content;

use Daugt\Data\Blocks\BlockData;
use Daugt\Enums\Content\ContentGroup;
use Daugt\Injectable\TiptapEditor;
use Daugt\Misc\ThemeRegistry;
use Daugt\Misc\TiptapBlock;
use Daugt\Models\Content\Content;
use Daugt\View\Blocks\Block;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite;
use Livewire\Attributes\Modelable;
use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;

class ContentEditor extends \Livewire\Component
{
    #[Modelable]
    public $content;

    public $processedContent;

    public ContentGroup $group;

    public Collection $availableBlocks;

    public $listeners = [
        'blockUpdate' => 'blockUpdate',
    ];

    public function mount()
    {
        if ($this->content) {
            $editor = TiptapEditor::init();

            $editor->setContent($this->content);
            $editor->descendants(function (&$node) {
                if ($node->type == 'Block') {
                    $block = new Block($node->attrs->block);
                    $block->uuid = $node->attrs->uuid;
                    $block->attributes = json_decode(json_encode($node->attrs->data), true);
                    $node->attrs->preview = Blade::render($block->getView(), $block->attributes);
                    $node->attrs->styleUrl = Vite::asset('resources/css/app.css');
                    $node->attrs->label = ThemeRegistry::getThemeBlock($node->attrs->block)->name;
                }
            });
            $this->processedContent = $editor->getDocument();
        }
    }

    public function render()
    {
        $this->availableBlocks = ThemeRegistry::getThemeBlockByGroup($this->group);

        return view('daugt::livewire.content.content-editor');
    }

    public function updated($name, $value)
    {
        if ($name === 'processedContent') {
            $editor = TiptapEditor::init();

            $editor->setContent($this->processedContent);
            $editor->descendants(function (&$node) {
                if ($node->type == 'Block') {
                    unset($node->attrs->preview);
                    unset($node->attrs->styleUrl);
                    unset($node->attrs->label);
                }
            });
            $this->content = $editor->getDocument();
        }
    }

    public function insertBlock($key)
    {
        $themeBlock = ThemeRegistry::getThemeBlock($key);
        $block = new Block($key);
        $block->attributes = ThemeRegistry::getThemeBlockAttributes($key);
        $this->dispatch(
            event: 'insertBlock',
            uuid: $block->uuid,
            block: $key,
            label: $themeBlock->name,
            data: $block->attributes,
            preview: Blade::render($block->getView(), $block->attributes),
            styleUrl: Vite::asset('resources/css/app.css'),
        );
    }

    public function blockUpdate($block): void
    {
        $editor = TiptapEditor::init();

        $editor->setContent($this->processedContent);
        $block = BlockData::from($block);
        $editor->descendants(function (&$node) use ($block) {
            if ($node->type == 'Block') {
                if ($node->attrs->uuid == $block->uuid) {
                    $realBlock = new Block($block->block);
                    $realBlock->uuid = $block->uuid;
                    $realBlock->attributes = $block->attributes;

                    $themeBlock = ThemeRegistry::getThemeBlock($block->block);
                    $this->dispatch(
                        event: 'updateBlock',
                        uuid: $block->uuid,
                        block: $block->block,
                        label: $themeBlock->name,
                        coordinates: $block->coordinates,
                        data: $block->attributes,
                        preview: Blade::render($realBlock->getView(), $block->attributes),
                        styleUrl: Vite::asset('resources/css/app.css'),
                    );
                }
            }
        });
    }

    public function openBlockSettings($uuid, $coordinates)
    {
        // get block by uuid
        $editor = TiptapEditor::init();

        $editor->setContent($this->processedContent);
        $editor->descendants(function (&$node) use ($uuid, $coordinates) {
            if ($node->type == 'Block') {
                if ($node->attrs->uuid == $uuid) {
                    $block = new BlockData($node->attrs->block, $node->attrs->uuid, json_decode(json_encode($node->attrs->data), true), $coordinates);
                    $this->dispatch('openModal', 'daugt::blocks.edit-block-data', [
                        'block' => $block,
                    ]);
                }
            }
        });
    }
}
