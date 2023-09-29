<?php

namespace Felixbeer\SiteCore\Livewire\Navigation;

use Felixbeer\SiteCore\Livewire\NavigationEditor;
use Felixbeer\SiteCore\Navigation\Navigation;
use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;

class CreateNavigation extends ModalComponent
{
    public Navigation $post;

    #[Rule('required')]
    public $name = '';

    #[Rule('nullable')]
    public $description = '';

    public function mount()
    {
    }

    public function save()
    {
        $this->validate();

        Navigation::create(
            $this->only(['name', 'description'])
        );

        $this->closeModalWithEvents([
            NavigationEditor::class => 'refreshComponent',
        ]);
    }

    public function render()
    {

        return view('site-core::livewire.navigation.create-navigation', [

        ]);
    }
}
