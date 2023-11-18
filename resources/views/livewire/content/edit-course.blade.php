<form class="p-3" wire:submit="save">
    <x-sitebrew::modal.header>{{__('sitebrew::content.manage_course')}}</x-sitebrew::modal.header>
    <div class="flex flex-col gap-y-2">
        <div>
            <x-sitebrew::form.label for="name">{{__('sitebrew::general.name')}}</x-sitebrew::form.label>
            <x-sitebrew::form.input id="name" wire:model.blur="name" :error="$errors->first('name')"/>
        </div>
        <div>
            <x-sitebrew::form.label for="starts_at">{{__('sitebrew::general.starts_at')}}
                <x-slot name="additional">{{__('sitebrew::content.leave_empty_for_continuous_course')}}</x-slot>
            </x-sitebrew::form.label>
            <x-sitebrew::form.input id="starts_at" wire:model.blur="starts_at" type="date" :error="$errors->first('starts_at')"/>
        </div>
        <div>
            <x-sitebrew::form.label for="ends_at">{{__('sitebrew::general.ends_at')}}
            <x-slot name="additional">{{__('sitebrew::content.leave_empty_for_continuous_course')}}</x-slot>
            </x-sitebrew::form.label>
            <x-sitebrew::form.input id="ends_at" wire:model.blur="ends_at" type="date" :error="$errors->first('ends_at')"/>
        </div>
        @if($course->id)
        <div class="w-full flex">
            <livewire:sitebrew::content.course-sections-table :course="$course->id"></livewire:sitebrew::content.course-sections-table>
        </div>
        @endif
    </div>
    <x-sitebrew::modal.footer class="justify-end">
        <x-sitebrew::form.button style="primary">{{__('sitebrew::general.save')}}</x-sitebrew::form.button>
    </x-sitebrew::modal.footer>
</form>