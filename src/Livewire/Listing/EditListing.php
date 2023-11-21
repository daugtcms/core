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
    public $usage = '';

    #[Rule('nullable')]
    public $description = '';

    public function mount(Listing $listing = null)
    {
        if ($listing) {
            $this->listing = $listing;
            $this->name = $listing->name;
            $this->usage = $listing->usage;
            $this->description = $listing->description;
        }
    }

    public function save()
    {
        $this->validate();

        if (isset($this->listing->id)) {
            $this->listing->update(
                $this->only(['name', 'description', 'usage'])
            );
            $this->listing->save();
        } else {
            Listing::create(
                $this->only(['name', 'description', 'usage'])
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
