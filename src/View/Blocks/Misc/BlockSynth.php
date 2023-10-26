<?php

namespace Sitebrew\View\Blocks\Misc;

use Sitebrew\View\Blocks\Block;
use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class BlockSynth extends Synth
{
    public static $ignoredProperties = ['attributes', 'componentName'];

    public static $key = 'block';

    public static function match($target)
    {
        return $target instanceof Block;
    }

    public function dehydrate($target)
    {
        $properties = self::getAvailableBlockProperties($target);

        $mapped = $properties->mapWithKeys(function ($property) use ($target) {
            $key = $property->getName();
            $value = $target->{$key};

            if (is_object($value)) {
                $value = $this->dehydrate($value);
            }

            return [$key => $value];
        });

        $mapped->put('block', get_class($target));

        return [$mapped->toArray(), []];
    }

    public static function getAvailableBlockProperties($target)
    {
        $reflect = new \ReflectionClass($target);
        $properties = collect($reflect->getProperties());

        return $properties->filter(function ($property) {
            return $property->isPublic() && ! $property->isStatic() && ! in_array($property->getName(), self::$ignoredProperties);
        });
    }

    public function hydrate($value)
    {
        $instance = new $value['block']();

        $properties = self::getAvailableBlockProperties($instance);

        $properties->each(function ($property) use ($instance, $value) {
            $key = $property->getName();
            $value = $value[$key];

            if (is_array($value)) {
                $value = $this->hydrate($value);
            }

            $instance->{$key} = $value;
        });

        return $instance;
    }

    public function get(&$target, $key)
    {
        return $target->{$key};
    }

    public function set(&$target, $key, $value)
    {
        $target->{$key} = $value;
    }
}
