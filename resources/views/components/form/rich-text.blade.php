<div x-data="setupEditor($wire.entangle('{{ $attributes->wire('model')->value() }}').live)"
     x-init="() => init($refs.editor)"
     wire:ignore
     {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class' => 'bg-white rounded-lg border-2 border-neutral-100']) }}>

    <template x-if="isLoaded()">
        <div class="menu p-1 border-b-2 border-neutral-100 bg-neutral-50">
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
            <x-daugt::form.icon-button icon="lucide:rows"
                                          @click="setHorizontalRule()"
                                          ></x-daugt::form.icon-button>
        </div>
    </template>

    <div x-ref="editor" class="prose px-2 py-1"></div>
</div>
