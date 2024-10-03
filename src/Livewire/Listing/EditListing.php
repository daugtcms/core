<?php

namespace Daugt\Livewire\Listing;

use LivewireUI\Modal\ModalComponent;
use Daugt\Models\Listing\Listing;
use Livewire\Attributes\Rule;

class EditListing extends ModalComponent
{
    public int|Listing $listing;

    #[Rule('required')]
    public $name = '';

    #[Rule('required')]
    public $type = '';

    #[Rule('nullable')]
    public $description = '';

    #[Rule('nullable')]
    public $data = [];

    public function mount(Listing $listing = null)
    {
        if ($listing) {
            $this->listing = $listing;
            $this->name = $listing->name;
            $this->type = $listing->type;
            $this->description = $listing->description;
            $this->data = $listing->data ?? [];
        }
    }

    public function save()
    {
        $this->validate();
        if (isset($this->listing->id)) {
            $this->listing->update(
                $this->only(['name', 'description', 'type', 'data'])
            );
            $this->listing->save();
        } else {
            Listing::create(
                $this->only(['name', 'description', 'type', 'data'])
            );
        }

        $this->closeModalWithEvents([
            ListingEditor::class => 'refreshComponent']);
    }

    public function render()
    {

        return view('daugt::livewire.listing.edit-listing', [

        ]);
    }
}
