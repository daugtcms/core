<div @class([
        'rounded-md overflow-hidden' => $isPicker
])>
    <x-sitebrew::layouts.dashboard-bar>
        <div class="inline-flex items-center gap-x-2" x-data @if($isPicker) x-mousetrap.esc="$wire.closeModal()" @endif>
            @if($isPicker)<x-sitebrew::form.icon-button icon="chevron-left" class="-ml-2" wire:click="closeModal()"></x-sitebrew::form.icon-button>@endif
            <h1 class="text-lg font-medium text-neutral-800">Media Manager</h1>
        </div>
        <x-sitebrew::form.button
                wire:click="$dispatch('modal.open', { component: 'sitebrew::media.media-uploader' })"
                class="flex-shrink-0 ml-2">
            {{__('sitebrew::media.upload')}}
            @svg('plus', 'w-5 h-5')
        </x-sitebrew::form.button>
    </x-sitebrew::layouts.dashboard-bar>

    <div class="max-w-7xl mx-auto p-3 flex h-full">
        <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-6 xl:gap-x-8">
            @foreach($files as $file)
                @php($isSelected = $selectedMedia->contains('id', $file->id))
                <li class="relative" wire:click="selectFile('{{$file->id}}')">
                    <div
                        @class([
                            'ring-2 !ring-primary-500 ring-offset-2 !bg-primary-50' => $isSelected,
                            'group aspect-[10/7] block w-full overflow-hidden rounded-lg bg-white border-neutral-200 border-2 focus-within:ring-2 focus-within:ring-neutral-200 focus-within:ring-offset-2 focus-within:ring-offset-neutral-100'
                        ])>
                        <img src="{{MediaHelper::getMedia($file, 'thumbnail')}}"
                             alt=""
                            @class([
                                "bg-blend-screen" => $isSelected,
                                "pointer-events-none object-contain group-hover:opacity-75 h-full w-full"
                            ])>
                        <button type="button" class="absolute inset-0 focus:outline-none">
                            <span class="sr-only">View details</span>
                        </button>
                    </div>
                    <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-neutral-900">
                        {{$file->name}}</p>
                    <p class="pointer-events-none block truncate text-sm font-medium text-neutral-500">{{__("sitebrew::media.aggregate_type.$file->aggregate_type")}}</p>
                </li>
            @endforeach
        </ul>
    </div>
</div>