<form class="p-3" wire:submit="save">
    <x-sitebrew::modal.header>{{__('sitebrew::general.select_items')}}</x-sitebrew::modal.header>
    @livewire($tableName, ['selectable' => true, 'allowCreate' => false ,'fullWidth' => true, 'selected' => $selected])
    <x-sitebrew::modal.footer class="justify-end">
        <x-sitebrew::form.button style="primary" type="button" wire:click="$dispatch('modal.close')">{{__('sitebrew::general.back')}}</x-sitebrew::form.button>
    </x-sitebrew::modal.footer>
</form>