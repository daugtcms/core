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
            AdminPath::ANALYTICS->value => '#f59e0b',
            AdminPath::HOMEPAGE->value => '#6b7280',
        ];

        return $colors[$path->value];
    }

    public static function getIcon(AdminPath $path): string
    {
        $colors = [
            AdminPath::ADMIN->value => 'lucide:home',
            AdminPath::MEDIA->value => 'lucide:image',
            AdminPath::STRUCTURE->value => 'lucide:layout-panel-top',
            AdminPath::CONTENT->value => 'lucide:text',
            AdminPath::USERS->value => 'lucide:user',
            AdminPath::SHOP->value => 'lucide:shopping-cart',
            AdminPath::ANALYTICS->value => 'lucide:chart-line',
            AdminPath::HOMEPAGE->value => 'lucide:home',
        ];

        return $colors[$path->value];
    }
}