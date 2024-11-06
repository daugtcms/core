<?php

namespace Daugt\View\Blocks\Misc;

use Daugt\Misc\ThemeRegistry;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;
use Daugt\Data\Blocks\TemplateData;
use Daugt\Models\Blocks\Template;
use Daugt\View\Blocks\Block;

class TemplateRenderer extends Component
{
    private Block $templateBlock;

    public string $template;

    public bool $withinTemplate = false;

    public ?string $title;

    public function __construct(string $template = null, string $usage = null, bool $withinTemplate = false, $attributes = null, string $title = null)
    {
        if(empty($template)) {
            $this->template = ThemeRegistry::getDefaultTemplate($usage);
        } else {
            $this->template = $template;
        }

        $this->withinTemplate = $withinTemplate;
        $this->restoreState($attributes);

        $this->title = $title;
    }

    public function restoreState($attributes): void
    {
        // $template = ThemeRegistry::getThemeTemplate($this->template);
        // $this->templateBlock = ThemeRegistry::getThemeTemplate($template->view_name);
        $this->templateBlock = new Block($this->template);
        $this->templateBlock->attributes = $attributes;
    }

    public function render(): \Closure
    {
        return function (array $data) {
            $slot = $data['slot'];
            //return view('daugt::components.blocks.template-renderer', ['content' => Blade::render($this->templateBlock->getView(), $this->templateBlock->attributes + ['slot' => $slot])]);
            $this->templateBlock->attributes['slot'] = $slot;
            return view('daugt::components.blocks.template-renderer', ['content' => $this->templateBlock->render(), 'title' => $this->title]);
        };
    }
}
