<form class="flex flex-col h-full" wire:submit="save">
        <x-sitebrew::modal.header class="px-3 pt-2 pb-2 !mb-0">{{$media->name}}</x-sitebrew::modal.header>
    <div class="flex-grow min-h-0 -mx-2.5 bg-neutral-100">
        <img src="{{\Sitebrew\Helpers\Media\MediaHelper::getMedia($media, 'optimized')}}" class="h-full w-full object-contain">
    </div>
    <x-sitebrew::modal.footer class="justify-end p-3 pt-3 !mt-0">
        <div>
            <x-sitebrew::form.button type="button" style="danger" wire:confirm="{{__('sitebrew::media.delete_media_confirmation')}}" wire:click="delete()">{{__('sitebrew::general.delete')}}</x-sitebrew::form.button>
        </div>
    </x-sitebrew::modal.footer>
</form>