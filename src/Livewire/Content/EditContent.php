<?php

namespace Daugt\Livewire\Content;

use Daugt\Misc\ContentTypeRegistry;
use Daugt\Misc\ThemeRegistry;
use Daugt\Models\Blocks\BlockDefaults;
use Daugt\Models\Content\Content;
use Livewire\Attributes\Layout;

class EditContent extends \Livewire\Component
{
    public Content $content;

    public string $title = '';
    public string $type = '';
    public string $template = '';
    public ?array $blocks;

    public array $contentAttributes = [];
    public string $currentTab = 'content';

    public function mount(Content $content = null)
    {
        if ($content) {
            $this->title = $content->title;
            $this->type = $content->type ?? ContentTypeRegistry::getContentTypes()[0];
            $this->template = $content->template ?: array_key_first(ThemeRegistry::getThemeTemplatesByUsage($this->type));
            $this->contentAttributes = $content->attributes ?? [];
            $this->blocks = $content->blocks;
        }
    }

    #[Layout('daugt::components.layouts.admin')]
    public function render()
    {
        return view('daugt::livewire.content.edit-content');
    }

    public function delete() {
        $this->content->delete();
        return redirect()->route('admin.content.index');
    }

    public function setTab($tab) {
        $this->currentTab = $tab;
    }

    public function save() {
        $this->validate([
            'title' => 'required',
            'type' => 'required',
            'template' => 'required'
        ]);

        if ($this->content) {
            $this->content->update([
                'title' => $this->title,
                'type' => $this->type,
                'template' => $this->template,
                'attributes' => $this->contentAttributes,
                'blocks' => $this->blocks,
            ]);
        } else {
            Content::create([
                'title' => $this->title,
                'type' => $this->type,
                'template' => $this->template,
                'attributes' => $this->contentAttributes,
                'blocks' => $this->blocks,
            ]);
        }

        return redirect()->route('admin.content.index');
    }
}
