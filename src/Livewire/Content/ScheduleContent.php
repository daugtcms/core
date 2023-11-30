<?php

namespace Sitebrew\Livewire\Content;

use Sitebrew\Models\Content\Content;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;
use WireElements\Pro\Components\Modal\Modal;

class ScheduleContent extends Modal
{
    public int|Content $content;

    #[Rule(['required'])]
    public $published_at = '';

    public function mount(int $content = null)
    {
        $this->content = Content::where('id', $content)->first() ?? new Content();

        if($this->content->published_at) {
            $this->published_at = $this->content->published_at->format('Y-m-d\TH:i');
        }
    }

    public function render()
    {
        return view('sitebrew::livewire.content.schedule-content');
    }

    public function save()
    {
        $this->validate();

        $this->content->published_at = $this->published_at;
        $this->content->save();

        $this->close(
            andDispatch: [
                'refreshComponent',
            ]
        );
    }
}
