<?php

namespace Daugt\Enums\Blocks;

enum AttributeType: string
{
    case TEXT = 'text';

    case RICH_TEXT = 'rich-text';

    case NUMBER = 'number';

    case BOOLEAN = 'boolean';

    case MEDIA = 'media';

    case DATE = 'date';

    case ICON = 'icon';

    case LINK = 'link';

    case LISTING = 'listing';

    case LISTING_ITEM = 'listing-item';

    case PRODUCT = 'product';

    case USER = 'user';

    case CUSTOM_SELECT = 'custom-select';

    case CONTENT = 'content';
}
