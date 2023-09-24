<div class="bg-white flex h-full w-full">
    <div class="bg-neutral-50 flex-grow flex flex-col">
        <div class="bg-white w-full h-12 flex items-center justify-between px-4 flex-shrink-0">
            <h1 class="text-lg font-medium">{{$title}}</h1>
            <x-site-core::form.button style="primary">{{__('site-core::general.save')}}</x-site-core::form.button>
        </div>
        <div class="border-b-2 border-neutral-100"></div>
        <div class="aspect-w-16 aspect-h-9 overflow-y-auto flex-grow">
            @foreach($this->getBlocks() as $block)
                @php
                    $attributes = new Illuminate\View\ComponentAttributeBag($block->getAttributeValues());
                @endphp
                <div class="block_{{$block->uuid}} group relative" wire:key={{ $block->uuid }} >
                    <x-dynamic-component :component="$block->getMetadata()['viewName']" {{$attributes}}></x-dynamic-component>
                    <div class="absolute inset-0 bg-black/10 transition-opacity cursor-pointer @if(empty($activeBlock) || $activeBlock->uuid !== $block->uuid) opacity-0 group-hover:opacity-100 @endif" wire:click="setActiveBlock('{{$block->uuid}}')">
                        <div class="absolute top-2 right-2 transition-opacity">
                            <button class="rounded-full bg-white border-2 border-neutral-200 flex items-center justify-center p-1.5 h-9 w-9 hover:bg-neutral-50">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sliders-horizontal"><line x1="21" x2="14" y1="4" y2="4"/><line x1="10" x2="3" y1="4" y2="4"/><line x1="21" x2="12" y1="12" y2="12"/><line x1="8" x2="3" y1="12" y2="12"/><line x1="21" x2="16" y1="20" y2="20"/><line x1="12" x2="3" y1="20" y2="20"/><line x1="14" x2="14" y1="2" y2="6"/><line x1="8" x2="8" y1="10" y2="14"/><line x1="16" x2="16" y1="18" y2="22"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="bg-neutral-50 w-80 flex-shrink-0 border-l-2 border-neutral-100 flex flex-col">
        @if(empty($activeBlock))
            <div class="bg-white flex box-content flex-col">
                <h1 class="w-full px-4 text-lg font-medium h-12 flex items-center">{{__('site-core::blocks.available_blocks')}}</h1>
                <div class="border-b-2 border-neutral-100"></div>
            </div>
            <section id="available-blocks" class="p-2">
                @foreach($availableBlocks as $blockName)
                    @php
                        $block = new $blockName;
                    @endphp
                    <div class="bg-white rounded-md shadow-sm p-4 cursor-grab select-none relative overflow-hidden group border border-neutral-100" wire:click="addBlock('{{addslashes($blockName)}}')">
                        <h2 class="text-lg font-medium">{{$block::getMetadata()['name']}}</h2>
                        <p class="text-sm text-neutral-500">{{$block::getMetadata()['description']}}</p>
                        <div class="absolute w-full h-full bg-black/30 inset-0 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <p class="text-white font-semibold inline-flex items-center gap-x-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                {{__('site-core::general.add')}}
                            </p>
                        </div>
                    </div>
                @endforeach
            </section>
        @else
            <div class="bg-white flex box-content flex-col">
                <button class="w-full px-2 text-lg font-medium h-12 flex items-center flex item-center hover:bg-neutral-200 cursor-pointer" wire:click="unsetActiveBlock()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-50 mr-1 lucide lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                    {{__('site-core::general.back')}}
                </button>
                <div class="border-b-2 border-neutral-100"></div>
            </div>
            <section id="active-block" class="flex flex-col gap-y-2 divide-y divide-neutral-200 flex-grow min-h-0">
                @php
                    $attributes = $activeBlock->getMetadata()['attributes'];
                @endphp


                @foreach($attributes as $key => $attribute)
                    <div class="w-full px-3 py-2">
                        <h2 class="text-lg font-medium">{{$attribute['title']}}</h2>
                        @isset($attribute['description'])<h3 class="text-sm text-neutral-500">{{$attribute['description']}}</h3>@endisset
                        <x-site-core::form.input class="w-full mt-1" type="text" placeholder="{{Str::ucfirst($attribute['type'])}}" wire:model.blur="activeBlock.{{$key}}"></x-site-core::form.input>
                    </div>
                @endforeach
            </section>
            <div class="bg-white w-full flex justify-between p-2.5 border-t-2 border-neutral-100">
                <x-site-core::form.button style="danger" wire:click="removeBlock('{{$activeBlock->uuid}}')" onclick="confirm('{{__('site-core::blocks.delete_block_confirmation')}}') || event.stopImmediatePropagation()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-5 h-5 mr-1"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    {{__('site-core::general.delete')}}</x-site-core::form.button>
            </div>
        @endif
    </div>
</div>