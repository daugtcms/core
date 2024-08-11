<form class="flex flex-col h-full" wire:submit="save">
    <x-daugt::modal.header class="px-3 pt-2 pb-2 !mb-0">{{$media->name}}</x-daugt::modal.header>
    <div class="flex-grow,l bg-neutral-100 block min-h-0 flex items-center justify-center">
        @switch($media->aggregate_type)
            @case(\Plank\Mediable\Media::TYPE_IMAGE)
                <img src="{{\Daugt\Helpers\Media\MediaHelper::getMedia($media, 'optimized')}}"
                     alt="{{$media->filename}}" @class(['max-h-full mx-auto my-auto max-w-full'])>
                @break
            @case(\Plank\Mediable\Media::TYPE_VIDEO)
                <video controls x-cloak x-init="new Plyr($el)" playsinline class="object-fit">
                    <source src="{{MediaHelper::getMedia($media, 'optimized')}}">
                </video>
                @break
            @case(\Plank\Mediable\Media::TYPE_AUDIO)
                <audio controls x-cloak x-init="new Plyr($el)">
                    <source src="{{MediaHelper::getMedia($media, 'optimized')}}">
                </audio>
                @break
            @default
                <div class="flex items-center justify-center w-full h-full flex-1 px-3">
                    <p class="py-3 leading-4 text-neutral-500 text-center">
                        {{__('daugt::media.no_preview_available')}}
                    </p>
                </div>
                @break
        @endswitch
    </div>
    <x-daugt::modal.footer class="justify-end p-3 pt-3 !mt-0">
        <div>
            <x-daugt::form.button type="button" style="danger"
                                     wire:confirm="{{__('daugt::media.delete_media_confirmation')}}"
                                     wire:click="delete()">{{__('daugt::general.delete')}}</x-daugt::form.button>
        </div>
    </x-daugt::modal.footer>
</form>