<?php

namespace Sitebrew\Livewire\Blocks;

use Sitebrew\Models\Blocks\Template;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TemplateEditor extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    #[Layout('sitebrew::components.layouts.app')]
    public function render()
    {
        return view('sitebrew::livewire.blocks.template-editor', [
            'templates' => Template::all(),
        ]);
    }

    public function deleteTemplate(Template $template)
    {
        $template->delete();
    }
}
