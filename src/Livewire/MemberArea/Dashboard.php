<?php

namespace Sitebrew\Livewire\MemberArea;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Sitebrew\Models\User;

class Dashboard extends Component
{
    public function mount()
    {
    }

    #[Layout('sitebrew::components.layouts.member-area-layout')]
    public function render()
    {

        return view('sitebrew::livewire.member-area.dashboard', [

        ]);
    }
}
