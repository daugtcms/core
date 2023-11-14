@php
    $path = 'icons/default';
    $icons = collect(Storage::disk('public')->files($path))->map(function ($item) {
        return str_replace('.svg', '', str_replace('/icons/default/', '', $item));
    })->toArray();
@endphp
<div class="component" x-data='{
        selectedIcon: "",
        icons: @json($icons),
        filteredIcons: [],
        filterItems() {
            this.filteredIcons = this.icons.filter((icon) => {
                return icon.toLowerCase().includes(this.$refs.input.value.toLowerCase());
            });
        }
     }'
     x-init="filteredIcons = icons">
    <button
            @click="$refs.panel.toggle"
            x-modelable="selectedIcon"
            {{$attributes->merge(['class' => 'rounded-md shadow-sm border border-neutral-300 focus:border-primary-300 focus:outline-none focus:ring focus:ring-primary-200 focus:ring-opacity-50 w-full bg-white'])}}>
        <template x-if="selectedIcon">
            <div class="flex justify-between items-center min-w-0">
                <div class="flex items-center gap-x-3 min-w-0 py-1.5 px-2">
                    <img :src="'/' + selectedIcon + '.svg'" loading="lazy" class="h-6 w-6">
                    <p x-text="selectedIcon"
                       class="leading-tight truncate"></p>
                </div>
                <x-sitebrew::form.icon-button icon="x" class="mr-0.5"
                                               @click="selectedIcon = ''; $event.stopImmediatePropagation()">
                </x-sitebrew::form.icon-button>
            </div>
        </template>
        <template x-if="!selectedIcon">
            <p class="text-neutral-500 italic truncate py-1.5">{{__('sitebrew::general.no_icon_selected')}}</p>
        </template>
    </button>
    <div x-ref="panel" class="absolute bg-white border-neutral-200 border shadow-md rounded-md h-128 w-full"
         x-float.placement.bottom-start.flip.offset.size.trap.hide="{
            size: {
                apply(obj) {
                    // Do things with the data, e.g.
                    Object.assign($refs.panel.style, {
                        maxWidth: `${obj.reference.width}px`,
                    });
                },
            }
         }"
    >
        <div class="p-2">
            <x-sitebrew::form.input @input="filterItems()" x-ref="input"
                                     placeholder="{{__('sitebrew::general.search_items')}}"></x-sitebrew::form.input>
        </div>
        <div class="flex flex-col h-64 overflow-y-auto divide-y-2 divide-neutral-100 text-neutral-800">
            <template x-for="icon in filteredIcons">
                <div class="flex items-center gap-x-3 hover:bg-neutral-50 py-1 px-2"
                     @click="selectedIcon = icon; $refs.input.value = ''; filterItems()">
                    <img :src="'/' + icon + '.svg'" loading="lazy" class="h-6 w-6">
                    <p x-text="icon" class="leading-tight"></p>
                </div>
            </template>
        </div>

    </div>
</div>