<?php

namespace Sitebrew\Enums\Shop;

enum PaymentStatus: string
{
    case FAILED = 'failed';

    case PENDING = 'pending';

    case PAID = 'paid';
}
