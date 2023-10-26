<?php

namespace Felixbeer\SiteCore\Livewire\Pages;

use Felixbeer\SiteCore\Pages\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;

class PageEditor extends Component
{
    public Page $page;

    #[Rule(['required'])]
    public string $title = '';

    #[Rule(['nullable'])]
    public string $description = '';

    public array $blocks = [];

    #[Url(history: true)]
    public bool $showBlockEditor = false;

    public function mount(Page $page = null)
    {
        $this->page = $page ?? new Page();

        $this->title = $this->page->title;
        $this->description = $this->page->description;
        $this->blocks = $this->page->blocks ?? [];
    }

    #[Layout('site-core::components.layouts.app')]
    public function render()
    {
        return view('site-core::livewire.pages.page-editor');
    }

    #[On('save-blocks')]
    public function saveBlocks($blocks = null)
    {
        $this->showBlockEditor = false;
        if ($blocks === null) {
            return;
        }
        $this->blocks = $blocks;
    }

    public function openBlockEditor()
    {
        $this->showBlockEditor = true;
    }

    public function save()
    {
        $this->validate();

        $this->page->title = $this->title;
        $this->page->description = $this->description;
        $this->page->blocks = $this->blocks;
        $this->page->save();

        $this->redirect(route('site-core.admin.pages.index'));
    }
}
