<form class="p-3" wire:submit="save">
    @php
        $isOwnProfile = $this->user->id === auth()->user()->id;
    @endphp
    <x-daugt::modal.header>{{__($isOwnProfile ? 'daugt::users.edit_profile' : 'daugt::users.manage_user')}}</x-daugt::modal.header>
    <div class="flex flex-col gap-y-2">
        <div x-data="">
            <x-daugt::form.label for="photo">{{__('daugt::general.profile_picture')}}</x-daugt::form.label>
            <div class="flex items-center gap-x-3 py-2 relative">
                <x-daugt::loading.dots class="absolute h-16 w-16 top-2 fill-white rounded-full bg-black/25 z-10 p-1 left-0 opacity-0" x-on:click="photo.click()"     wire:loading.class="opacity-100" wire:target="photo"></x-daugt::loading.dots>
                @if ($photo)
                    <img class="object-cover h-16 w-16 rounded-full" src="{{ $photo->temporaryUrl() }}">
                @else
                <x-daugt::avatar :user="$this->user" class="w-16 h-16"></x-daugt::avatar>
                @endif
                <x-daugt::form.button wire:loading.attr="disabled" wire:target="photo" type="button" x-on:click="photo.click()" style="light">{{__('daugt::general.change')}}</x-daugt::form.button>
                <input type="file" x-ref="photo" id="photo" name="photo" class="hidden" wire:model="photo"/>
            </div>
        </div>
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