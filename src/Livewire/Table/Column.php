<?php

namespace Sitebrew\Livewire\Table;

class Column
{
    public string $component = 'sitebrew::table.column';

    public string $key;

    public string $label;

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
