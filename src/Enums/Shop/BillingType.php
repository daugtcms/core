<?php

namespace Daugt\Enums\Shop;

enum BillingType: string
{
    case ONE_TIME = 'one_time';

    case SUBSCRIPTION = 'subscription';

    case EXTERNAL = 'external';

    case FREE = 'free';
}
