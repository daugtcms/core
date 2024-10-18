<?php

namespace Daugt\Enums\Shop;

enum BillingDurationUnit: string
{
    case HOUR = 'hour';

    case DAY = 'day';

    case WEEK = 'week';

    case MONTH = 'month';

    case YEAR = 'year';
}
