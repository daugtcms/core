<div class="py-8 max-w-3xl mx-auto" id="comments">
    <h2 class="text-xl text-neutral-800 mb-2">{{trans_choice(__('daugt::content.comments', ['count' => $comments->count()]), $comments->count())}}</h2>
    <form method="POST" action="{{route('daugt.content.comments.create', ['type' => $type, 'slug' => $slug])}}">
        @csrf
        <div x-data="setupEditor()"
             x-init="() => init($refs.editor)"
             wire:ignore
                {{ $attributes->merge(['class' => 'bg-white rounded-lg border-2 border-neutral-100']) }}>

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
    <div class="flex flex-col divide-y-2 divide-neutral-100 mt-1">
        @foreach($comments as $comment)
            <x-daugt::content.comment-card :comment="$comment" :delete-url="route('daugt.content.comments.delete', ['type' => $type, 'slug' => $slug, 'comment' => $comment])"  ></x-daugt::content.comment-card>
        @endforeach
    </div>
</div>