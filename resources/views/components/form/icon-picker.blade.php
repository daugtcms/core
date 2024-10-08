<div class="component" x-data='{
        selectedIcon: "",
        icons: [],
        async fetchIcons(query) {
            try {
                let response;
                if(query === "") {
                    response = await fetch("https://api.iconify.design/collection?prefix=lucide");
                } else {
                    response = await fetch(`https://api.iconify.design/search?query=${query}&limit=64&prefix=lucide`);
                }
                let data = await response.json();
                if(query === "") {
                    this.icons = data.uncategorized.map(icon => "lucide:" + icon);
                } else {
                    this.icons = data.icons;
                }
            } catch (error) {
                console.error("Error fetching icons:", error);
            }
        }
    }'
     x-init="fetchIcons('')">

    <button
            @click="$refs.panel.toggle"
            x-modelable="selectedIcon"
            {{$attributes->merge(['class' => 'rounded-md shadow-sm border border-neutral-300 focus:border-primary-300 focus:outline-none focus:ring focus:ring-primary-200 focus:ring-opacity-50 w-full bg-white'])}}>
        <template x-if="selectedIcon">
            <div class="flex justify-between items-center min-w-0">
                <div class="flex items-center gap-x-3 min-w-0 py-1.5 px-2">
                    <div :class="'i-' + selectedIcon"></div>
                    <p x-text="selectedIcon" class="leading-tight truncate"></p>
                </div>
                <x-daugt::form.icon-button icon="lucide:x" class="mr-0.5" @click="selectedIcon = ''; $event.stopImmediatePropagation()"></x-daugt::form.icon-button>
            </div>
        </template>
        <template x-if="!selectedIcon">
            <p class="text-neutral-500 italic truncate py-1.5">No icon selected</p>
        </template>
    </button>

    <div x-ref="panel" class="absolute bg-white border-neutral-200 border shadow-md rounded-md w-full"
         x-float.placement.bottom-start.flip.offset.size.trap.hide="{
            size: {
                apply(obj) {
                    Object.assign($refs.panel.style, {
                        maxWidth: `${obj.reference.width}px`,
                    });
                },
            }
         }">
        <div class="p-2">
            <x-daugt::form.input @input.debounce="fetchIcons($event.target.value)" x-ref="input" placeholder="Search icons..."></x-daugt::form.input>
        </div>

        <div class="flex flex-col h-64 overflow-y-auto divide-y-2 divide-neutral-100 text-neutral-800">
            <template x-for="icon in icons">
                <div class="flex items-center gap-x-3 hover:bg-neutral-50 py-1 px-2"
                     @click="selectedIcon = icon; $refs.input.value = ''">
                    <div :class="'i-' + icon"></div>
                    <p x-text="icon" class="leading-tight"></p>
                </div>
            </template>
        </div>
    </div>
</div>
