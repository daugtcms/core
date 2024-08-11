<?php

namespace Daugt\Livewire\Content;

use Carbon\Carbon;
use Livewire\Attributes\Url;
use Daugt\Enums\Blocks\TemplateUsage;
use Daugt\Livewire\Table\Table;
use Daugt\Livewire\Table\Column;
use Daugt\Models\Blocks\Template;
use Daugt\Models\Content\Content;
use Illuminate\Database\Eloquent\Builder;

class ContentTable extends Table
{
    protected $listeners = [
        'saveBlocks' => 'saveBlocks',
        'refreshComponent' => '$refresh',
    ];

    #[Url]
    public $type = '';


    public function mount() {
        if(empty($this->type)) {
            $this->allowCreate = false;
        }
    }

    public function query(): Builder
    {
        $query = Content::with('user');
        if (!empty($this->type)) {
             $query->where('type', $this->type);
        }
        if(!empty($this->ids)) {
            $query->whereIn('id', $this->ids);
        }

        $query->orderBy('created_at', 'desc');

        return $query;
    }

    public function add(): void
    {
        $this->dispatch('openModal', 'daugt::block-editor', [
            'usage' => $this->type,
            'data' => [],
        ]);
    }

    public function edit($id): void
    {
        redirect()->route('admin.content.edit', ['content' => $id]);
    }

    public function toggleEnabled($id): void
    {
        $content = Content::findOrFail($id);
        $content->enabled = !$content->enabled;
        $content->save();
    }

    public function columns(): array
    {
        return [
            Column::make('id', '')->component('daugt::table.edit'),
            Column::make('', __('daugt::general.enabled'))->component('daugt::table.enabled'),
            Column::make('title', __('daugt::general.title')),
            Column::make('type', __('daugt::general.type')),
            Column::make('user', __('daugt::general.author'))->component('daugt::table.user'),
            // Column::make('slug', 'URL'),
            Column::make('', __('daugt::general.published_at'))->component('daugt::table.schedule-content'),
            Column::make('updated_at', __('daugt::general.updated_at'))->component('daugt::table.human-diff'),
            Column::make('created_at', __('daugt::general.created_at'))->component('daugt::table.human-diff'),
            Column::make('id', '')->component('daugt::table.delete'),
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
                'published_at' => Carbon::now(),
            ]);
        } else {
            $content = Content::findOrFail($id);
            $content->title = $title;
            if(empty($content->title)) {
                $content->slug = null;
            }
            $content->blocks = $data;
            if(empty($content->published_at)) {
                $content->published_at = $content->created_at;
            }
            $content->save();
        }
    }
}
