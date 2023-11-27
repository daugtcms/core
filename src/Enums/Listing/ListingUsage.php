<?php

namespace Sitebrew\Enums\Listing;

enum ListingUsage: string
{
    case NAVIGATION = 'navigation';

    case SHOP_CATEGORIES = 'shop-categories';

    case BLOG_CATEGORIES = 'blog-categories';

    case COURSE = 'course';
}
