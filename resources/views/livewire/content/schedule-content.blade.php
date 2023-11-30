<form class="p-3" wire:submit="save">
    <x-sitebrew::modal.header>{{__('sitebrew::content.schedule_content')}}</x-sitebrew::modal.header>
    <div class="flex flex-col gap-y-2">
        <div>
            <x-sitebrew::form.label for="published_at">{{__('sitebrew::general.published_at')}}
            <x-slot:additional>{{__('sitebrew::content.published_at_description')}}</x-slot:additional></x-sitebrew::form.label>
            <x-sitebrew::form.input id="published_at" wire:model.blur="published_at" type="datetime-local" :error="$errors->first('published_at')"/>
        </div>
    </div>
    <x-sitebrew::modal.footer class="justify-end">
        <x-sitebrew::form.button style="primary">{{__('sitebrew::general.save')}}</x-sitebrew::form.button>
    </x-sitebrew::modal.footer>
</form>