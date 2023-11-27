<?php

namespace Sitebrew\Enums\Blocks;

enum AttributeType: string
{
    case TEXT = 'text';

    case RICH_TEXT = 'rich-text';

    case NUMBER = 'number';

    case BOOLEAN = 'boolean';

    case MEDIA = 'media';

    case NAVIGATION = 'navigation';

    case BLOG_CATEGORY = 'blog-category';

    case PRODUCT = 'product';

    case USER = 'user';

    case COURSE_SECTION = 'course-section';

    case CUSTOM_SELECT = 'custom-select';
}
