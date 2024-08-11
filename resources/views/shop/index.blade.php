<x-daugt::template-renderer :usage="\Daugt\Enums\Blocks\TemplateUsage::SHOP_OVERVIEW->value">
    @foreach($products as $product)
        <x-daugt::template-renderer :within-template="true" :usage="\Daugt\Enums\Blocks\TemplateUsage::SHOP_PRODUCT_CARD->value" :attributes="['product' => $product]">
        </x-daugt::template-renderer>
    @endforeach
</x-daugt::template-renderer>