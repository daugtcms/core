<?php

namespace Sitebrew\Data\Media;

use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class MediaPickerData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public int $id = 0,
        public string $variant = ''
    ) {
    }
}
