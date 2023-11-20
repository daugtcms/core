<?php

namespace Sitebrew\Livewire\Blocks;

use Sitebrew\Models\Blocks\Template;
use Sitebrew\View\Blocks\Block;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use WireElements\Pro\Components\Modal\Modal;

class EditTemplate extends Modal
{
    public int|Template $template;

    #[Rule('required')]
    public $name = '';

    #[Rule('required')]
    public $view_name = '';

    #[Rule('required')]
    public $usage = '';

    public $data;

    public $available_blocks = [];

    public ?Block $templateBlock;

    public bool $limitBlocks = false;

    public function mount(Template $template = null)
    {
        if ($template) {
            $this->template = $template;
            $this->name = $template->name;
            $this->view_name = $template->view_name;
            $this->data = $template->data;
            $this->usage = $template->usage;
            $this->available_blocks = $template->available_blocks ?? [];

            if(count($this->available_blocks) > 0) {
                $this->limitBlocks = true;
            }

            if ($this->view_name) {
                $this->updateViewName();
            }

        }
    }

    private function updateViewName()
    {
        $view_name = config('sitebrew.available_templates')[$this->view_name];
        $this->templateBlock = new $view_name();
    }

    public function updated($name, $value)
    {
        if (Str::startsWith($name, 'view_name')) {
            $this->updateViewName();
            $this->data = [];
            foreach ($this->templateBlock::getMetadata()['attributes'] as $attributeName => $attribute) {
                $this->data[$attributeName] = $this->templateBlock->$attributeName;
            }
        }
    }

    public function save()
    {
        $this->validate();

        if(!$this->limitBlocks) {
            $this->available_blocks = null;
        }
        if (isset($this->template->id)) {
            $this->template->update(
                $this->only(['name', 'view_name', 'data', 'usage', 'available_blocks'])
            );
            $this->template->save();
        } else {
            Template::create(
                $this->only(['name', 'view_name', 'data', 'usage', 'available_blocks'])
            );
        }

        $this->close(
            andDispatch: [
                TemplateEditor::class => 'refreshComponent',
            ]);
    }

    public static function behavior(): array
    {
        return [
            'close-on-backdrop-click' => false,
            'close-on-escape' => false,
        ];
    }

    public function render()
    {

        return view('sitebrew::livewire.blocks.edit-template', [

        ]);
    }
}
