<?php

namespace Sitebrew\Enums\Admin;

enum AdminPath: string
{
    case ADMIN = 'admin';

    case CONTENT = 'content';

    case MEDIA = 'media';

    case SHOP = 'shop';

    case USERS = 'users';

    case STRUCTURE = 'structure';
}