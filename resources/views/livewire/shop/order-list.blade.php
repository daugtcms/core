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
                                        <p class="flex items-center text-warning-500">
                                            Versand ausstehend
                                            <span class="i-lucide:truck ml-1.5"></span>
                                        </p>
                                    @endif
                                    @if($item->shipping_status===\Daugt\Enums\Shop\ShippingStatus::PROCESSING->value)
                                        <p class="flex items-center text-primary-500">
                                            Bestellung wird verarbeitet
                                        <span class="i-lucide:clock ml-1.5"></span>
                                        </p>
                                    @endif
                                    @if($item->shipping_status===\Daugt\Enums\Shop\ShippingStatus::SHIPPED->value)
                                        <p class="flex items-center text-success-500">
                                            Bestellung wurde versandt
                                        <span class="i-lucide:truck ml-1.5"></span>
                                        </p>
                                    @endif
                                </div>
                            @endif
                            <table class="text-neutral-700 border-separate border-spacing-y-2">
                            @if($order->status === 'paid' && !empty($item->product->courses))
                                @foreach($item->product->courses as $course)
                                    <tr class="bg-white rounded-md">
                                        <td class="px-2 py-1.5">
                                            <a href="{{route('daugt.member-area.course.show', ['course' => $course->slug, 'section' => 'all']) }}" class="inline-flex gap-x-1 items-center">
                                                {{$course->name}}
                                                <div class="i-lucide:square-arrow-out-up-right h-3 w-3 mr-1.5"></div>
                                            </a>
                                        </td>
                                        <td class="px-2 py-1.5">
                                            @php
                                                $timestamps = $item->getAccessTimestamps($course);
                                            @endphp
                                            @if($timestamps['starts_at'] && $timestamps['ends_at'])
                                            {{$timestamps['starts_at']->format('d.m.Y')}} - {{$timestamps['ends_at']->format('d.m.Y')}}
                                            @else
                                            <div class="i-lucide:unlock h-3 w-3 mr-1.5"></div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if($order->status === 'paid' && !empty($item->product->posts))
                                @foreach($item->product->posts as $post)
                                    <tr class="bg-white rounded-md">
                                        <td class="px-2 py-1.5">
                                            <a href="{{route('daugt.content.show', ['post', $post->slug]) }}" class="inline-flex gap-x-1 items-center">
                                                {{$post->title}}
                                                <div class="i-lucide:square-arrow-out-up-right h-3 w-3 mr-1.5"></div>
                                            </a>
                                        </td>
                                        <td class="px-2 py-1.5">
                                            @php
                                                $timestamps = $item->getAccessTimestamps($post);
                                            @endphp
                                            @if($timestamps['starts_at'] && $timestamps['ends_at'])
                                                {{$timestamps['starts_at']->format('d.m.Y')}} - {{$timestamps['ends_at']->format('d.m.Y')}}
                                            @else
                                                <div class="i-lucide:unlock h-3 w-3 mr-1.5"></div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </table>
                            @if($order->status !== 'paid' && ($item->product->courses() || $item->product->posts()))
                                <span class="text-neutral-600 text-sm">Medien werden erst nach erfolgreicher Bezahlung freigeschalten.</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </li>
    @empty
        <p class="my-2 bg-white shadow-md rounded-lg px-4 py-4">Keine Bestellungen vorhanden</p>
    @endforelse

    <div class="mt-4 w-full">
        {{ $orders->links() }}
    </div>
</ul>