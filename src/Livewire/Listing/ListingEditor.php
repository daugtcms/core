<?php

namespace Daugt\Livewire\Listing;

use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Daugt\Data\Listing\ListingItemData;
use Daugt\Models\Listing\Listing;

class ListingEditor extends Component
{
    public array $items = [];

    public Listing $currentListing;

    #[Rule([
        'currentItem' => ['nullable'],
        'currentItem.name' => [
            'required',
        ],
        /*'currentItem.url' => [
            'required',
        ],*/
    ])]
    public ListingItemData $currentItem;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
    }

    public function updated($name, $value)
    {
        $this->validate();
    }

    #[Layout('daugt::components.layouts.admin')]
    public function render()
    {
        $listings = Listing::all();
        if ($listings->count() > 0 && empty($this->currentListing)) {
            $this->currentListing = $listings->first();
            $this->currentListing->items()->orderBy('order')->get()->each(function ($item) {
                $this->items[] = ListingItemData::from($item);
            });
        }

        return view('daugt::livewire.listing.listing-editor', [
            'listings' => $listings,
        ]);
    }

    public function setCurrentListing($id): void
    {
        $this->persistCurrentItem();
        $this->currentListing = Listing::findOrFail($id);
        $this->items = [];
        $this->currentListing->items()->orderBy('order')->get()->each(function ($item) {
            $this->items[] = ListingItemData::from($item);
        });
    }

    private function persistCurrentItem(): void
    {
        if (! empty($this->currentItem->uuid)) {
            // cancel if currentItem is not filled completly
            $this->validate();

            // replace element at index in array
            $this->items = collect($this->items)->map(function ($item) {
                if ($item->uuid === $this->currentItem->uuid) {
                    return $this->currentItem;
                }

                return $item;
            })->all();
        }
    }

    public function deleteListing($id): void
    {
        $listing = Listing::findOrFail($id);
        $listing->delete();
        unset($this->currentListing);
        $this->items = [];
        $this->currentItem = new ListingItemData();
    }

    public function addItem(): void
    {
        $this->persistCurrentItem();
        $order = collect($this->items)->max('order') + 1;
        $item = new ListingItemData(Str::uuid(), $order);
        $this->items[] = $item;
        $this->setCurrentItem($item->uuid);
    }

    public function setCurrentItem($uuid): void
    {
        $this->persistCurrentItem();
        if (! empty($this->currentItem->uuid) && $this->currentItem->uuid === $uuid) {
            $this->currentItem = new ListingItemData();
        } else {
            $item = collect($this->items)->where('uuid', $uuid)->first();
            $this->currentItem = $item;
        }
    }

    public function removeItem($uuid): void
    {
        $this->items = collect($this->items)->filter(function ($item) use ($uuid) {
            return $item->uuid !== $uuid;
        })->all();

        if (! empty($this->currentItem->uuid) && $this->currentItem->uuid === $uuid) {
            $this->currentItem = new ListingItemData();
        }
        $this->resetErrorBag();
    }

    public function updateItemOrder($items): void
    {
        $orderItems = collect($items)->map(function ($item) {
            return $item['value'];
        })->toArray();

        $this->items = collect($this->items)->sortBy(function ($item) use ($orderItems) {
            return array_search($item->uuid, $orderItems);
        })->all();

        $this->items = collect($this->items)->map(function ($item) use ($orderItems) {
            $item->order = array_search($item->uuid, $orderItems);

            if (! empty($this->currentItem->uuid) && $item->uuid == $this->currentItem->uuid) {
                $this->currentItem->order = $item->order;
            }

            return $item;
        })->all();
    }

    public function saveItems(): void
    {
        $this->persistCurrentItem();

        $oldItems = $this->currentListing->items()->get();
        foreach ($this->items as $item) {
            $this->currentListing->items()->updateOrCreate(
                ['uuid' => $item->uuid],
                $item->toArray());
        }

        foreach ($oldItems as $oldItem) {
            if (! collect($this->items)->contains('uuid', $oldItem->uuid)) {
                $oldItem->delete();
            }
        }
    }

    public function unsavedChanges(): bool
    {
        $dbItems = collect([]);
        $this->currentListing->items()->orderBy('order')->get()->each(fn ($item) => $dbItems->add(ListingItemData::from($item)));

        $currentItems = collect($this->items)->map(function ($item) {
            if (! empty($this->currentItem->uuid) && $item->uuid == $this->currentItem->uuid) {
                return $this->currentItem->toArray();
            }

            return $item->toArray();
        });

        return ! collection_compare($dbItems, $currentItems);
    }
}
