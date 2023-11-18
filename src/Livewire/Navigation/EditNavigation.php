<?php

namespace Sitebrew\Livewire\Navigation;

use Sitebrew\Models\Navigation\Navigation;
use Livewire\Attributes\Rule;
use WireElements\Pro\Components\Modal\Modal;

class EditNavigation extends Modal
{
    public int|Navigation $navigation;

    #[Rule('required')]
    public $name = '';

    #[Rule('nullable')]
    public $description = '';

    public function mount(Navigation $navigation = null)
    {
        if ($navigation) {
            $this->navigation = $navigation;
            $this->name = $navigation->name;
            $this->description = $navigation->description;
        }
    }

    public function save()
    {
        $this->validate();

        if (isset($this->navigation->id)) {
            $this->navigation->update(
                $this->only(['name', 'description'])
            );
            $this->navigation->save();
        } else {
            Navigation::create(
                $this->only(['name', 'description'])
            );
        }

        $this->close(andDispatch: [
            NavigationEditor::class => 'refreshComponent',
        ]);
    }

    public function render()
    {

        return view('sitebrew::livewire.navigation.edit-navigation', [

        ]);
    }
}
