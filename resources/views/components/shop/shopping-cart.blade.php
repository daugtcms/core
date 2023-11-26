<div x-data="{ cartOpen: false }" x-init="window.location.search.includes('cart') ? cartOpen = true : cartOpen = false" class="p-0 m-0 h-full flex items-center justify-center">
  <button @click="cartOpen = !cartOpen"
    class="relative">
    {{$slot}}
    @if($cartItemsAmount)
    <div
      class="absolute pointer-events-none top-0 right-0 flex items-center justify-center w-5 h-5 -mt-0.5 -mr-0.5 text-xs font-bold text-white rounded-full bg-primary-500">
      {{$cartItemsAmount}}
    </div>
    @endif
  </button>
  <div x-cloak x-show="cartOpen" class="fixed inset-0 z-50 overflow-hidden" aria-labelledby="slide-over-title"
    role="dialog" aria-modal="true">
    <div class="absolute inset-0 overflow-hidden">
      <div x-show="cartOpen" @click="cartOpen = false" x-transition:enter="transition ease-in-out duration-500"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-500" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-0 transition-opacity bg-neutral-500 bg-opacity-50 backdrop-blur-sm" aria-hidden="true">
      </div>

      <div class="fixed inset-y-0 right-0 flex max-w-full pl-10">
        <div x-show="cartOpen" x-transition:enter="ease-in-out transition duration-500 sm:duration-700"
          x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
          x-transition:leave="transition ease-in-out duration-500 sm:duration-700"
          x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="w-screen max-w-md">
          <div class="flex flex-col h-full overflow-y-auto bg-white shadow-xl">
            <div class="flex-1 px-4 py-6 overflow-y-auto sm:px-6">
              <div class="flex items-start justify-between">
                <h2 class="text-lg font-medium text-neutral-900" id="slide-over-title">
                  Einkaufswagen
                </h2>
                <div class="flex items-center ml-3 h-7">
                  <button type="button" class="p-2 -m-2 text-neutral-400 hover:text-neutral-500"
                    @click="cartOpen = !cartOpen">
                    <span class="sr-only">Close panel</span>
                    <!-- Heroicon name: outline/x -->
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>
              </div>

              <div class="mt-8">
                <div class="flow-root">
                  <ul role="list" class="-my-6 divide-y divide-neutral-200">
                    @forelse ($cart as $item)
                    <li class="flex py-6">
                      <div class="shrink-0 w-20 h-20 overflow-hidden border-2 rounded-md border-neutral-200">
                        <img src="{{ MediaHelper::getMedia($item->firstMedia('media'), 'thumbnail'), }}"
                          class="object-cover object-center w-full h-full">
                      </div>

                      <div class="flex flex-col flex-1 ml-4">
                        <div>
                          <div class="flex justify-between text-base font-medium text-neutral-900">
                            <h3>
                              <a href="{{ route('shop.product.show', $item->slug) }}">
                                {{ $item->name }}
                              </a>
                            </h3>
                            <p class="ml-4">
                              €@number($item->price)
                            </p>
                          </div>
                        </div>
                        @if($item->type === 'subscription')
                        <h3 class="text-base text-primary-600">
                          @if($item->interval === 'week')<span>Wöchentliches</span>@endif
                          @if($item->interval === 'month')<span>Monatliches</span>@endif
                          @if($item->interval === '3month')<span>3-Monatliches</span>@endif
                          @if($item->interval === 'year')<span>Jährliches</span>@endif
                          Abonnement
                        </h3>
                        @endif
                        @if($item->shipping)
                        <h3 class="text-base text-primary-600">Versandware</h3>
                        @endif
                        <div class="flex items-end justify-between flex-1 text-sm">
                          <p class="text-neutral-500">
                            Anzahl: {{ $item->amount }}
                          </p>

                          <form class="flex" action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                              class="font-medium text-primary-600 hover:text-primary-500">Entfernen</button>
                          </form>
                        </div>
                      </div>
                    </li>
                    @empty
                    <p class="items-center justify-center mt-8 font-medium text-center text-neutral-500">
                      Keine Produkte
                      hinzugefügt</p>
                    @endforelse


                    <!-- More products... -->
                  </ul>
                </div>
              </div>
            </div>

            @php
                $country = Locale::getDisplayRegion(config('sitebrew.shop.shipping.locale'), config('sitebrew.shop.shipping.locale'));
            @endphp
            <div class="px-4 py-6 border-t border-neutral-200 sm:px-6 @if($disabled) pointer-events-none @endif" x-data="{
              within_country: true,
              formatPrice(price) {
                var formatter = new Intl.NumberFormat('de-AT', {
                  style: 'currency',
                  currency: 'EUR',
                });

                return formatter.format(price);
              }
            }">
              {{--@if($disabled)
              <x-label class="px-2 py-1 mb-3 -mt-3 text-red-700 bg-red-100 rounded-md">
                Abonnements & Versandwaren müssen aufgrund technischer Limitierungen separat bestellt werden. Um
                Fortzufahren, entfernen sie einen der beiden Typen aus dem Warenkorb
              </x-label>
              @endif--}}
              @if($includesShipping && !$includesSubscription)
              <label for="shipping" class="inline-flex items-center pb-3">
                <input id="shipping" x-model="within_country" type="checkbox" name="shipping">
                <span class="ml-2 text-sm text-neutral-600">Versand innerhalb {{$country}}</span>
              </label>
              <div class="flex justify-between text-sm font-medium text-neutral-900">
                <p>Zwischensumme</p>
                <p x-text="formatPrice({{$total}})"></p>
              </div>
              <div class="flex justify-between text-sm font-normal text-neutral-500">
                <p>Versand <span x-show="within_country">nach {{$country}}</span><span x-show="!within_country">außerhalb {{$country}}</span></p>
                <p x-text="formatPrice(within_country ? 5 : 10)"></p>
              </div>
              <div class="flex justify-between mt-1 text-base font-medium text-neutral-900 border-t-2">
                <p>Gesamtpreis</p>
                <p x-text="formatPrice({{$total}} + (within_country ? 5 : 10))"></p>
              </div>
              @else
              @if(!$includesShipping)
              <div class="flex justify-between text-sm font-medium text-neutral-900">
                <p>Zwischensumme</p>
                <p x-text="formatPrice({{$total}})"></p>
              </div>
              <div class="flex justify-between text-sm font-normal text-neutral-500">
                <p>Versand </p>
                <p>GRATIS - Keine Versandwaren</p>
              </div>
              @endif
              <div class="flex justify-between mt-1 text-base font-medium text-neutral-900 border-t-2">
                <p>Gesamtpreis</p>
                <p x-text="formatPrice({{$total}})"></p>
              </div>
              @endif
              {{--<div class="mt-6">
                @if($includesSubscription && !$includesShipping)
                <x-label class="px-2 py-1 my-3 rounded-md bg-primary-100 text-primary-700">
                  Einkäufe die ein automatisches Abonnement beinhalten, können ausschließlich mit Kredit- bzw.
                  Debitkarte bezahlt
                  werden.
                </x-label>
                @endif
                <x-button href="{{route('checkout')}}"
                  x-bind:href="'{{route('checkout')}}' + (austria ? '?austria' : '')" :style="'primary'"
                  :class="$disabled ? 'w-full py-2 text-base opacity-50 pointer-events-none' : 'w-full py-2 text-base'">
                  Jetzt
                  kaufen</x-button>
              </div>
              --}}
              <x-sitebrew::form.button href="{{route('checkout')}}"
                        x-bind:href="'{{route('checkout')}}' + (within_country ? '?within_country' : '')" :style="'primary'"
                        :class="$disabled ? 'w-full py-2 text-base opacity-50 pointer-events-none mt-2' : 'w-full py-2 text-base mt-2'">
                Jetzt
                kaufen</x-sitebrew::form.button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
