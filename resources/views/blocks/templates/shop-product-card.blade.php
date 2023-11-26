<a href="{{route('shop.product.show', $product->slug)}}" class="group bg-neutral-50  rounded-md border-2 border-neutral-200 flex flex-col overflow-hidden max-w-xs w-full mx-auto">
    <img src="{{MediaHelper::getMedia($product->firstMedia('media'), 'thumbnail')}}"
         class="object-cover object-center w-full h-full group-hover:opacity-75 aspect-[10/7]"
         alt="Product Image">
    <div class="flex flex-col p-3">
        <h3 class=" text-gray-8 00 break-words truncate text group-hover:text-primary-700">
            {{$product->name}}
        </h3>
        <p class="mt-1 text-lg font-medium text-gray-700">
            €@number($product->price)
        </p>
    </div>
</a>