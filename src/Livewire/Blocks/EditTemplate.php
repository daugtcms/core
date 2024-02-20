<?php

namespace Sitebrew\Livewire\Blocks;

use Sitebrew\Models\Blocks\Template;
use Sitebrew\View\Blocks\Block;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Sitebrew\View\ThemeRegistry;
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

    public $available_blocks = [];

    public bool $limitBlocks = false;

    public function mount(Template $template = null)
    {
        if ($template) {
            $this->template = $template;
            $this->name = $template->name;
            $this->block_name = $template->block_name;
            $this->data = $template->data;
            $this->usage = $template->usage;
            $this->available_blocks = $template->available_blocks ?? [];

            if(count($this->available_blocks) > 0) {
                $this->limitBlocks = true;
            }
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

        if(!$this->limitBlocks) {
            $this->available_blocks = null;
        }
        if (isset($this->template->id)) {
            $this->template->update(
                $this->only(['name', 'block_name', 'data', 'usage', 'available_blocks'])
            );
            $this->template->save();
        } else {
            Template::create(
                $this->only(['name', 'block_name', 'data', 'usage', 'available_blocks'])
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
