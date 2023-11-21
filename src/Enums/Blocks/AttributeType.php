<?php

namespace Sitebrew\Enums\Blocks;

enum AttributeType: string
{
    case TEXT = 'text';

    case RICH_TEXT = 'rich-text';

    case NUMBER = 'number';

    case BOOLEAN = 'boolean';

    case IMAGE = 'image';

    case NAVIGATION = 'listing';

    case PRODUCT = 'product';
}
