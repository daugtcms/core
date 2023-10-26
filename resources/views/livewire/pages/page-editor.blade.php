<div class="h-full">
    <x-site-core::layouts.dashboard-bar>
        <h1 class="text-lg font-medium text-neutral-800">{{__('site-core::page.editing_page')}}</h1>
        <div class="inline-flex">
            <x-site-core::core.button style="primary"
                                      wire:click="save">{{__('site-core::general.save')}}</x-site-core::core.button>
        </div>
    </x-site-core::layouts.dashboard-bar>
    <div class="max-w-7xl px-3 mx-auto gap-y-2 flex flex-col mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
            <x-site-core::form.label>{{__('site-core::general.title')}}</x-site-core::form.label>
            <x-site-core::form.input wire:model="title"
                                     :error="$errors->first('title')"></x-site-core::form.input>
        </div>
        <div class="col-span-full">
            <x-site-core::form.label>{{__('site-core::general.description')}}</x-site-core::form.label>
            <x-site-core::form.textarea wire:model="description"
                                        :error="$errors->first('description')"></x-site-core::form.textarea>
        </div>
        <div class="col-span-3">
            <x-site-core::form.label>{{__('site-core::general.content')}}</x-site-core::form.label>
            <x-site-core::core.button
                    class="w-full"
                    wire:click="openBlockEditor()"
                    style="light">{{__('site-core::blocks.open_block_editor')}}</x-site-core::core.button>
        </div>
    </div>
    @if($showBlockEditor)
        <div class="absolute inset-0">
            <livewire:site-core::block-editor :data="$blocks"></livewire:site-core::block-editor>
        </div>
    @endif
</div>
