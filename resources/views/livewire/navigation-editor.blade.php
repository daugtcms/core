<div>
    <div class="w-full bg-neutral-50 flex justify-between p-2 border-b-2 border-neutral-200">
        <div class="inline-flex gap-x-2 overflow-x-auto">
            @foreach($navigations as $navigation)
                <div class="text-neutral-700 inline-flex items-center font-medium hover:bg-neutral-200 rounded-md px-2 py-1 whitespace-nowrap">
                    {{$navigation->name}}
                </div>
            @endforeach
        </div>
        <x-site-core::core.button
                wire:click="$dispatch('openModal', { component: 'site-core::navigation.create-navigation' })"
                class="flex-shrink-0 ml-2">
            Add
            @svg('plus', 'w-5 h-5')
        </x-site-core::core.button>
    </div>
    <div class="text-neutral-700 inline-flex flex-col overflow-y-auto p-2">
        <div class="bg-neutral-50 rounded-md border border-neutral-200 p-2 w-72">
            <div class="flex justify-between">
                <div class="inline-flex items-center gap-x-1 text-lg font-medium">
                    <button class="w-7 h-8 rounded-md hover:bg-neutral-200 flex items-center justify-center text-neutral-500 p-0.5">
                        @svg('grip-vertical')
                    </button>
                    Home
                </div>
                <div>
                    <x-site-core::core.button>
                        @svg('pencil', 'w-5 h-5')
                    </x-site-core::core.button>
                    <x-site-core::core.button style="danger">
                        @svg('trash-2', 'w-5 h-5')
                    </x-site-core::core.button>
                </div>
            </div>
        </div>

        <x-site-core::modal.header>Test</x-site-core::modal.header>
    </div>
</div>