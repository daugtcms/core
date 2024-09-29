<div class="container" wire:poll.10s>
    <h1 class="text-white/80 text-3xl sm:text-5xl font-semibold mt-4 sm:mt-10">Willkommen, {{Auth::user()->name}}!</h1>
    <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-x-3 gap-y-3 mt-4 sm:mt-8">
        <div class="col-span-2 row-span-2 rounded-lg bg-white/75 backdrop-blur-md shadow flex flex-col">
            <p class="text-neutral-800 font-medium text-xl border-b-2 border-neutral-200 px-3 py-2">Deine Kurse</p>
            <div class="flex-1 flex flex-col divide-y divide-neutral-200 overflow-y-auto">
                @forelse($courses as $course)
                    <div x-data @click="$refs.link.click()"
                         class="cursor-pointer w-full px-4 py-4 drop-shadow-sm hover:bg-white/50 focus:outline-none">
                        <div class="w-full flex flex-col items-between justify-center">
                            <a href="{{route('daugt.member-area.course.show', ['course' => $course->slug, 'section' => 'all'])}}"
                               class="inline-flex text font-medium truncate text-neutral-700" x-ref="link">
                                {{$course->name}}
                            </a>
                            @if(isset($course->data['starts_at']) && $course->data['starts_at'] > now())
                                <p class="text-sm text-neutral-500">Startet
                                    am {{\Carbon\Carbon::parse($course->data['starts_at'])->format('d.m.Y')}}</p>
                            @else
                                <div class="flex flex-wrap gap-x-1.5 gap-y-1.5 mt-0.5">
                                    @foreach($course->items as $item)
                                        <div>
                                            <a class="bg-primary-50 text-primary-600 rounded-md px-1.5 py-0.5 text-sm hover:bg-primary-100"
                                               href="{{route('daugt.member-area.course.show', ['course' => $course->slug, 'section' => $item->slug])}}">{{$item->name}}</a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="flex-1 flex items-center justify-center py-10">
                        <p class="text-neutral-500 text-sm">Du hast noch keinen Zugriff auf Kurse.</p>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="col-span-2 row-span-2 rounded-lg bg-white/75 backdrop-blur-md shadow flex flex-col overflow-hidden">
            <p class="text-neutral-800 font-medium text-xl border-b-2 border-neutral-200 px-3 py-2">Deine letzten
                Bestellungen</p>
            <div class="flex-1 flex flex-col divide-y divide-neutral-200 max-h-56 overflow-y-auto">
                @forelse($orders as $order)
                    <button wire:click="$dispatch('openModal', { component: 'daugt::shop.edit-order', arguments: { order: {{$order->id}} } })"
                            class="w-full px-4 py-4 hover:bg-white/50 drop-shadow-sm hover:bg-neutral-50 focus:outline-none">
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
                @empty
                    <div class="flex-1 flex items-center justify-center py-10">
                        <p class="text-neutral-500 text-sm">Du hast noch keine Bestellungen getätigt.</p>
                    </div>
                @endforelse
            </div>
            <a class="bg-neutral-100/50 w-full px-3 py-1.5 flex items-center focus:outline-none justify-between hover:bg-white/50 border-t border-neutral-200"
               href="{{route('daugt.member-area.orders.index')}}">Alle Bestellungen ansehen @svg('arrow-right', 'w-5 h-5')</a>
        </div>
        <div class="col-span-2 row-span-1 rounded-lg bg-white/75 backdrop-blur-md shadow">
            <p class="text-neutral-800 font-medium text-xl border-b-2 border-neutral-200 px-3 py-2">Dein Profil</p>
            <div class="flex items-center justify-between py-3 gap-x-3 px-3">
                <div class="flex items-center gap-x-3">
                    <x-daugt::avatar class="h-12 w-12"></x-daugt::avatar>
                    <div>
                        <p class="text-neutral-800 font-medium">{{ Auth::user()->name}}</p>
                        <p class="text-neutral-500 text-sm">{{Auth::user()->full_name}} - {{Auth::user()->email}}</p>
                    </div>
                </div>
                <x-daugt::form.icon-button icon="pencil"
                                              wire:click="$dispatch('openModal', {component: 'daugt::users.edit-user'})"></x-daugt::form.icon-button>
            </div>
        </div>
    </div>
</div>