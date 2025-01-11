<?php

namespace Daugt\Livewire\Content\Notifications;

use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Rule;

class ViewNotificationContent extends ModalComponent
{
    #[Rule(['required'])]
    public string $content = '';

    public function mount(string $content = null)
    {
        $this->content = $content;
    }

    public function render()
    {
        return view('daugt::livewire.content.notifications.view-notification-content');
    }
}
