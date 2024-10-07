<?php

namespace Daugt\Helpers\Admin;

use Daugt\Enums\Admin\AdminPath;

class AdminPathColor
{
    public static function getColor(AdminPath $path): string
    {
        $colors = [
            AdminPath::ADMIN->value => '#10b981',
            AdminPath::MEDIA->value => '#10b981',
            AdminPath::STRUCTURE->value => '#6366f1',
            AdminPath::CONTENT->value => '#3b82f6',
            AdminPath::USERS->value => '#ef4444',
            AdminPath::SHOP->value => '#f97316',
            AdminPath::HOMEPAGE->value => '#6b7280',
        ];

        return $colors[$path->value];
    }

    public static function getIcon(AdminPath $path): string
    {
        $colors = [
            AdminPath::ADMIN->value => 'home',
            AdminPath::MEDIA->value => 'image',
            AdminPath::STRUCTURE->value => 'layout-panel-top',
            AdminPath::CONTENT->value => 'text',
            AdminPath::USERS->value => 'user',
            AdminPath::SHOP->value => 'shopping-cart',
            AdminPath::HOMEPAGE->value => 'home',
        ];

        return $colors[$path->value];
    }
}