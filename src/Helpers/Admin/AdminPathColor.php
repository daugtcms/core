<?php

namespace Sitebrew\Helpers\Admin;

use Sitebrew\Enums\Admin\AdminPath;

class AdminPathColor
{
    public static function getColor(AdminPath $path): string
    {
        $colors = [
            AdminPath::ADMIN->value => '#f59e0b',
            AdminPath::STRUCTURE->value => '#6366f1',
        ];

        return $colors[$path->value];
    }

    public static function getIcon(AdminPath $path): string
    {
        $colors = [
            AdminPath::ADMIN->value => 'sitebrew',
            AdminPath::STRUCTURE->value => 'layout-panel-top',
        ];

        return $colors[$path->value];
    }
}