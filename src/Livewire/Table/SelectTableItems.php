<?php

namespace Sitebrew\Livewire\Table;

use Livewire\Features\SupportAttributes\AttributeCollection;
use Sitebrew\Enums\Shop\BillingType;
use Sitebrew\Livewire\Content\CoursesTable;
use Sitebrew\Models\Content\Course;
use Sitebrew\Models\Listing\Navigation;
use Livewire\Attributes\Rule;
use Sitebrew\Models\Shop\Product;
use Sitebrew\Models\User;
use WireElements\Pro\Components\Modal\Modal;

class SelectTableItems extends Modal
{
    public string $tableName;

    public string $dispatch;

    public array $selected;

    protected $listeners = [
        'updateSelectedItems' => 'updateSelectedItems',
    ];

    public function updateSelectedItems($items): void
    {
        $this->dispatch($this->dispatch, $items);
    }

    public function render()
    {

        return view('sitebrew::livewire.table.select-table-items', [

        ]);
    }

    public static function attributes(): array
    {
        return [
            'size' => 'xl',
        ];
    }

    public static function behavior(): array
    {
        return [
            'remove-state-on-close' => true,
        ];
    }
}
