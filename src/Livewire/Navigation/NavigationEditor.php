<?php

namespace Sitebrew\Livewire\Navigation;

use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Sitebrew\Data\Navigation\NavigationItemData;
use Sitebrew\Models\Navigation\Navigation;

class NavigationEditor extends Component
{
    public array $items = [];

    public Navigation $currentNavigation;

    #[Rule([
        'currentItem' => ['nullable'],
        'currentItem.name' => [
            'required',
        ],
        'currentItem.url' => [
            'required',
        ],
    ])]
    public NavigationItemData $currentItem;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
    }

    public function updated($name, $value)
    {
        $this->validate();
    }

    #[Layout('sitebrew::components.layouts.admin')]
    public function render()
    {
        $navigations = Navigation::all();
        if ($navigations->count() > 0 && empty($this->currentNavigation)) {
            $this->currentNavigation = $navigations->first();
            $this->currentNavigation->items()->orderBy('order')->get()->each(function ($item) {
                $this->items[] = NavigationItemData::from($item);
            });
        }

        return view('sitebrew::livewire.navigation.navigation-editor', [
            'navigations' => $navigations,
        ]);
    }

    public function setCurrentNavigation($id): void
    {
        $this->persistCurrentItem();
        $this->currentNavigation = Navigation::findOrFail($id);
        $this->items = [];
        $this->currentNavigation->items()->orderBy('order')->get()->each(function ($item) {
            $this->items[] = NavigationItemData::from($item);
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

    public function deleteNavigation($id): void
    {
        $navigation = Navigation::findOrFail($id);
        $navigation->delete();
        unset($this->currentNavigation);
        $this->items = [];
        $this->currentItem = new NavigationItemData();
    }

    public function addItem(): void
    {
        $this->persistCurrentItem();
        $order = collect($this->items)->max('order') + 1;
        $item = new NavigationItemData(Str::uuid(), $order);
        $this->items[] = $item;
        $this->setCurrentItem($item->uuid);
    }

    public function setCurrentItem($uuid): void
    {
        $this->persistCurrentItem();
        if (! empty($this->currentItem->uuid) && $this->currentItem->uuid === $uuid) {
            $this->currentItem = new NavigationItemData();
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
            $this->currentItem = new NavigationItemData();
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

        $oldItems = $this->currentNavigation->items()->get();
        foreach ($this->items as $item) {
            // convert boolean to target string
            if ($item->target == 1 || $item->target === '_blank') {
                $item->target = '_blank';
            } else {
                $item->target = '_self';
            }

            $this->currentNavigation->items()->updateOrCreate(
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
        $this->currentNavigation->items()->orderBy('order')->get()->each(fn ($item) => $dbItems->add(NavigationItemData::from($item)));

        $currentItems = collect($this->items)->map(function ($item) {
            if (! empty($this->currentItem->uuid) && $item->uuid == $this->currentItem->uuid) {
                return $this->currentItem->toArray();
            }

            return $item->toArray();
        });

        return ! collection_compare($dbItems, $currentItems);
    }
}
