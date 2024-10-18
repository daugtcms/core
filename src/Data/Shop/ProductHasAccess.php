<?php

namespace Daugt\Data\Shop;

use Carbon\Carbon;
use DateTime;
use Daugt\Enums\Shop\AccessType;
use Daugt\Enums\Shop\BillingDurationUnit;
use Daugt\Models\Content\Content;
use Daugt\Models\Listing\Listing;
use Daugt\Models\Shop\Product;
use Illuminate\Support\Collection;
use Daugt\Data\Theme\AttributeData;
use Daugt\Enums\Content\ContentGroup;
use Livewire\Wireable;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;

class ProductHasAccess extends Data implements Wireable
{
    use WireableData;

    public int $productId;

    public int $accessId;

    public string $accessType;

    public string $accessName;

    public AccessType $type = AccessType::PERMANENT;

    #[WithCast(DateTimeInterfaceCast::class)]
    #[WithTransformer(DateTimeInterfaceTransformer::class)]
    public ?DateTime $startDate;
    #[WithCast(DateTimeInterfaceCast::class)]
    #[WithTransformer(DateTimeInterfaceTransformer::class)]
    public ?DateTime $endDate;

    public ?int $duration;

    public ?BillingDurationUnit $durationUnit = BillingDurationUnit::MONTH;
}
