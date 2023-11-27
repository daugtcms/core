<form class="flex flex-col h-full" wire:submit="save">
    <x-sitebrew::modal.header class="px-3 pt-2 pb-2 !mb-0">{{$media->name}}</x-sitebrew::modal.header>
    <div class="flex-grow -mx-2.5 bg-neutral-100 block min-h-0 flex items-center justify-center">
        @switch($media->aggregate_type)
            @case(\Plank\Mediable\Media::TYPE_IMAGE)
                <img src="{{\Sitebrew\Helpers\Media\MediaHelper::getMedia($media, 'optimized')}}" alt="{{$media->filename}}" @class(['max-h-full mx-auto my-auto max-w-full'])>
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
                        {{__('sitebrew::media.no_preview_available')}}
                    </p>
                </div>
                @break
        @endswitch
    </div>
    <x-sitebrew::modal.footer class="justify-end p-3 pt-3 !mt-0">
        <div>
            <x-sitebrew::form.button type="button" style="danger" wire:confirm="{{__('sitebrew::media.delete_media_confirmation')}}" wire:click="delete()">{{__('sitebrew::general.delete')}}</x-sitebrew::form.button>
        </div>
    </x-sitebrew::modal.footer>
</form>