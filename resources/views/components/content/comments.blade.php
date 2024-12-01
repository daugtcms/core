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
            <div class="py-3">
            <div class="flex items-center justify-between p-2">
                <div class="flex items-center gap-x-3">
                    <x-daugt::avatar class="w-10 h-10"></x-daugt::avatar>
                    @isset($comment->user)
                    <div>
                        <p class="font-medium text-neutral-800">{{$comment->user->name}}</p>
                        <p class="text-neutral-500 text-sm -mt-1" title="{{$comment->created_at}}">{{$comment->created_at->diffForHumans()}}</p>
                    </div>
                    @else
                    <div>
                        <p class="font-medium text-neutral-500 italic">{{__('daugt::content.comment_deleted')}}</p>
                    </div>
                    @endisset
                </div>
                <div class="flex items-center gap-1">
                    {{--<x-daugt::form.icon-button icon="lucide:smile-plus"></x-daugt::form.icon-button>
                    <x-daugt::form.icon-button icon="lucide:reply"></x-daugt::form.icon-button>--}}
                    @if($comment->user_id === auth()->id())
                    <x-daugt::form.dropdown-button :icon-button="true" :icon="'lucide:ellipsis-vertical'" :style="'secondary'">
                        <form method="POST" action="{{route('daugt.content.comments.delete', ['type' => $type, 'slug' => $slug, 'comment' => $comment])}}">
                            @csrf
                            @method('DELETE')
                            <x-daugt::form.dropdown-button-item type="submit" :style="'danger'" class="text-danger-500">
                                {{__('daugt::general.delete')}}</x-daugt::form.dropdown-button-item>
                        </form>
                    </x-daugt::form.dropdown-button>
                    @endif
                </div>
            </div>
            <div class="px-2 prose">
                {!! $comment->text ?? __('daugt::content.comment_deleted_text') !!}
            </div>
            </div>
        @endforeach
    </div>
</div>