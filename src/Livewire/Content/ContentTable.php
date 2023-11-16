<?php

namespace Sitebrew\Livewire\Content;

use Livewire\Attributes\Url;
use Sitebrew\Enums\Blocks\TemplateUsage;
use Sitebrew\Livewire\Table\Table;
use Sitebrew\Livewire\Table\Column;
use Sitebrew\Models\Blocks\Template;
use Sitebrew\Models\Content\Content;
use Illuminate\Database\Eloquent\Builder;

class ContentTable extends Table
{
    protected $listeners = [
        'saveBlocks' => 'saveBlocks',
    ];

    #[Url]
    public $type = '';

    public function query(): Builder
    {
        $query = Content::with('user');
        if (!empty($this->type)) {
             $query->where('type', $this->type);
        }

        return $query;
    }

    public function addElement(): void
    {
        $this->dispatch('modal.open', 'sitebrew::block-editor', [
            'data' => [],
        ]);
    }

    public function editElement($id): void
    {
        $this->dispatch('modal.open', 'sitebrew::block-editor', [
            'data' => Content::findOrFail($id)->blocks,
            'id' => $id
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('id', '')->component('sitebrew::table.edit-content'),
            Column::make('title', 'Titel'),
            Column::make('type', 'Type'),
            Column::make('user', 'Author')->component('sitebrew::table.user'),
            // Column::make('slug', 'URL'),
            Column::make('updated_at', 'Updated At')->component('sitebrew::table.human-diff'),
            Column::make('created_at', 'Created At')->component('sitebrew::table.human-diff'),
            Column::make('id', '')->component('sitebrew::table.delete'),
        ];
    }

    public function saveBlocks($data, $id)
    {
        $title = '';
        if (isset($data['template']) && isset($data['template']['attributes']) && isset($data['template']['attributes']['title'])) {
            $title = $data['template']['attributes']['title'];
        }
        if ($id == 0) {
            $content = Content::create([
                'title' => $title,
                'blocks' => $data,
                'type' => $this->type,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $content = Content::findOrFail($id);
            $content->title = $title;
            $content->blocks = $data;
            $content->save();
        }
    }
}
