<ul role="list" class="space-y-4" wire:poll.10s>
    @forelse ($orders as $order)
        <li class="rounded-md overflow-hidden shadow-sm border-2 border-neutral-200">
            @can('edit orders')
                <div class="bg-neutral-100 w-full flex items-center px-4 py-1.5 text-neutral-600">
                    Von {{ $order->user->full_name }} - {{ $order->user->email }}
                </div>
            @endcan
            <button wire:click="$dispatch('openModal', { component: 'daugt::shop.edit-order', arguments: { order: {{$order->id}} } })"
                    class="w-full px-4 py-4 bg-white drop-shadow-sm hover:bg-neutral-50 focus:outline-none">
                <div class="w-full flex items-center justify-between">
                    <p
                            class="inline-flex text font-medium truncate text-primary-600 hover:underline hover:text-primary-500">
                        Bestellung #{{$order->id}}
                    </p>
                    <div class="flex shrink-0 ml-2 text-sm text-neutral-500">
                        <p>
                            Bestellt am
                            <time datetime="{{$order->created_at}}"
                                  class="font-semibold">{{$order->created_at->format('d.m.Y')}}</time>
                        </p>
                    </div>
                </div>
                <div class="mt-2 sm:flex sm:justify-between">
                    <div class="flex items-center justify-start">
                        @if($order->status===\Daugt\Enums\Shop\PaymentStatus::PAID->value)
                            <div
                                    class="w-3 h-3 shrink-0 mr-1.5 rounded-full bg-gradient-to-tr from-green-300 to-green-600">
                            </div>
                            <p class="inline-flex items-center text-sm text-neutral-500">
                                Bezahlung erfolgreich
                                @if($order->assigned)
                                    <span
                                            class="bg-primary-100 rounded-md py-0.5 px-1 text-primary-700 text-sm ml-1">Gratis</span>
                                @endif
                            </p>
                        @endif
                        @if($order->status===\Daugt\Enums\Shop\PaymentStatus::PENDING->value)
                            <div
                                    class="w-3 h-3 shrink-0 mr-1.5 rounded-full bg-gradient-to-tr from-yellow-300 to-yellow-600">
                            </div>
                            <p class="inline-flex items-center text-sm text-neutral-500">
                                Bezahlung ausstehend
                            </p>
                        @endif
                        @if($order->status===\Daugt\Enums\Shop\PaymentStatus::FAILED->value)
                            <div
                                    class="w-3 h-3 shrink-0 mr-1.5 rounded-full bg-gradient-to-tr from-red-300 to-red-600">
                            </div>
                            <p class="inline-flex items-center text-sm text-red-500">
                                Bezahlung fehlgeschlagen.
                            </p>
                        @endif
                    </div>
                    <div class="mt-2 text-sm text-neutral-500 sm:mt-0">
                        <!--Shipping Status for total order-->
                    </div>
                </div>
            </button>
            <ul class="bg-neutral-50 divide-y divide-neutral-200">
                @foreach($order->items as $item)
                    <li class="flex items-center py-3 px-4">
                        <div class="shrink-0 w-16 h-16 overflow-hidden border-2 rounded-md border-neutral-200">
                            <img src="{{ MediaHelper::getMedia($item->product->firstMedia('media'), 'thumbnail'), }}"
                                 class="object-cover object-center w-full h-full">
                        </div>

                        <div class="flex flex-col flex-1 ml-4">
                            <div>
                                <div class="flex justify-between text-sm font-medium text-neutral-900">
                                    <h3 class="text-primary-500 text-sm hover:underline hover:text-primary-600">
                                        <a href="{{ route('daugt.shop.product.show', $item->product->slug) }}">
                                            {{ $item->product->name }}
                                        </a>
                                    </h3>
                                </div>
                            </div>
                            @if($item->product->shipping)
                                <h3 class="text-neutral-700 text-sm">Versandware</h3>
                                <div class="flex justify-between items-center flex-1 text-sm">
                                    <p class="text-neutral-500">
                                        Anzahl: {{ $item->quantity }}
                                    </p>
                                    @if($item->shipping_status===\Daugt\Enums\Shop\ShippingStatus::PENDING->value)
                                        <p class="flex items-center text-yellow-500">
                                            Versand ausstehend
                                            @svg('truck', 'ml-1.5')
                                        </p>
                                    @endif
                                    @if($item->shipping_status===\Daugt\Enums\Shop\ShippingStatus::PROCESSING->value)
                                        <p class="flex items-center text-primary-500">
                                            Bestellung wird verarbeitet
                                            @svg('clock', 'ml-1.5')
                                        </p>
                                    @endif
                                    @if($item->shipping_status===\Daugt\Enums\Shop\ShippingStatus::SHIPPED->value)
                                        <p class="flex items-center text-green-500">
                                            Bestellung wurde versandt
                                            @svg('truck', 'ml-1.5')
                                        </p>
                                    @endif
                                </div>
                            @endif
                            @if($order->status === 'paid' && !empty($item->product->course_id))
                                <div>
                                    <a href="{{route('daugt.member-area.course.show', ['course' => \Daugt\Models\Listing\Listing::findOrFail($item->product->course_id)->slug, 'section' => 'all']) }}"
                                       class="inline-flex items-center justify-start px-1.5 text-sm rounded-md bg-gradient-to-bl from-green-400 to-green-600 text-green-50 cursor-pointer hover:text-white hover:to-green-500">
                                        @svg('unlock', 'h-3 w-3 mr-1.5')
                                        Kurs ansehen
                                    </a>
                                </div>
                            @endif
                            @if($order->status === 'paid' && !empty($item->product->content_id))
                                <div>
                                    <a href="{{route('daugt.member-area.post.show', \Daugt\Models\Content\Content::where('id', $item->product->content_id)->first()->slug) }}"
                                       class="inline-flex items-center justify-start px-1.5 text-sm rounded-md bg-gradient-to-bl from-green-400 to-green-600 text-green-50 cursor-pointer hover:text-white hover:to-green-500">
                                        @svg('unlock', 'h-3 w-3 mr-1.5')
                                        Inhalt ansehen
                                    </a>
                                </div>
                            @endif
                            @if($order->status !== 'paid' && ($item->product->course_id || $item->product->content_id))
                                <span class="text-neutral-600 text-sm">Medien werden erst nach erfolgreicher Bezahlung freigeschalten.</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </li>
    @empty
        <p class="my-2 bg-neutral-100/75 rounded-lg px-4 py-2">Keine Bestellungen vorhanden</p>
    @endforelse

    <div class="mt-4 w-full">
        {{ $orders->links() }}
    </div>
</ul>