<?php

namespace Sitebrew\Enums\Blocks;

enum TemplateUsage: string
{
    case AUTH = 'auth';

    case MEMBER_AREA = 'member-area';

    case SHOP_OVERVIEW = 'shop';

    case SHOP_CATEGORY = 'shop-category';

    case SHOP_PRODUCT = 'shop-product';

}
