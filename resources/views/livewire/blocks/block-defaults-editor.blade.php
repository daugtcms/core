<div>
    <x-daugt::layouts.dashboard-bar>
        <h1 class="text-lg font-medium text-neutral-800">{{__('daugt::blocks.block_defaults')}}</h1>
    </x-daugt::layouts.dashboard-bar>
    <div class="max-w-3xl mx-auto p-3">
        <h1 class="text-lg font-medium text-neutral-800 border-b-2 border-neutral-100 pb-1">{{__('daugt::general.templates')}}</h1>
        <ul role="list" class="divide-y divide-gray-100">
            @foreach($templates as $key => $template)
                <li class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-x-6 py-5">
                    <div class="min-w-0">
                        <div class="flex items-start gap-x-3">
                            <p class="font-semibold leading-6 text-gray-800 truncate">{{$template['name']}}</p>
                        </div>
                        <div class="flex items-center gap-x-2 text-sm leading-5 text-gray-500">
                            <p class="truncate">{{__('daugt::blocks.attributes')}}: {{count($template['attributes'])}}</p>
                        </div>
                    </div>
                    <div class="flex flex-none items-center gap-x-2 w-full sm:w-auto mt-1">
                        <x-daugt::form.button style="light" class="flex-grow"
                                                  wire:click="$dispatch('openModal', { component: 'daugt::blocks.edit-block-defaults', arguments: { blockId: '{{$key}}' } })">
                            {{__('daugt::general.edit')}}
                            @svg('pencil', 'w-4 h-4')
                        </x-daugt::form.button>
                    </div>
                </li>
            @endforeach
        </ul>

    </div>
</div>