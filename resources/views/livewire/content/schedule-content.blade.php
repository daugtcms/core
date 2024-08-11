<form class="p-3" wire:submit="save">
    <x-daugt::modal.header>{{__('daugt::content.schedule_content')}}</x-daugt::modal.header>
    <div class="flex flex-col gap-y-2">
        <div>
            <x-daugt::form.label for="published_at">{{__('daugt::general.published_at')}}
            <x-slot:additional>{{__('daugt::content.published_at_description')}}</x-slot:additional></x-daugt::form.label>
            <x-daugt::form.input id="published_at" wire:model.blur="published_at" type="datetime-local" :error="$errors->first('published_at')"/>
        </div>
    </div>
    <x-daugt::modal.footer class="justify-end">
        <x-daugt::form.button style="primary">{{__('daugt::general.save')}}</x-daugt::form.button>
    </x-daugt::modal.footer>
</form>