<?php

namespace Daugt\Enums\Shop;

enum PaymentStatus: string
{
    case FAILED = 'failed';

    case PENDING = 'pending';

    case PAID = 'paid';
}
