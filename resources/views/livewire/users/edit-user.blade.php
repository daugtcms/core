<form class="p-3" wire:submit="save">
    <x-sitebrew::modal.header>{{__('sitebrew::users.manage_user')}}</x-sitebrew::modal.header>
    <div class="flex flex-col gap-y-2">
        <div>
            <x-sitebrew::form.label for="name">{{__('sitebrew::general.username')}}</x-sitebrew::form.label>
            <x-sitebrew::form.input id="name" wire:model.blur="name" :error="$errors->first('name')"/>
        </div>
        <div>
            <x-sitebrew::form.label for="full_name">{{__('sitebrew::auth.full_name')}}</x-sitebrew::form.label>
            <x-sitebrew::form.input id="full_name" wire:model.blur="full_name" :error="$errors->first('full_name')"/>
        </div>
        <div class="pb-2">
            <x-sitebrew::form.label for="email">{{__('sitebrew::auth.email')}}</x-sitebrew::form.label>
            <x-sitebrew::form.label for="email" class="text-neutral-500 text-xs mb-1">{{__('sitebrew::users.verification_on_email_change')}}</x-sitebrew::form.label>

            <x-sitebrew::form.input id="email" wire:model.blur="email"
                                       :error="$errors->first('email')"/>

        </div>
    </div>
    <x-sitebrew::modal.footer class="justify-between">
        <div>
            @if($this->user->id !== auth()->user()->id)
                <x-sitebrew::form.button type="button" style="danger" wire:confirm="{{__('sitebrew::users.delete_user_confirmation')}}" wire:click="delete({{$this->user->id}})">{{__('sitebrew::general.delete')}}</x-sitebrew::form.button>
            @endif
        </div>
        <x-sitebrew::form.button style="primary">{{__('sitebrew::general.save')}}</x-sitebrew::form.button>
    </x-sitebrew::modal.footer>
</form>