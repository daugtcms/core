<?php

namespace Daugt\Livewire\Content;

use LivewireUI\Modal\ModalComponent;
use Daugt\Models\Content\Content;
use Livewire\Attributes\Rule;

class ScheduleContent extends ModalComponent
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
        return view('daugt::livewire.content.schedule-content');
    }

    public function save()
    {
        $this->validate();

        $this->content->published_at = $this->published_at;
        $this->content->save();

        $this->closeModalWithEvents([
            'refreshComponent',
        ]);
    }
}
