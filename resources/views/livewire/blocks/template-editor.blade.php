<div>
    <x-sitebrew::layouts.dashboard-bar>
        <h1 class="text-lg font-medium text-neutral-800">{{__('sitebrew::blocks.template_editor')}}</h1>

        <x-sitebrew::form.button
                wire:click="$dispatch('openModal', { component: 'sitebrew::blocks.edit-template' })"
                class="flex-shrink-0 ml-2">
            {{__('sitebrew::general.add')}}
            @svg('plus', 'w-5 h-5')
        </x-sitebrew::form.button>
    </x-sitebrew::layouts.dashboard-bar>
    <div class="max-w-3xl mx-auto p-3">
        <ul role="list" class="divide-y divide-gray-100">
            @foreach($templates as $template)
                <li class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-x-6 py-5">
                    <div class="min-w-0">
                        <div class="flex items-start gap-x-3">
                            <p class="font-semibold leading-6 text-gray-900 truncate">{{$template->name}}</p>
                        </div>
                        <div class="flex items-center gap-x-2 text-sm leading-5 text-gray-500">
                            <p class="truncate">{{__('sitebrew::general.id')}}: {{$template->id}}</p>
                        </div>
                    </div>
                    <div class="flex flex-none items-center gap-x-2 w-full sm:w-auto mt-1">
                        <x-sitebrew::form.button style="light" class="flex-grow"
                                                  wire:click="$dispatch('openModal', { component: 'sitebrew::blocks.edit-template', arguments: { template: {{$template->id}} } })">
                            {{__('sitebrew::general.edit')}}
                            @svg('pencil', 'w-4 h-4')
                        </x-sitebrew::form.button>
                        <x-sitebrew::form.button style="danger" class="flex-grow"
                                                  wire:click="deleteTemplate({{$template->id}})"
                                                  onclick="confirm('{{__('sitebrew::blocks.delete_template_confirmation')}}') || event.stopImmediatePropagation()">
                            {{__('sitebrew::general.delete')}}
                            @svg('trash-2', 'w-4 h-4')
                        </x-sitebrew::form.button>
                    </div>
                </li>
            @endforeach
        </ul>

    </div>
</div>