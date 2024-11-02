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
        $this->content = $content;
    }

    public function render(): View|Closure|string
    {
        $content = '';
        if (!empty($this->content->blocks)) {
            $editor = TiptapEditor::init();
            $editor->setContent($this->content->blocks);
            $content = $editor->getHTML();
        }
        // render blade component templaterenderer
        return Blade::render('<x-daugt::template-renderer :template="$template" :attributes="$attributes" :title="$title"><div class="prose max-w-full">' . $content . '</div></x-daugt::template-renderer>', [
            'template' => $this->content->template,
            'attributes' => [...$this->content->attributes, 'content' => $this->content->only(Content::$fieldsForTemplateUsage)],
            'title' => $this->content->title,
        ]);
    }
}
