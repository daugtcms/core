<div class="py-1 w-full mx-auto flex items-start gap-x-3" id="comments">
    <x-daugt::avatar :user="auth()->user()" class="w-13 h-13 mt-1.5 ml-1.5 flex-shrink-0"></x-daugt::avatar>
    <form method="POST" action="{{route('daugt.member-area.course.comments.create', ['course' => $course, 'section' => $section])}}" class="flex-1">
        @csrf
        <div x-data="setupEditor()"
             x-init="() => init($refs.editor)"
             wire:ignore
                {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow overflow-hidden border-2 border-neutral-100']) }}>

            <template x-if="isLoaded()">
                <div class="flex justify-between p-1 border-b-2 border-neutral-100 bg-neutral-50">
                    <div class="menu">
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
                    </div>
                    <x-daugt::form.icon-button icon="lucide:send"
                                               type="submit"
                                               style="primary"></x-daugt::form.icon-button>
                </div>
            </template>

            <div x-ref="editor" class="prose max-w-full mx-auto px-4 w-full font-main"></div>

            <input type="hidden" name="text" x-bind:value="JSON.stringify(content)">
        </div>
    </form>
</div>