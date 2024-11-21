<?php

namespace Daugt\Enums\Admin;

enum AdminPath: string
{
    case ADMIN = 'admin';

    case CONTENT = 'content';

    case MEDIA = 'media';

    case SHOP = 'shop';

    case ANALYTICS = 'analytics';

    case USERS = 'users';

    case STRUCTURE = 'structure';

    case HOMEPAGE = 'homepage';
}