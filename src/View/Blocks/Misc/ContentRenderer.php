<?php

namespace Daugt\View\Blocks\Misc;

use Daugt\Data\Blocks\TemplateData;
use Daugt\Injectable\TiptapEditor;
use Daugt\Models\Blocks\BlockDefaults;
use Daugt\Models\Blocks\Template;
use Daugt\Models\Content\Content;
use Daugt\View\Blocks\Block;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;
use Tiptap\Core\Node;

class ContentRenderer extends Component
{
    private Content $content;

    public function __construct(Content $content)
    {
        /*if (isset($content)) {
            $this->restoreState($content);
        }*/
        $this->content = $content;
    }

    public function restoreState($data): void
    {
        /*$template = null;
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
        }*/
    }

    /*public static function fromTemplate(Block $templateBlock, Collection $blocks): ContentRenderer
    {
        $renderer = new ContentRenderer();
        $renderer->templateBlock = $templateBlock;
        $renderer->blocks = $blocks;
        $renderer->context = 'editor';

        return $renderer;
    }*/

    public function render(): View|Closure|string
    {
        $editor = TiptapEditor::init();
        $editor->setContent($this->content->blocks);

        // render blade component templaterenderer
        return Blade::render('<x-daugt::template-renderer :template="$template" :attributes="$attributes"><div class="prose max-w-full">' . $editor->getHTML() . '</div></x-daugt::template-renderer>', [
            'template' => $this->content->template,
            'attributes' => $this->content->attributes,
        ]);
    }
}
