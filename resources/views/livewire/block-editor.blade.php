<div class="bg-white flex h-full w-full">
    <div class="bg-neutral-50 flex-grow flex flex-col">
        <div class="bg-white w-full h-12 flex items-center justify-between px-4 flex-shrink-0">
            <h1 class="text-lg font-medium">{{$title}}</h1>
            <x-site-core::form.button style="primary">Save</x-site-core::form.button>
        </div>
        <div class="border-b-2 border-neutral-100"></div>
        <div class="aspect-w-16 aspect-h-9 overflow-y-auto flex-grow">
            @foreach($this->getBlocks() as $block)
                <div class="block-{{$block->getMetadata()['name']}}">
                    <x-dynamic-component :component="$block->getMetadata()['viewName']"></x-dynamic-component>
                </div>
            @endforeach
        </div>
    </div>
    <div class="bg-neutral-50 w-80 flex-shrink-0 border-l-2 border-neutral-100">
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
    </div>
</div>