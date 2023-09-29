<form class="p-3" wire:submit="save">
    <x-site-core::modal.header>{{__('site-core::navigation.create_navigation_menu')}}</x-site-core::modal.header>
    <div class="flex flex-col gap-y-2">
        <div>
            <x-site-core::form.label for="name">{{__('site-core::general.name')}}</x-site-core::form.label>
            <x-site-core::form.input id="name" wire:model.blur="name" :error="$errors->first('name')"/>
        </div>
        <div>
            <x-site-core::form.label for="title">{{__('site-core::general.description')}}</x-site-core::form.label>
            <x-site-core::form.textarea id="title" wire:model.blur="description"
                                        :error="$errors->first('description')"/>
        </div>
    </div>
    <x-site-core::modal.footer class="justify-end">
        <x-site-core::core.button style="primary">{{__('site-core::general.save')}}</x-site-core::core.button>
    </x-site-core::modal.footer>
</form>