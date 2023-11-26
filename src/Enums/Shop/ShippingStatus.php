<?php

namespace Sitebrew\Enums\Shop;

enum ShippingStatus: string
{
    case PENDING = 'pending';

    case PROCESSING = 'processing';

    case SHIPPED = 'shipped';
}
