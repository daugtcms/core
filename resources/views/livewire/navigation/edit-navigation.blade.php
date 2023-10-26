<form class="p-3" wire:submit="save">
    <x-sitebrew::modal.header>{{__('sitebrew::navigation.manage_navigation_menu')}}</x-sitebrew::modal.header>
    <div class="flex flex-col gap-y-2">
        <div>
            <x-sitebrew::form.label for="name">{{__('sitebrew::general.name')}}</x-sitebrew::form.label>
            <x-sitebrew::form.input id="name" wire:model.blur="name" :error="$errors->first('name')"/>
        </div>
        <div>
            <x-sitebrew::form.label for="title">{{__('sitebrew::general.description')}}</x-sitebrew::form.label>
            <x-sitebrew::form.textarea id="title" wire:model.blur="description"
                                        :error="$errors->first('description')"/>
        </div>
    </div>
    <x-sitebrew::modal.footer class="justify-end">
        <x-sitebrew::core.button style="primary">{{__('sitebrew::general.save')}}</x-sitebrew::core.button>
    </x-sitebrew::modal.footer>
</form>