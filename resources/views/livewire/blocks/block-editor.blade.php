<div class="bg-white flex h-full w-full overflow-hidden relative" x-data="blockeditor({sidebarOpen: true})"
     x-on:resize.window="sidebarOpen = true">
    <div class="bg-neutral-50 flex-grow flex flex-col">
        <div class="bg-white w-full h-12 flex items-center justify-between pl-2 pr-4 flex-shrink-0">
            <div class="flex items-center gap-x-1.5">
                <x-daugt::form.icon-button icon="x"
                                              wire:click="$dispatch('closeModal')"></x-daugt::form.icon-button>
                <h1 class="text-lg font-medium">{{$title}}</h1>
            </div>
            <div class="flex gap-x-2">
                <x-daugt::form.icon-button icon="plus"
                                              @click="sidebarOpen = true"
                                              wire:click="setSidebarState('{{\Daugt\Enums\Blocks\BlockEditorSidebar::AVAILABLE_BLOCKS}}')"
                ></x-daugt::form.icon-button>
                <x-daugt::form.icon-button icon="save" style="primary"
                                              wire:click="save()"
                ></x-daugt::form.icon-button>
            </div>
        </div>
        <div class="border-b-2 border-neutral-100"></div>
        <div class="overflow-y-auto flex-grow isolate relative bg-white">
            <iframe class="w-full h-full" id="frame" ref="iframe" x-data
                    srcdoc="{{ $viewContent }}"></iframe>
        </div>
    </div>
    <div class="absolute inset-0 bg-black/20 md:hidden" x-show="sidebarOpen" x-transition.opacity
         @click="sidebarOpen = false"></div>
    <div class="bg-neutral-50 transition-all w-80 max-w-[85%] h-full flex-shrink-0 border-l-2 border-neutral-100 flex-col flex absolute right-0 md:static"
         x-show="sidebarOpen"
         x-transition:enter-start="transform translate-x-full"
         x-transition:enter-end="transform translate-x-0"
         x-transition:leave-start="transform translate-x-0"
         x-transition:leave-end="transform translate-x-full"
    >
        @switch($sidebarState)
            @case(\Daugt\Enums\Blocks\BlockEditorSidebar::AVAILABLE_BLOCKS)
                <div class="bg-white flex box-content flex-col">
                    <div class="w-full px-2 gap-x-1.5 flex text-lg font-medium h-12 flex items-center flex item-center">
                        <x-daugt::form.icon-button icon="chevron-left"
                                                      wire:click="setSidebarState('{{\Daugt\Enums\Blocks\BlockEditorSidebar::TEMPLATE}}')"></x-daugt::form.icon-button>
                        <p>{{__('daugt::blocks.available_blocks')}}</p>
                    </div>
                </div>

                <section id="available-blocks" class="p-2 gap-y-2 flex-grow overflow-y-auto flex flex-col">
                    @foreach($availableBlocks as $key => $block)
                        <div class="bg-white flex-shrink-0 rounded-md shadow-sm p-4 cursor-grab select-none relative overflow-hidden group border border-neutral-100"
                             wire:click="addBlock('{{addslashes($key)}}')"
                             drag-item>
                            <h2 class="text-lg font-medium leading-snug">{{$block['name']}}</h2>
                            <p class="text-sm text-neutral-500 break-words">{{$block['description']}}</p>
                            <div class="absolute w-full h-full bg-black/30 inset-0 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <p class="text-white font-semibold inline-flex items-center gap-x-1">
                                    @svg('plus')
                                    {{__('daugt::general.add')}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </section>
                <script>
                    document.querySelectorAll('[drag-item]').forEach(el => {
                        el.addEventListener("dragstart", e => {
                            e.target.setAttribute('inserting', true)
                        })

                        el.addEventListener('dragend', e => {
                            e.target.removeAttribute('inserting')
                        })

                        el.addEventListener('dragover', e => e.preventDefault())
                    })
                </script>
                @break
            @case(\Daugt\Enums\Blocks\BlockEditorSidebar::BLOCK)
                <div class="bg-white flex box-content flex-col">
                    <div class="w-full px-2 gap-x-1.5 flex text-lg font-medium h-12 flex items-center flex item-center">
                        <x-daugt::form.icon-button icon="chevron-left"
                                                      wire:click="unsetActiveBlock()"></x-daugt::form.icon-button>
                        <p>{{__('daugt::blocks.editing_block')}}</p>
                    </div>
                </div>
                <section id="active-block"
                         class="flex flex-col overflow-y-auto gap-y-2 divide-y divide-neutral-200 flex-grow min-h-0">
                    @foreach(\Daugt\Misc\ThemeRegistry::getThemeBlock($activeBlock->name)->attributes as $key => $attribute)
                        <div class="px-2 py-1">
                            <x-daugt::blocks.attribute-input :key="$key"
                                                                wire:key="{{$activeBlock->uuid . $key}}"
                                                                :attribute="$attribute"
                                                                wire:model.live.debounce.250ms="activeBlock.attributes.{{$key}}"></x-daugt::blocks.attribute-input>
                        </div>
                    @endforeach
                </section>
                <div class="bg-white w-full flex justify-between p-2.5 border-t-2 border-neutral-100">
                    <x-daugt::form.button style="danger" wire:click="removeBlock('{{$activeBlock->uuid}}')"
                                             onclick="confirm('{{__('daugt::blocks.delete_block_confirmation')}}') || event.stopImmediatePropagation()">
                        @svg('trash-2', 'w-5 h-5 mr-1')
                        {{__('daugt::general.delete')}}</x-daugt::form.button>
                </div>
                @break
            @case(\Daugt\Enums\Blocks\BlockEditorSidebar::TEMPLATE)
                <div class="bg-white flex box-content flex-col">
                    <div class="w-full px-3 gap-x-1.5 flex text-lg font-medium h-12 flex items-center flex item-center">
                        <p>{{__('daugt::blocks.manage_template')}}</p>
                    </div>
                </div>
                <section id="active-block"
                         class="flex flex-col gap-y-2 divide-y divide-neutral-200 flex-grow min-h-0 overflow-y-auto">
                    @php
                        $templateAttributes = \Daugt\Misc\ThemeRegistry::getThemeTemplate($this->templateBlock->name)->attributes;
                        $contentAttributes = \Daugt\Misc\ContentTypeRegistry::getContentType($usage)->attributes;
                        $attributes = $templateAttributes->merge($contentAttributes);
                    @endphp

                    @foreach($attributes as $key => $attribute)
                        <div class="px-2 py-1">
                            <x-daugt::blocks.attribute-input :key="$key"
                                                                wire:key="{{$template->id . $key}}"
                                                                :attribute="$attribute"
                                                                wire:model.live="templateBlock.attributes.{{$key}}"></x-daugt::blocks.attribute-input>
                        </div>
                    @endforeach
                </section>
                @break
        @endswitch
    </div>
</div>