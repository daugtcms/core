<form class="p-3" wire:submit="save">
    @php
        $isOwnProfile = $this->user->id === auth()->user()->id;
    @endphp
    <x-daugt::modal.header>{{__($isOwnProfile ? 'daugt::users.edit_profile' : 'daugt::users.manage_user')}}</x-daugt::modal.header>
    <div class="flex flex-col gap-y-2">
        <div>
            <x-daugt::form.label for="name">{{__('daugt::general.username')}}</x-daugt::form.label>
            <x-daugt::form.input id="name" wire:model.blur="name" :error="$errors->first('name')"/>
        </div>
        <div>
            <x-daugt::form.label for="full_name">{{__('daugt::auth.full_name')}}</x-daugt::form.label>
            <x-daugt::form.input id="full_name" wire:model.blur="full_name" :error="$errors->first('full_name')"/>
        </div>
        <div class="pb-2">
            <x-daugt::form.label for="email">{{__('daugt::auth.email')}}</x-daugt::form.label>
            <x-daugt::form.label for="email" class="text-neutral-500 text-xs mb-1">{{__('daugt::users.verification_on_email_change')}}</x-daugt::form.label>

            <x-daugt::form.input id="email" wire:model.blur="email"
                                       :error="$errors->first('email')"/>

        </div>
    </div>
    <x-daugt::modal.footer class="justify-between">
        <div class="gap-x-2 flex">
            @if($this->user->id !== auth()->user()->id)
                <x-daugt::form.button type="button" style="danger" wire:confirm="{{__('daugt::users.delete_user_confirmation')}}" wire:click="delete({{$this->user->id}})">{{__('daugt::general.delete')}}</x-daugt::form.button>
                <x-daugt::form.button type="button" style="light" wire:click="impersonate({{$this->user->id}})">{{__('daugt::users.impersonate')}}</x-daugt::form.button>
            @endif
        </div>
        <x-daugt::form.button style="primary">{{__('daugt::general.save')}}</x-daugt::form.button>
    </x-daugt::modal.footer>
</form>