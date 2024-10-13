<div wire:ignore>
<div x-data="setupContentEditor($wire.entangle('processedContent').live)"
     x-init="() => init($refs.editor)"
     x-on:insert-block.window="insertBlock($event)"
     x-on:update-block.window="updateBlock($event)"
     x-on:delete-block.window="deleteBlock()"
     x-on:open-block-settings.window="openBlockSettings($event)"
     class="bg-white rounded-lg border-2 border-neutral-100">

    <template x-if="isLoaded()">
        <div class="menu p-1 border-b-2 border-neutral-100 bg-neutral-50 top-0 sticky z-10">
            <x-daugt::form.icon-button icon="lucide:heading-1"
                                       @click="toggleHeading({ level: 1 })"
                                       x-bind:class="{ 'text-primary-500': isActive('heading', { level: 1 }, updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="lucide:heading-2"
                                       @click="toggleHeading({ level: 2 })"
                                       x-bind:class="{ 'text-primary-500': isActive('heading', { level: 2 }, updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="lucide:heading-3"
                                       @click="toggleHeading({ level: 3 })"
                                       x-bind:class="{ 'text-primary-500': isActive('heading', { level: 3 }, updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="lucide:bold"
                                       @click="toggleBold()"
                                       x-bind:class="{ 'text-primary-500' : isActive('bold', updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="lucide:italic"
                                       @click="toggleItalic()"
                                       x-bind:class="{ 'text-primary-500' : isActive('italic', updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="lucide:strikethrough"
                                       @click="toggleStrike()"
                                       x-bind:class="{ 'text-primary-500' : isActive('strike', updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="lucide:list"
                                       @click="toggleBulletList()"
                                       x-bind:class="{ 'text-primary-500' : isActive('bulletList', updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="lucide:list-ordered"
                                       @click="toggleOrderedList()"
                                       x-bind:class="{ 'text-primary-500' : isActive('orderedList', updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="lucide:quote"
                                       @click="toggleBlockquote()"
                                       x-bind:class="{ 'text-primary-500' : isActive('blockquote', updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="lucide:link"
                                       @click="toggleLink()"
                                       x-bind:class="{ 'text-primary-500' : isActive('link', updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="lucide:align-left"
                                       @click="setTextAlign('left')"
                                       x-bind:class="{ 'text-primary-500' : isActive({ textAlign: 'left' }, updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="lucide:align-center"
                                       @click="setTextAlign('center')"
                                       x-bind:class="{ 'text-primary-500' : isActive({ textAlign: 'center' }, updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="lucide:align-right"
                                       @click="setTextAlign('right')"
                                       x-bind:class="{ 'text-primary-500' : isActive({ textAlign: 'right' }, updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="lucide:align-justify"
                                       @click="setTextAlign('justify')"
                                       x-bind:class="{ 'text-primary-500' : isActive({ textAlign: 'justify' }, updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="lucide:rows"
                                       @click="setHorizontalRule()"
            ></x-daugt::form.icon-button>
            <x-daugt::form.dropdown-button :icon-button="true"
                                           :icon="'lucide:type'"
                                           :style="'secondary'"
                                            class="inline-flex">
                <x-daugt::form.dropdown-button-item @click="setFontFamily('sans')">
                    <span class="font-sans">Sans</span>
                </x-daugt::form.dropdown-button-item>
                <x-daugt::form.dropdown-button-item @click="setFontFamily('serif')">
                    <span class="font-serif">Serif</span>
                </x-daugt::form.dropdown-button-item>
                <x-daugt::form.dropdown-button-item @click="setFontFamily('mono')">
                    <span class="font-mono">Mono</span>
                </x-daugt::form.dropdown-button-item>
            </x-daugt::form.dropdown-button>
            <x-daugt::form.dropdown-button :icon-button="true"
                                           :icon="'lucide:palette'"
                                           :style="'secondary'"
                                           class="inline-flex"
                                            :grid="true"
                                            :grid-cols="11">
                @php
                    $colors = ['primary', 'neutral', 'success', 'danger', 'warning'];
                    $variants = [50,100,200,300,400,500,600,700,800,900,950];
                @endphp

                @foreach($colors as $color)
                    @foreach($variants as $variant)
                    <x-daugt::form.dropdown-button-item @click="setColor('{{$color}}-{{$variant}}')">
                        <div class="w-4 h-4 rounded bg-{{$color}}-{{$variant}}"></div>
                    </x-daugt::form.dropdown-button-item>
                    @endforeach
                @endforeach
            </x-daugt::form.dropdown-button>
        </div>
    </template>
    <div x-ref="editor" class="prose max-w-full mx-auto w-full font-sans"></div>
</div>
<x-daugt::content-editor.floating-menu-blocks :blocks="$availableBlocks">
</x-daugt::content-editor.floating-menu-blocks>

</div>