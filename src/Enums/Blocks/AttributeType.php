<?php

namespace Sitebrew\Enums\Blocks;

enum AttributeType: string
{
    case TEXT = 'text';

    case RICH_TEXT = 'rich-text';

    case NUMBER = 'number';

    case BOOLEAN = 'boolean';

    case IMAGE = 'image';

    case NAVIGATION = 'navigation';

    case BLOG_CATEGORY = 'blog-category';

    case PRODUCT = 'product';

    case USER = 'user';
}
