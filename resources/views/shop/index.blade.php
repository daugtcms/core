<x-daugt::template-renderer :usage="'shop_overview'">
    @foreach($products as $product)
        <x-daugt::template-renderer :usage="'shop_product_card'" :attributes="['product' => $product]">
        </x-daugt::template-renderer>
    @endforeach

    @push('after-products')
        @if($products->hasPages())
            {{$products->links()}}
        @endif
    @endpush
</x-daugt::template-renderer>