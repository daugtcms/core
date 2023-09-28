<div>
    <div class="w-full bg-neutral-50 flex justify-between p-2 border-b-2 border-neutral-200">
        <div class="inline-flex gap-x-2">
            @foreach($navigations as $navigation)
                <div class="text-neutral-700 font-medium hover:bg-neutral-200 rounded-md px-2 py-1">
                    {{$navigation->name}}
                </div>
            @endforeach
        </div>
        <x-site-core::form.button class="gap-x-1"
                                  wire:click="$dispatch('openModal', { component: 'site-core::navigation.create-navigation' })">
            Add
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                 class="h-4 w-4 lucide lucide-plus">
                <path d="M5 12h14"/>
                <path d="M12 5v14"/>
            </svg>
            @svg('accessibility')
        </x-site-core::form.button>
    </div>
    <div class="text-neutral-700 inline-flex flex-col overflow-y-auto p-2">
        <div class="bg-neutral-50 rounded-md border border-neutral-200 p-2 w-72">
            <div class="flex justify-between">
                <div class="inline-flex items-center gap-x-1 text-lg font-medium">
                    <button class="w-7 h-8 rounded-md hover:bg-neutral-200 flex items-center justify-center text-neutral-500 p-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-grip-vertical">
                            <circle cx="9" cy="12" r="1"/>
                            <circle cx="9" cy="5" r="1"/>
                            <circle cx="9" cy="19" r="1"/>
                            <circle cx="15" cy="12" r="1"/>
                            <circle cx="15" cy="5" r="1"/>
                            <circle cx="15" cy="19" r="1"/>
                        </svg>
                    </button>
                    Home
                </div>
                <div>
                    <x-site-core::form.button>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-pencil w-5 h-5">
                            <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                            <path d="m15 5 4 4"/>
                        </svg>
                    </x-site-core::form.button>
                    <x-site-core::form.button style="danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-trash-2 w-5 h-5">
                            <path d="M3 6h18"/>
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            <line x1="10" x2="10" y1="11" y2="17"/>
                            <line x1="14" x2="14" y1="11" y2="17"/>
                        </svg>
                    </x-site-core::form.button>
                </div>
            </div>
        </div>
    </div>
</div>