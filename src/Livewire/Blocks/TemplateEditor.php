<?php

namespace Felixbeer\SiteCore\Livewire\Blocks;

use Felixbeer\SiteCore\Blocks\Models\Template;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TemplateEditor extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    #[Layout('site-core::components.layouts.app')]
    public function render()
    {
        return view('site-core::livewire.blocks.template-editor', [
            'templates' => Template::all(),
        ]);
    }

    public function deleteTemplate(Template $template)
    {
        $template->delete();
    }
}
