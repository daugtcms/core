<div class="bg-white flex h-full w-full overflow-hidden relative" x-data="blockEditor"
     x-on:resize.window="sidebarOpen = true">
    <div class="bg-neutral-50 flex-grow flex flex-col">
        <div class="bg-white w-full h-12 flex items-center justify-between px-4 flex-shrink-0">
            <h1 class="text-lg font-medium">{{$title}}</h1>
            <div class="flex gap-x-2">
                <x-site-core::core.button style="secondary" class="md:hidden"
                                          @click="$wire.currentlyEditingBlock ? $wire.unsetActiveBlock() : true; sidebarOpen = true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="h-5 w-5 lucide lucide-plus">
                        <path d="M5 12h14"/>
                        <path d="M12 5v14"/>
                    </svg>
                </x-site-core::core.button>
                <x-site-core::core.button style="primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="h-5 w-5 md:hidden lucide lucide-save">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    <span class="hidden md:block">{{__('site-core::general.save')}}</span>
                </x-site-core::core.button>
            </div>
        </div>
        <div class="border-b-2 border-neutral-100"></div>
        <div class="overflow-y-auto flex-grow">
            <x-site-core::templates.homepage>
                @foreach($this->getBlocks() as $block)
                    @php
                        $attributes = new Illuminate\View\ComponentAttributeBag($block->getAttributeValues());
                    @endphp
                    <div class="block_{{$block->uuid}} group relative isolate" wire:key={{ $block->uuid }} >
                        <x-dynamic-component
                                :component="$block->getMetadata()['viewName']" {{$attributes}}></x-dynamic-component>
                        <div class="absolute inset-0 bg-black/10 transition-opacity cursor-pointer @if(empty($activeBlock) || $activeBlock->uuid !== $block->uuid) opacity-0 group-hover:opacity-100 @endif"
                             wire:click="setActiveBlock('{{$block->uuid}}')" @click="sidebarOpen = true">
                            <div class="absolute top-2 right-2 transition-opacity">
                                <button class="rounded-full bg-white border-2 border-neutral-200 flex items-center justify-center p-1.5 h-9 w-9 hover:bg-neutral-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="lucide lucide-sliders-horizontal">
                                        <line x1="21" x2="14" y1="4" y2="4"/>
                                        <line x1="10" x2="3" y1="4" y2="4"/>
                                        <line x1="21" x2="12" y1="12" y2="12"/>
                                        <line x1="8" x2="3" y1="12" y2="12"/>
                                        <line x1="21" x2="16" y1="20" y2="20"/>
                                        <line x1="12" x2="3" y1="20" y2="20"/>
                                        <line x1="14" x2="14" y1="2" y2="6"/>
                                        <line x1="8" x2="8" y1="10" y2="14"/>
                                        <line x1="16" x2="16" y1="18" y2="22"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </x-site-core::templates.homepage>
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
        @if(!$currentlyEditingBlock)
            <div class="bg-white flex box-content flex-col">
                <h1 class="w-full px-4 text-lg font-medium h-12 flex items-center">{{__('site-core::blocks.available_blocks')}}</h1>
                <div class="border-b-2 border-neutral-100"></div>
            </div>
            <section id="available-blocks" class="p-2">
                @foreach($availableBlocks as $blockName)
                    @php
                        $block = new $blockName;
                    @endphp
                    <div class="bg-white rounded-md shadow-sm p-4 cursor-grab select-none relative overflow-hidden group border border-neutral-100"
                         wire:click="addBlock('{{addslashes($blockName)}}')">
                        <h2 class="text-lg font-medium">{{$block::getMetadata()['name']}}</h2>
                        <p class="text-sm text-neutral-500">{{$block::getMetadata()['description']}}</p>
                        <div class="absolute w-full h-full bg-black/30 inset-0 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <p class="text-white font-semibold inline-flex items-center gap-x-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                     stroke-linejoin="round" class="lucide lucide-plus">
                                    <path d="M5 12h14"/>
                                    <path d="M12 5v14"/>
                                </svg>
                                {{__('site-core::general.add')}}
                            </p>
                        </div>
                    </div>
                @endforeach
            </section>
        @else
            <div class="bg-white flex box-content flex-col">
                <button class="w-full px-2 text-lg font-medium h-12 flex items-center flex item-center hover:bg-neutral-200 cursor-pointer"
                        wire:click="unsetActiveBlock()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="opacity-50 mr-1 lucide lucide-chevron-left">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                    {{__('site-core::general.back')}}
                </button>
                <div class="border-b-2 border-neutral-100"></div>
            </div>
            <section id="active-block" class="flex flex-col gap-y-2 divide-y divide-neutral-200 flex-grow min-h-0">
                @php
                    $attributes = $activeBlock->getMetadata()['attributes'];
                @endphp

                @foreach($attributes as $key => $attribute)
                    <x-site-core::blocks.attribute-input :key="$key"
                                                         :attribute="$attribute"></x-site-core::blocks.attribute-input>
                @endforeach
            </section>
            <div class="bg-white w-full flex justify-between p-2.5 border-t-2 border-neutral-100">
                <x-site-core::core.button style="danger" wire:click="removeBlock('{{$activeBlock->uuid}}')"
                                          onclick="confirm('{{__('site-core::blocks.delete_block_confirmation')}}') || event.stopImmediatePropagation()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-trash-2 w-5 h-5 mr-1">
                        <path d="M3 6h18"/>
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                        <line x1="10" x2="10" y1="11" y2="17"/>
                        <line x1="14" x2="14" y1="11" y2="17"/>
                    </svg>
                    {{__('site-core::general.delete')}}</x-site-core::core.button>
            </div>
        @endif
    </div>
</div>