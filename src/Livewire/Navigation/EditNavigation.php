<?php

namespace Felixbeer\SiteCore\Livewire\Navigation;

use Felixbeer\SiteCore\Navigation\Models\Navigation;
use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;

class EditNavigation extends ModalComponent
{
    public Navigation $navigation;

    #[Rule('required')]
    public $name = '';

    #[Rule('nullable')]
    public $description = '';

    public function mount($navigation = null)
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

        if (isset($this->navigation)) {
            $this->navigation->update(
                $this->only(['name', 'description'])
            );
            $this->navigation->save();
        } else {
            Navigation::create(
                $this->only(['name', 'description'])
            );
        }

        $this->closeModalWithEvents([
            NavigationEditor::class => 'refreshComponent',
        ]);
    }

    public function render()
    {

        return view('site-core::livewire.navigation.edit-navigation', [

        ]);
    }
}
