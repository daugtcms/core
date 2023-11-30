<?php

namespace Sitebrew\Livewire\Content;

use Carbon\Carbon;
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
        $this->dispatch('modal.open', 'sitebrew::block-editor', [
            'usage' => $this->type,
            'data' => [],
        ]);
    }

    public function edit($id): void
    {
        $content = Content::findOrFail($id);
        $this->dispatch('modal.open', 'sitebrew::block-editor', [
            'usage' => $content->type,
            'data' => $content->blocks,
            'id' => $id
        ]);
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
            Column::make('id', '')->component('sitebrew::table.edit'),
            Column::make('', __('sitebrew::general.enabled'))->component('sitebrew::table.enabled'),
            Column::make('title', __('sitebrew::general.title')),
            Column::make('type', __('sitebrew::general.type')),
            Column::make('user', __('sitebrew::general.author'))->component('sitebrew::table.user'),
            // Column::make('slug', 'URL'),
            Column::make('', __('sitebrew::general.published_at'))->component('sitebrew::table.schedule-content'),
            Column::make('updated_at', __('sitebrew::general.updated_at'))->component('sitebrew::table.human-diff'),
            Column::make('created_at', __('sitebrew::general.created_at'))->component('sitebrew::table.human-diff'),
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
