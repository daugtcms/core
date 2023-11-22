<?php

namespace Sitebrew\View\Blocks\Misc;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;
use Sitebrew\Data\Blocks\TemplateData;
use Sitebrew\Enums\Blocks\TemplateUsage;
use Sitebrew\Models\Blocks\Template;
use Sitebrew\View\Blocks\Block;

class TemplateRenderer extends Component
{
    private Block $templateBlock;

    public string $usage;

    public bool $withinTemplate = false;

    public function __construct(string $usage, bool $withinTemplate = false, $attributes = null)
    {
        $this->withinTemplate = $withinTemplate;
        $this->usage = $usage;
        $this->restoreState($attributes);
    }

    public function restoreState($attributes): void
    {
        $template = Template::where('usage', $this->usage)->first();
        $templateAttributes = Arr::collapse([$template->data, $attributes]);;
        $this->templateBlock = new (config('sitebrew.available_templates')[$template->view_name])(...$templateAttributes);
    }

    public function render(): \Closure
    {
        return function (array $data) {
            $slot = $data['slot'];
            return view('sitebrew::components.blocks.template-renderer', ['content' => Blade::render($this->templateBlock::getMetadata()['viewName'], $this->templateBlock->getAttributeValues() + ['slot' => $slot])]);
        };
    }
}
