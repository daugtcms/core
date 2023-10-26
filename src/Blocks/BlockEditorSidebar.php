<?php

namespace Felixbeer\SiteCore\Blocks;

enum BlockEditorSidebar: string
{
    case TEMPLATE = 'template';

    case BLOCK = 'block';

    case AVAILABLE_BLOCKS = 'available_blocks';
}
