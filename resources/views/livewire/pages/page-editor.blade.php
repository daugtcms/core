<div class="h-full">
    <x-daugt::layouts.dashboard-bar>
        <h1 class="text-lg font-medium text-neutral-800">{{__('daugt::page.editing_page')}}</h1>
        <div class="inline-flex">
            <x-daugt::form.button style="primary"
                                      wire:click="save">{{__('daugt::general.save')}}</x-daugt::form.button>
        </div>
    </x-daugt::layouts.dashboard-bar>
    <div class="max-w-7xl px-3 mx-auto gap-y-2 flex flex-col mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
            <x-daugt::form.label>{{__('daugt::general.title')}}</x-daugt::form.label>
            <x-daugt::form.input wire:model="title"
                                     :error="$errors->first('title')"></x-daugt::form.input>
        </div>
        <div class="col-span-full">
            <x-daugt::form.label>{{__('daugt::general.description')}}</x-daugt::form.label>
            <x-daugt::form.textarea wire:model="description"
                                        :error="$errors->first('description')"></x-daugt::form.textarea>
        </div>
        <div class="col-span-3">
            <x-daugt::form.label>{{__('daugt::general.content')}}</x-daugt::form.label>
            <x-daugt::form.button
                    class="w-full"
                    wire:click="openBlockEditor()"
                    style="light">{{__('daugt::blocks.open_block_editor')}}</x-daugt::form.button>
        </div>
    </div>
    @if($showBlockEditor)
        <div class="absolute inset-0">
            <livewire:daugt::block-editor :data="$blocks"></livewire:daugt::block-editor>
        </div>
    @endif
</div>
