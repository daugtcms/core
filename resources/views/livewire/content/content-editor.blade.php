<div wire:ignore>
<div x-data="setupContentEditor($wire.entangle('processedContent').live)"
     x-init="() => init($refs.editor)"
     x-on:insert-block.window="insertBlock($event)"
     x-on:update-block.window="updateBlock($event)"
     x-on:delete-block.window="deleteBlock()"
     x-on:open-block-settings.window="openBlockSettings($event)"
     class="bg-white rounded-lg border-2 border-neutral-100">

    <template x-if="isLoaded()">
        <div class="menu p-1 border-b-2 border-neutral-100 bg-neutral-50">
            <x-daugt::form.icon-button icon="heading-1"
                                       @click="toggleHeading({ level: 1 })"
                                       x-bind:class="{ 'text-primary-500': isActive('heading', { level: 1 }, updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="heading-2"
                                       @click="toggleHeading({ level: 2 })"
                                       x-bind:class="{ 'text-primary-500': isActive('heading', { level: 2 }, updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="heading-3"
                                       @click="toggleHeading({ level: 3 })"
                                       x-bind:class="{ 'text-primary-500': isActive('heading', { level: 3 }, updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="bold"
                                       @click="toggleBold()"
                                       x-bind:class="{ 'text-primary-500' : isActive('bold', updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="italic"
                                       @click="toggleItalic()"
                                       x-bind:class="{ 'text-primary-500' : isActive('italic', updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="strikethrough"
                                       @click="toggleStrike()"
                                       x-bind:class="{ 'text-primary-500' : isActive('strike', updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="list"
                                       @click="toggleBulletList()"
                                       x-bind:class="{ 'text-primary-500' : isActive('bulletList', updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="list-ordered"
                                       @click="toggleOrderedList()"
                                       x-bind:class="{ 'text-primary-500' : isActive('orderedList', updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="quote"
                                       @click="toggleBlockquote()"
                                       x-bind:class="{ 'text-primary-500' : isActive('blockquote', updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="link"
                                       @click="toggleLink()"
                                       x-bind:class="{ 'text-primary-500' : isActive('link', updatedAt) }"></x-daugt::form.icon-button>
            <x-daugt::form.icon-button icon="rows"
                                       @click="setHorizontalRule()"
            ></x-daugt::form.icon-button>
        </div>
    </template>
    <div x-ref="editor" class="prose mx-auto px-2 py-1 w-full"></div>
</div>
<x-daugt::content-editor.floating-menu-blocks :blocks="$availableBlocks">
</x-daugt::content-editor.floating-menu-blocks>

</div>