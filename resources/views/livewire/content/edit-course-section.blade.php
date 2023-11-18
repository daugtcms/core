<form class="p-3" wire:submit="save">
    <x-sitebrew::modal.header>
        {{__('sitebrew::content.manage_course_section_for', ['course' => $course->name])}}
    </x-sitebrew::modal.header>
    <div class="flex flex-col gap-y-2">
        <div>
            <x-sitebrew::form.label for="section-name">{{__('sitebrew::general.name')}}</x-sitebrew::form.label>
            <x-sitebrew::form.input id="section-name" wire:model.blur="name" :error="$errors->first('name')"/>
        </div>
        <div class="flex flex-col gap-y-2">
            <x-sitebrew::form.checkbox name="users_can_comment" wire:model="users_can_comment">{{__('sitebrew::content.users_can_comment')}}</x-sitebrew::form.checkbox>
            <x-sitebrew::form.checkbox name="users_can_post" wire:model="users_can_post">{{__('sitebrew::content.users_can_post')}}</x-sitebrew::form.checkbox>
            <x-sitebrew::form.checkbox name="users_can_post_anonymously" wire:model="users_can_post_anonymously">{{__('sitebrew::content.users_can_post_anonymously')}}</x-sitebrew::form.checkbox>
        </div>
    </div>
    <x-sitebrew::modal.footer class="justify-end">
        <x-sitebrew::form.button style="primary">{{__('sitebrew::general.save')}}</x-sitebrew::form.button>
    </x-sitebrew::modal.footer>
</form>