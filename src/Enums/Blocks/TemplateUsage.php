<?php

namespace Sitebrew\Enums\Blocks;

enum TemplateUsage: string
{
    case AUTH = 'auth';

    case MEMBER_AREA = 'member-area';

    case SHOP_OVERVIEW = 'shop';

    case SHOP_PRODUCT = 'shop-product';

    case SHOP_PRODUCT_CARD = 'show-product-card';
}
