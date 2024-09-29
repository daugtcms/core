<x-daugt::layouts.admin>
    <div class="max-w-7xl mx-auto px-0 sm:px-4 mt-10">
        <div class="divide-y divide-neutral-200 overflow-hidden rounded-none sm:rounded-lg bg-neutral-200 shadow sm:grid sm:grid-cols-2 sm:gap-px sm:divide-y-0">
            @php
                $cases = Daugt\Enums\Admin\AdminPath::cases();
                $cases = collect($cases)->filter(fn($case) => $case != Daugt\Enums\Admin\AdminPath::ADMIN)->toArray();
            @endphp
            @foreach($cases as $path)
                <div class="group relative bg-white p-6">
                    @php($color = Daugt\Helpers\Admin\AdminPathColor::getColor($path))
                    <div>
              <span class="inline-flex rounded-lg p-3 ring-4 ring-white"
                    style="color: {{$color}}; background-color: {{$color}}22">
                @svg(Daugt\Helpers\Admin\AdminPathColor::getIcon($path))
              </span>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-base font-semibold leading-6 text-neutral-800">
                            <a href="{{route("daugt.admin.$path->value.index")}}" class="focus:outline-none">
                                <!-- Extend touch target to entire panel -->
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                {{__("daugt::general.$path->value")}}
                            </a>
                        </h3>
                        <p class="mt-2 text-sm text-neutral-500">{{__("daugt::general.$path->value.description")}}</p>
                    </div>
                    <span class="pointer-events-none absolute right-6 top-6 text-neutral-300 group-hover:text-neutral-400"
                          aria-hidden="true">
              @svg('move-up-right')
            </span>
                </div>
            @endforeach

            @if(count($cases) % 2 != 0)
                <div class="group relative bg-neutral-50 text-neutral-500 p-6 flex items-center justify-center">
                    {{__('daugt::general.more_to_come')}}
                </div>
            @endif
        </div>

</x-daugt::layouts.admin>