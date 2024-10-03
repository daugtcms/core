<?php

namespace Daugt\Livewire\Content;

use Daugt\Misc\ContentTypeRegistry;
use Daugt\Misc\ThemeRegistry;
use Daugt\Models\Blocks\BlockDefaults;
use Daugt\Models\Content\Content;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class EditContent extends \Livewire\Component
{
    public Content $content;

    public string $title = '';
    public string $type = 'page';
    public string $template = '';
    public ?array $blocks;

    public array $contentAttributes = [];
    public string $currentTab = 'content';

    public function mount($content = null)
    {
        if ($content) {
            $this->content = $content;
            $this->title = $this->content->title;
            $this->type = $this->content->type ?? ContentTypeRegistry::getContentTypes()[0];
            $this->template = $this->content->template ?: array_key_first(ThemeRegistry::getThemeTemplatesByUsage($this->type));
            $this->contentAttributes = $this->content->attributes ?? [];
            $this->blocks = $this->content->blocks;
        }
    }

    #[Layout('daugt::components.layouts.admin')]
    public function render()
    {
        return view('daugt::livewire.content.edit-content');
    }

    public function delete() {
        $this->content->delete();
        return redirect()->route('daugt.admin.content.index');
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

        if (isset($this->content)) {
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
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->route('daugt.admin.content.index');
    }
}
