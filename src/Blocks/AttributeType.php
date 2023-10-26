<?php

namespace Sitebrew\Blocks;

enum AttributeType: string
{
    case TEXT = 'text';

    case NUMBER = 'number';

    case BOOLEAN = 'boolean';

    case IMAGE = 'image';

    case NAVIGATION = 'navigation';
}
