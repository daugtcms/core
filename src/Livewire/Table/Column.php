<?php

namespace Daugt\Livewire\Table;

class Column
{
    public string $component = 'daugt::table.column';

    public string $key;

    public string $label;

    public static array $modifierColumns = [
        'daugt::table.edit',
        'daugt::table.delete',
    ];

    public bool $readonly;

    public string $custom = '';

    public function __construct($key, $label)
    {
        $this->key = $key;
        $this->label = $label;
    }

    public static function make($key, $label)
    {
        return new static($key, $label);
    }

    public function component($component)
    {
        $this->component = $component;

        return $this;
    }
}
