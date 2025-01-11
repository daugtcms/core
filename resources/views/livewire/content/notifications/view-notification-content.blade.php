<div class="p-2">
    <x-daugt::modal.header>{{__('daugt::content.notification.preview')}}</x-daugt::modal.header>
    <div class="flex flex-col gap-y-2 rounded-md overflow-hidden">
        {!! $content !!}
    </div>
    <x-daugt::modal.footer class="justify-end">
        <x-daugt::form.button style="primary">{{__('daugt::general.back')}}</x-daugt::form.button>
    </x-daugt::modal.footer>
</div>