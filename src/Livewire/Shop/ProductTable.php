<?php

namespace Daugt\Livewire\Shop;

use Livewire\Attributes\Url;
use Daugt\Livewire\Table\Table;
use Daugt\Livewire\Table\Column;
use Daugt\Models\Content\Content;
use Illuminate\Database\Eloquent\Builder;
use Daugt\Models\Shop\Product;
use Daugt\Models\User;

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

        $query->orderBy('created_at', 'desc');

        return $query;
    }

    public function add(): void
    {
        redirect()->route('daugt.admin.shop.product.create');
    }

    public function edit($id): void
    {
        redirect()->route('daugt.admin.shop.product.edit', ['product' => $id]);
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
            Column::make('id', '')->component('daugt::table.edit'),
            Column::make('', __('daugt::general.enabled'))->component('daugt::table.enabled'),
            Column::make('id', __('daugt::general.id')),
            Column::make('name', __('daugt::general.name')),
            Column::make('price', __('daugt::general.price'))->component('daugt::table.price'),
            Column::make('created_at', __('daugt::general.created_at'))->component('daugt::table.human-diff'),
        ];
    }
}
