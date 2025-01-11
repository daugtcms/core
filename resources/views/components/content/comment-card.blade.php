@props(['comment'])

<div class="py-3">
    <div class="flex items-center justify-between p-2">
        <div class="flex items-center gap-x-3">
            @if(isset($comment->user) && !($comment->anonymous))
                <x-daugt::avatar class="w-10 h-10" :user="$comment->user"></x-daugt::avatar>
                <div>
                    <p class="font-medium text-neutral-800">{{$comment->user->name}}</p>
                    <p class="text-neutral-500 text-sm -mt-1" title="{{$comment->created_at}}">{{$comment->created_at->diffForHumans()}}</p>
                </div>
            @elseif($comment->anonymous)
                <x-daugt::avatar class="w-10 h-10" :user="-1"></x-daugt::avatar>
                <div>
                    <p class="font-medium text-neutral-800">{{__('daugt::content.anonymous')}}</p>
                    <p class="text-neutral-500 text-sm -mt-1" title="{{$comment->created_at}}">{{$comment->created_at->diffForHumans()}}</p>
                </div>
            @else
                <div>
                    <p class="font-medium text-neutral-500 italic">{{__('daugt::content.comment_deleted')}}</p>
                </div>
            @endif
        </div>
        <div class="flex items-center gap-1">
            <x-daugt::user.reactions :reactions-enabled="true" :route="'/comments/'.$comment->id" :reactions="$comment->reactions" style="secondary"></x-daugt::user.reactions>
            @if($comment->user_id === auth()->id())
                <x-daugt::form.dropdown-button :icon-button="true" :icon="'lucide:ellipsis-vertical'" :style="'secondary'">
                    <form method="POST" action="{{route('daugt.comments.delete', ['comment' => $comment])}}">
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
    <div class="grid grid-cols-3 gap-3 sm:grid-cols-6">
        @foreach($comment->media as $media)
            <div class="relative w-full overflow-hidden bg-white shadow flex rounded-lg group aspect-square" @click="previewUrl = '{{MediaHelper::getMedia($media, 'optimized')}}'">
                <img src="{{MediaHelper::getMedia($media, 'thumbnail')}}" alt="" class="object-cover pointer-events-none items-center justify-center w-full h-full">
            </div>
        @endforeach
    </div>
    @if(!($comment->commentable instanceof \Daugt\Models\User\Comment))
        <div class="bg-neutral-50 p-1 rounded-md mt-2.5" x-data="{showReplyTextbox: false}">
            <button class="w-full text-primary-500 rounded-md hover:bg-neutral-100 flex items-center gap-x-2 px-2 py-1" x-show="!showReplyTextbox" @click="showReplyTextbox = !showReplyTextbox">
                <div class="i-lucide:reply w-5 h-5"></div> {{__('daugt::content.reply')}}
            </button>
            <template x-if="showReplyTextbox">
                <form method="POST" action="{{route('daugt.comments.reply.add', ['comment' => $comment])}}">
                    @csrf
                    <x-daugt::content.comment-textbox></x-daugt::content.comment-textbox>
                </form>
            </template>
            <div class="divide-y divide-neutral-200 px-4">
                @foreach($comment->comments as $comment)
                    <x-daugt::content.comment-card :comment="$comment"></x-daugt::content.comment-card>
                @endforeach
            </div>
        </div>
    @endif
</div>