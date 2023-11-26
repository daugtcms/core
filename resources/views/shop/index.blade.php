<x-sitebrew::template-renderer :usage="\Sitebrew\Enums\Blocks\TemplateUsage::SHOP_OVERVIEW->value">
    @foreach($products as $product)
        <x-sitebrew::template-renderer :within-template="true" :usage="\Sitebrew\Enums\Blocks\TemplateUsage::SHOP_PRODUCT_CARD->value" :attributes="['product' => $product]">
        </x-sitebrew::template-renderer>
    @endforeach
</x-sitebrew::template-renderer>