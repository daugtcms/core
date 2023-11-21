<?php

namespace Sitebrew\Livewire\Shop;

use Livewire\Attributes\Url;
use Sitebrew\Livewire\Table\Table;
use Sitebrew\Livewire\Table\Column;
use Sitebrew\Models\Content\Content;
use Illuminate\Database\Eloquent\Builder;
use Sitebrew\Models\Shop\Product;
use Sitebrew\Models\User;

class ProductTable extends Table
{

    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public bool $allowCreate = true;

    public function query(): Builder
    {
        $query = Product::query();

        if(!empty($ids)) {
            $query->whereIn('id', $ids);
        }

        return $query;
    }

    public function add(): void
    {
        $this->dispatch('modal.open', 'sitebrew::shop.edit-product', [
        ]);
    }

    public function edit($id): void
    {
        $this->dispatch('modal.open', 'sitebrew::shop.edit-product', [
            'product' => $id
        ]);
    }

    public function toggleEnabled($id): void
    {
        $product = Product::findOrFail($id);
        $product->enabled = !$product->enabled;
        $product->save();
    }

    public function columns(): array
    {
        return [
            Column::make('id', '')->component('sitebrew::table.edit'),
            Column::make('', __('sitebrew::general.enabled'))->component('sitebrew::table.enabled'),
            Column::make('id', __('sitebrew::general.id')),
            Column::make('name', __('sitebrew::general.name')),
            Column::make('price', __('sitebrew::general.price'))->component('sitebrew::table.price'),
            Column::make('created_at', __('sitebrew::general.created_at'))->component('sitebrew::table.human-diff'),
        ];
    }
}
