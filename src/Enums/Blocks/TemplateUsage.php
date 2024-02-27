<?php

namespace Sitebrew\Enums\Blocks;

/* TODO: remove this enum when migration to new structure is complete */
enum TemplateUsage: string
{
    case AUTH = 'auth';

    case MEMBER_AREA = 'member-area';

    case SHOP_OVERVIEW = 'shop';

    case SHOP_PRODUCT = 'shop-product';

    case SHOP_PRODUCT_CARD = 'show-product-card';

    case BLOG_POST_CARD = 'blog-post-card';

    case BLOG_OVERVIEW = 'blog-overview';
}
