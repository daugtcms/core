<?php

namespace Sitebrew\Helpers\Admin;

use Sitebrew\Enums\Admin\AdminPath;

class AdminPathColor
{
    public static function getColor(AdminPath $path): string
    {
        $colors = [
            AdminPath::ADMIN->value => '#f59e0b',
            AdminPath::MEDIA->value => '#10b981',
            AdminPath::STRUCTURE->value => '#6366f1',
            AdminPath::CONTENT->value => '#3b82f6',
        ];

        return $colors[$path->value];
    }

    public static function getIcon(AdminPath $path): string
    {
        $colors = [
            AdminPath::ADMIN->value => 'sitebrew',
            AdminPath::MEDIA->value => 'image',
            AdminPath::STRUCTURE->value => 'layout-panel-top',
            AdminPath::CONTENT->value => 'text',
        ];

        return $colors[$path->value];
    }
}