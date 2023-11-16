<?php

namespace Sitebrew\Enums\Admin;

enum AdminPath: string
{
    case ADMIN = 'admin';

    case CONTENT = 'content';

    case MEDIA = 'media';

    case STRUCTURE = 'structure';

    case USERS = 'users';
}