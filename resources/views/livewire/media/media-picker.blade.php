<div class="bg-neutral-200/50 border-neutral-200 border-2 shadow-sm rounded-md">
    <div class="p-2">
    <x-daugt::form.button
            wire:click="$dispatch('openModal', { component: 'daugt::media.media-manager', arguments: { isPicker: true, id: '{{$id}}', selectedMediaArray: {{collect($selectedMedia)}} } })"
            type="button"
            style="light"
            class="w-full shadow-md/50 bg-white">
        {{__('daugt::general.select_media')}}
    </x-daugt::form.button>
    </div>
    <div class="w-full max-h-64 overflow-y-auto divide-y-2 divide-neutral-200 flex flex-col">
        @foreach($fetchedMedia as $media)
            <div class="flex">
            <div class="flex items-center gap-x-2.5 py-2 px-2 flex-grow min-w-0">
                <img src="{{MediaHelper::getMedia($media, 'thumbnail')}}" class="w-14 h-14 object-cover rounded-md border-2 border-neutral-200 flex-shrink-0">
                <div class="inline-flex flex-col">
                    <p class="pointer-events-none block truncate text-sm font-medium text-neutral-900">
                        {{$media->name}}</p>
                    <p class="pointer-events-none block truncate text-sm font-medium text-neutral-500">{{__("daugt::media.aggregate_type.$media->aggregate_type")}}</p>
                </div>
            </div>
                <div class="flex items-center gap-x-2.5 py-2 px-2">
                    <x-daugt::form.icon-button
                            wire:click="removeMedia('{{$media->id}}')"
                            icon="lucide:trash"
                            style="danger">
                        {{__('daugt::general.delete')}}
                    </x-daugt::form.icon-button>
                </div>
            </div>
        @endforeach
    </div>
</div>