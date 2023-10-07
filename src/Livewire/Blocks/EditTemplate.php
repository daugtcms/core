<?php

namespace Felixbeer\SiteCore\Livewire\Blocks;

use Felixbeer\SiteCore\Blocks\Models\Template;
use Felixbeer\SiteCore\Blocks\View\Blocks\Block;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;

class EditTemplate extends ModalComponent
{
    public Template $template;

    #[Rule('required')]
    public $name = '';

    #[Rule('required')]
    public $view_name = '';

    public $data;

    public ?Block $templateBlock;

    public function mount($template = null)
    {
        if ($template) {
            $this->template = $template;
            $this->name = $template->name;
            $this->view_name = $template->view_name;
            $this->data = $template->data;

            if ($this->view_name) {
                $this->updateViewName();
            }

        }
    }

    private function updateViewName()
    {
        $view_name = config('site-core.available_templates')[$this->view_name];
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

        if (isset($this->template)) {
            $this->template->update(
                $this->only(['name', 'view_name', 'data'])
            );
            $this->template->save();
        } else {
            Template::create(
                $this->only(['name', 'view_name', 'data'])
            );
        }

        $this->closeModalWithEvents([
            TemplateEditor::class => 'refreshComponent',
        ]);
    }

    public function render()
    {

        return view('site-core::livewire.blocks.edit-template', [

        ]);
    }
}
