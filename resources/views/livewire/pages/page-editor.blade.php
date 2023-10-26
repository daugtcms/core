<div class="h-full">
    <x-sitebrew::layouts.dashboard-bar>
        <h1 class="text-lg font-medium text-neutral-800">{{__('sitebrew::page.editing_page')}}</h1>
        <div class="inline-flex">
            <x-sitebrew::core.button style="primary"
                                      wire:click="save">{{__('sitebrew::general.save')}}</x-sitebrew::core.button>
        </div>
    </x-sitebrew::layouts.dashboard-bar>
    <div class="max-w-7xl px-3 mx-auto gap-y-2 flex flex-col mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
            <x-sitebrew::form.label>{{__('sitebrew::general.title')}}</x-sitebrew::form.label>
            <x-sitebrew::form.input wire:model="title"
                                     :error="$errors->first('title')"></x-sitebrew::form.input>
        </div>
        <div class="col-span-full">
            <x-sitebrew::form.label>{{__('sitebrew::general.description')}}</x-sitebrew::form.label>
            <x-sitebrew::form.textarea wire:model="description"
                                        :error="$errors->first('description')"></x-sitebrew::form.textarea>
        </div>
        <div class="col-span-3">
            <x-sitebrew::form.label>{{__('sitebrew::general.content')}}</x-sitebrew::form.label>
            <x-sitebrew::core.button
                    class="w-full"
                    wire:click="openBlockEditor()"
                    style="light">{{__('sitebrew::blocks.open_block_editor')}}</x-sitebrew::core.button>
        </div>
    </div>
    @if($showBlockEditor)
        <div class="absolute inset-0">
            <livewire:sitebrew::block-editor :data="$blocks"></livewire:sitebrew::block-editor>
        </div>
    @endif
</div>
