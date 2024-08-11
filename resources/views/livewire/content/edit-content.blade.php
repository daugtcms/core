<div>
    <x-daugt::layouts.dashboard-bar>
        <h1 class="text-lg font-medium text-neutral-800 flex items-center gap-x-2">{{$title ?: __('daugt::general.homepage')}}</h1>

        <div class="flex items-center gap-x-2">
        <x-daugt::form.icon-button
                wire:click="delete"
                wire:confirm="{{__('daugt::general.delete_confirmation')}}"
                class="flex-shrink-0 ml-2"
                icon="trash"
                style="danger">
            {{__('daugt::general.add')}}
            @svg('plus', 'w-5 h-5')
        </x-daugt::form.icon-button>
        <x-daugt::form.button wire:click="save">
            {{__('daugt::general.save')}}
        </x-daugt::form.button>
        </div>
    </x-daugt::layouts.dashboard-bar>
    <div class="max-w-7xl mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="col-span-1">
                <x-daugt::form.label>{{__('daugt::general.title')}}</x-daugt:x-daugt::form.label>
                <x-daugt::form.input wire:model.blur="title"></x-daugt::form.input>
            </div>
            <div class="col-span-1">
                <x-daugt::form.label>{{__('daugt::general.type')}}</x-daugt:x-daugt::form.label>
                @php
                    $options = \Daugt\Misc\ContentTypeRegistry::getContentTypes();
                    $types = [];
                    $options = $options->each(function($option, $key) use(&$types) {
                        $types[] = [
                            'value' => $key,
                            'title' => $option->name
                        ];
                    });

                    $types = collect($types)->toJson();
                @endphp
                <x-daugt::form.select :options="$types" wire:model.live="type"></x-daugt::form.select>
            </div>
            <div class="col-span-1">
                <x-daugt::form.label>{{__('daugt::general.template')}}</x-daugt:x-daugt::form.label>
                @php
                    $options = \Daugt\Misc\ThemeRegistry::getThemeTemplatesByUsage($type);
                    $templates = [];
                    $options = collect($options)->each(function($option, $key) use(&$templates) {
                        $templates[] = [
                            'value' => $key,
                            'title' => $option->name
                        ];
                    });

                    $templates = collect($templates)->toJson();
                @endphp
                <x-daugt::form.select :options="$templates" wire:model.live="template"></x-daugt::form.select>
            </div>


            <div class="col-span-1 md:col-span-3 flex flex-col gap-y-3 pt-3">
                @php
                    $contentAttributes = \Daugt\Misc\ContentTypeRegistry::getContentType($type)->attributes;
                    $templateAttributes = \Daugt\Misc\ThemeRegistry::getThemeTemplate($template)->attributes;
                @endphp
                <x-daugt::tabs.tabs class="w-full bg-neutral-50 p-2 rounded-md border-2 border-neutral-100">
                    <x-daugt::tabs.item wire:click="setTab('content')" :active="$currentTab == 'content'">{{__('daugt::general.content')}}</x-daugt::tabs.item>
                    <x-daugt::tabs.item :count="$contentAttributes->count()" wire:click="setTab('content_config')" :active="$currentTab == 'content_config'">{{__('daugt::general.content_config')}}</x-daugt::tabs.item>
                    <x-daugt::tabs.item :count="$templateAttributes->count()" wire:click="setTab('template_config')" :active="$currentTab == 'template_config'">{{__('daugt::general.template_config')}}</x-daugt::tabs.item>
                </x-daugt::tabs.tabs>
                @if($currentTab == 'content')
                    <livewire:daugt::content.content-editor :group="\Daugt\Misc\ContentTypeRegistry::getContentType($this->content->type)->group" wire:model="blocks"></livewire:daugt::content.content-editor>
                    {{--<x-daugt::form.rich-text></x-daugt::form.rich-text>--}}
                @elseif($currentTab == 'content_config')
                    <div class="max-w-xl mx-auto w-full flex flex-col gap-y-3">
                        @foreach($contentAttributes as $key => $attribute)
                        <div class="w-full">
                            <x-daugt::blocks.attribute-input :key="$key" :attribute="$attribute" wire:model="contentAttributes.{{$key}}" wire:key="attributes.{{$attribute->name}}"></x-daugt::blocks.attribute-input>
                        </div>
                        @endforeach
                    </div>
                @elseif($currentTab == 'template_config')
                    <div class="max-w-xl mx-auto w-full flex flex-col gap-y-3">
                        <x-daugt::alert :title="__('daugt::blocks.overwrite_template_defaults.title')" :message="__('daugt::blocks.overwrite_template_defaults.description')">
                            <x-slot name="actions">
                                <x-daugt::form.button wire:click="$dispatch('openModal', { component: 'daugt::blocks.edit-block-defaults', arguments: { blockId: '{{$template}}' } })" style="warning">{{__('daugt::blocks.overwrite_template_defaults.action')}}</x-daugt::form.button>
                            </x-slot>
                        </x-daugt::alert>
                        @foreach($templateAttributes as $key => $attribute)
                            <div class="w-full">
                                <x-daugt::blocks.attribute-input :key="$key" :attribute="$attribute" wire:model="contentAttributes.{{$key}}" wire:key="attributes.{{$attribute->name}}"></x-daugt::blocks.attribute-input>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>