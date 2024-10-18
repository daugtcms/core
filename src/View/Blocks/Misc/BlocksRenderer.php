<?php

namespace Daugt\View\Blocks\Misc;

use Daugt\Injectable\TiptapEditor;
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

    public array $blocks;

    public function __construct(array $data = null)
    {

        $this->blocks = $data;
    }

    public function render(): View|Closure|string
    {
        $editor = TiptapEditor::init();
        $editor->setContent($this->blocks);

        return Blade::render('<div class="prose max-w-full">' . $editor->getHTML() . '</div>');
    }
}
