<?php

namespace Sitebrew\Livewire\Blocks;

use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Sitebrew\Misc\ThemeRegistry;
use Sitebrew\Models\Blocks\Template;
use WireElements\Pro\Components\Modal\Modal;

class EditTemplate extends Modal
{
    public int|Template $template;

    #[Rule('required')]
    public $name = '';

    #[Rule('required')]
    public $block_name = '';

    #[Rule('required')]
    public $usage = '';

    public $data;

    public function mount(Template $template = null)
    {
        if ($template) {
            $this->template = $template;
            $this->name = $template->name;
            $this->block_name = $template->block_name;
            $this->data = $template->data;
            $this->usage = $template->usage;
        }
    }

    public function updated($name, $value)
    {
        if (Str::startsWith($name, 'block_name')) {
            $this->data = ThemeRegistry::getThemeTemplateAttributes($this->block_name);
        }
    }

    public function save()
    {
        $this->validate();
        if (isset($this->template->id)) {
            $this->template->update(
                $this->only(['name', 'block_name', 'data', 'usage'])
            );
            $this->template->save();
        } else {
            Template::create(
                $this->only(['name', 'block_name', 'data', 'usage'])
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
