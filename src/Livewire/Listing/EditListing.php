<?php

namespace Sitebrew\Livewire\Listing;

use Sitebrew\Models\Listing\Listing;
use Livewire\Attributes\Rule;
use WireElements\Pro\Components\Modal\Modal;

class EditListing extends Modal
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

        $this->close(andDispatch: [
            Listing::class => 'refreshComponent',
        ]);
    }

    public function render()
    {

        return view('sitebrew::livewire.listing.edit-listing', [

        ]);
    }
}
