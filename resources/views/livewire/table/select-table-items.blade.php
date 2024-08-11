<form class="p-3" wire:submit="save">
    <x-daugt::modal.header>{{__('daugt::general.select_items')}}</x-daugt::modal.header>
    @livewire($tableName, ['selectable' => true, 'allowCreate' => false ,'fullWidth' => true, 'selected' => $selected])
    <x-daugt::modal.footer class="justify-end">
        <x-daugt::form.button style="primary" type="button" wire:click="$dispatch('closeModal')">{{__('daugt::general.back')}}</x-daugt::form.button>
    </x-daugt::modal.footer>
</form>