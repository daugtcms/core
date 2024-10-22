<form class="p-3" wire:submit="save">
    <x-daugt::modal.header>Bestellung #{{$order->id}}</x-daugt::modal.header>
    <div class="overflow-hidden bg-white">
        <div>
            <dl class="sm:divide-y sm:divide-gray-200">
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Datum
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$order->created_at->format('d.m.Y H:i:s')}}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Status
                    </dt>
                    <dd class="flex items-center justify-start mt-1 text-sm text-gray-900 sm:mt-0 w-full sm:col-span-2">
                        @can('edit orders')
                            @php
                                $statuses = collect(\Daugt\Enums\Shop\PaymentStatus::cases())->map(function(\Daugt\Enums\Shop\PaymentStatus $item) {
                                    return [
                                        'value' => $item->value,
                                        'label' => $item->name,
                                    ];
                                })->toJson()
                            @endphp
                            <x-daugt::form.select :options="$statuses" wire:model.live="status"
                                                     class="w-full"></x-daugt::form.select>
                        @else
                            @if($order->status==="paid")
                                <div
                                        class="w-3 h-3 shrink-0 mr-1.5 rounded-full bg-gradient-to-tr from-green-300 to-green-600">
                                </div>
                                <p class="inline-flex items-center text-sm">
                                    Bezahlung erfolgreich
                                </p>
                            @endif
                            @if($order->status==="pending")
                                <div
                                        class="w-3 h-3 shrink-0 mr-1.5 rounded-full bg-gradient-to-tr from-yellow-300 to-yellow-600">
                                </div>
                                <p class="inline-flex items-center text-sm">
                                    Bezahlung ausstehend
                                </p>
                            @endif
                            @if($order->status==="failed")
                                <div class="w-3 h-3 shrink-0 mr-1.5 rounded-full bg-gradient-to-tr from-red-300 to-red-600">
                                </div>
                                <p class="inline-flex items-center text-sm text-red-500">
                                    Bezahlung fehlgeschlagen.
                                </p>
                            @endif
                        @endcan
                    </dd>
                </div>

                @if($order->amount_shipping)
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Lieferadresse
                            {{--<br>
                            <span class="mt-2">Bearbeiten im</span>
                            <a href="{{route('daugt.billing')}}"
                                class="inline-flex text-gray-500 bg-gray-100 hover:bg-gray-200 hover:text-gray-600 py-0.5 px-1.5 rounded-md">
                                Abrechnungsportal
                                <x-heroicon-s-arrow-top-right-on-square class="ml-0.5 h-3.5 w-3.5 shrink-0" />
                            </a>--}}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$order->address['shipping']['name']}}<br>
                            {{$order->address['shipping']['address']['line1']}}<br>
                            @if($order->address['shipping']['address']['line2'])
                                {{$order->address['shipping']['address']['line2']}}
                                <br>
                            @endif
                            {{$order->address['shipping']['address']['country'] . ' ' .
                            $order->address['shipping']['address']['postal_code'] . ' ' .
                            $order->address['shipping']['address']['city']}}
                        </dd>
                    </div>
                @endif
                @if($order->amount_discount)
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Gesamtrabatt
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            €@number($order->amount_discount / 100)
                        </dd>
                    </div>
                @endif
                @if($order->amount_shipping)
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Versandkosten
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            €@number($order->amount_shipping / 100)
                        </dd>
                    </div>
                @endif
                @if($invoice && isset($invoice['customer_address']))
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Rechnungsadresse
                            {{--<br>
                            <span class="mt-2">Bearbeiten im</span>
                            <a href="{{route('daugt.billing')}}"
                                class="inline-flex text-gray-500 bg-gray-100 hover:bg-gray-200 hover:text-gray-600 py-0.5 px-1.5 rounded-md">
                                Abrechnungsportal
                                <x-heroicon-s-arrow-top-right-on-square class="ml-0.5 h-3.5 w-3.5 shrink-0" />
                            </a>--}}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$invoice['customer_name']}}<br>
                            {{$invoice['customer_address']['line1']}}<br>
                            @if($invoice['customer_address']['line2'])
                                {{$invoice['customer_address']['line2']}}
                                <br>
                            @endif
                            {{$invoice['customer_address']['country'] . ' ' .
                            $invoice['customer_address']['postal_code'] . ' ' .
                            $invoice['customer_address']['city']}}
                        </dd>
                    </div>
                @endif
                @if($invoice && isset($invoice['shipping_details']))
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Lieferadresse
                            {{--<br>
                            <span class="mt-2">Bearbeiten im</span>
                            <a href="{{route('daugt.billing')}}"
                                class="inline-flex text-gray-500 bg-gray-100 hover:bg-gray-200 hover:text-gray-600 py-0.5 px-1.5 rounded-md">
                                Abrechnungsportal
                                <x-heroicon-s-arrow-top-right-on-square class="ml-0.5 h-3.5 w-3.5 shrink-0" />
                            </a>--}}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$invoice['shipping_details']['name']}}<br>
                            {{$invoice['shipping_details']['address']['line1']}}<br>
                            @if($invoice['shipping_details']['address']['line2'])
                                {{$invoice['shipping_details']['address']['line2']}}
                                <br>
                            @endif
                            {{$invoice['shipping_details']['address']['country'] . ' ' .
                            $invoice['shipping_details']['address']['postal_code'] . ' ' .
                            $invoice['shipping_details']['address']['city']}}
                        </dd>
                    </div>
                @endif
                @if($invoice)
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Gesamtpreis<br>
                            <span class="text-xs">inkl. MwSt., Rabatt & Versand</span>
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            €@number(((int) $invoice['total'])/100)
                        </dd>
                    </div>
                @endif
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Rechnungen<br>
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if($invoice)
                            <ul role="list" class="border border-gray-200 divide-y divide-gray-200 rounded-md">
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex items-center flex-1 w-0">
                                        <!-- Heroicon name: solid/paper-clip -->
                                        <svg class="shrink-0 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        <span class="flex-1 w-0 ml-2 truncate">
                                        Rechnung #{{$invoice['number']}}
                                    </span>
                                    </div>
                                    <div class="shrink-0 ml-4">
                                        <a href="{{$invoice['hosted_invoice_url']}}" target="_blank"
                                           class="font-medium text-primary-600 hover:text-primary-500">
                                            Anzeigen
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        @else
                            Noch keine Rechnung vorhanden.
                        @endif

                    </dd>
                </div>
            </dl>
        </div>
    </div>
    <ul class="bg-neutral-50 divide-y divide-neutral-200 rounded-md border-2 border-neutral-100 overflow-hidden">
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
                    @if($order->status === 'paid' && !empty($item->product->course_id))
                        <div>
                            <a href="{{route('daugt.member-area.course.show', ['course' => \Daugt\Models\Listing\Listing::findOrFail($item->product->course_id)->slug, 'section' => 'all'])}}"
                               class="inline-flex items-center justify-start px-1.5 text-sm rounded-md bg-gradient-to-bl from-green-400 to-green-600 text-green-50 cursor-pointer hover:text-white hover:to-green-500">
                                <div class="i-lucide:unlock h-3 w-3 mr-1.5"></div>
                                Kurs ansehen
                            </a>
                        </div>
                    @endif
                    @if($order->status !== 'paid' && $item->product->course_id || $item->product->content_id)
                        <span class="text-neutral-600 text-sm">Medien werden erst nach erfolgreicher Bezahlung freigeschalten.</span>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</form>