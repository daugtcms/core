<div class="bg-white flex h-full w-full overflow-hidden relative" x-data="blockeditor({sidebarOpen: true})"
     x-on:resize.window="sidebarOpen = true">
    <div class="bg-neutral-50 flex-grow flex flex-col">
        <div class="bg-white w-full h-12 flex items-center justify-between pl-2 pr-4 flex-shrink-0">
            <div class="flex items-center gap-x-1.5">
                <x-site-core::core.icon-button icon="chevron-left"
                                               wire:click="$dispatch('save-blocks')"></x-site-core::core.icon-button>
                <h1 class="text-lg font-medium">{{$title}}</h1>
            </div>
            <div class="flex gap-x-2">
                <x-site-core::core.icon-button icon="plus"
                                               @click="sidebarOpen = true"
                                               wire:click="setSidebarState('{{\Felixbeer\SiteCore\Blocks\BlockEditorSidebar::AVAILABLE_BLOCKS}}')"
                ></x-site-core::core.icon-button>
                <x-site-core::core.icon-button icon="save" style="primary"
                                               wire:click="save()"
                                               x-tooltip.bottom="{{__('site-core::general.save')}}"
                ></x-site-core::core.icon-button>
            </div>
        </div>
        <div class="border-b-2 border-neutral-100"></div>
        <div class="overflow-y-auto flex-grow isolate relative">
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
            @case(\Felixbeer\SiteCore\Blocks\BlockEditorSidebar::AVAILABLE_BLOCKS)
                <div class="bg-white flex box-content flex-col">
                    <div class="w-full px-2 gap-x-1.5 flex text-lg font-medium h-12 flex items-center flex item-center">
                        <x-site-core::core.icon-button icon="chevron-left"
                                                       wire:click="setSidebarState('{{\Felixbeer\SiteCore\Blocks\BlockEditorSidebar::TEMPLATE}}')"></x-site-core::core.icon-button>
                        <p>{{__('site-core::blocks.available_blocks')}}</p>
                    </div>
                </div>

                <section id="available-blocks" class="p-2 gap-y-2 flex flex-col">
                    @foreach($availableBlocks as $blockName)
                        @php
                            $block = new $blockName;
                        @endphp
                        <div class="bg-white rounded-md shadow-sm p-4 cursor-grab select-none relative overflow-hidden group border border-neutral-100"
                             wire:click="addBlock('{{addslashes($blockName)}}')"
                             drag-item>
                            <h2 class="text-lg font-medium leading-snug">{{$block::getMetadata()['name']}}</h2>
                            <p class="text-sm text-neutral-500">{{$block::getMetadata()['description']}}</p>
                            <div class="absolute w-full h-full bg-black/30 inset-0 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <p class="text-white font-semibold inline-flex items-center gap-x-1">
                                    @svg('plus')
                                    {{__('site-core::general.add')}}
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
            @case(\Felixbeer\SiteCore\Blocks\BlockEditorSidebar::BLOCK)
                <div class="bg-white flex box-content flex-col">
                    <div class="w-full px-2 gap-x-1.5 flex text-lg font-medium h-12 flex items-center flex item-center">
                        <x-site-core::core.icon-button icon="chevron-left"
                                                       wire:click="unsetActiveBlock()"></x-site-core::core.icon-button>
                        <p>{{__('site-core::blocks.editing_block')}}</p>
                    </div>
                </div>
                <section id="active-block"
                         class="flex flex-col gap-y-2 divide-y divide-neutral-200 flex-grow min-h-0">
                    @php
                        $attributes = $activeBlock->getMetadata()['attributes'];
                    @endphp

                    @foreach($attributes as $key => $attribute)
                        <x-site-core::blocks.attribute-input :key="$key"
                                                             wire:key="{{$activeBlock->uuid . $key}}"
                                                             :attribute="$attribute"
                                                             wire:model.live.debounce.250ms="activeBlock.{{$key}}"></x-site-core::blocks.attribute-input>
                    @endforeach
                </section>
                <div class="bg-white w-full flex justify-between p-2.5 border-t-2 border-neutral-100">
                    <x-site-core::core.button style="danger" wire:click="removeBlock('{{$activeBlock->uuid}}')"
                                              onclick="confirm('{{__('site-core::blocks.delete_block_confirmation')}}') || event.stopImmediatePropagation()">
                        @svg('trash-2', 'w-5 h-5 mr-1')
                        {{__('site-core::general.delete')}}</x-site-core::core.button>
                </div>
                @break
            @case(\Felixbeer\SiteCore\Blocks\BlockEditorSidebar::TEMPLATE)
                <div class="bg-white flex box-content flex-col">
                    <div class="w-full px-3 gap-x-1.5 flex text-lg font-medium h-12 flex items-center flex item-center">
                        <p>{{__('site-core::blocks.manage_template')}}</p>
                    </div>
                </div>
                <section id="active-block"
                         class="flex flex-col gap-y-2 divide-y divide-neutral-200 flex-grow min-h-0">

                    @foreach($templateBlock->getMetadata()['attributes'] as $key => $attribute)
                        <x-site-core::blocks.attribute-input :key="$key"
                                                             wire:key="{{$template->id . $key}}"
                                                             :attribute="$attribute"
                                                             placeholder="{{$template->data[$key]}}"
                                                             wire:model.live="templateBlock.{{$key}}"></x-site-core::blocks.attribute-input>
                    @endforeach
                </section>
                @break
        @endswitch
    </div>
</div>