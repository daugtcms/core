@props(['comment', 'deleteUrl'])

<div class="py-3">
    <div class="flex items-center justify-between p-2">
        <div class="flex items-center gap-x-3">
            @isset($comment->user)
                <x-daugt::avatar class="w-10 h-10" :user="$comment->user"></x-daugt::avatar>
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
            <x-daugt::form.icon-button icon="lucide:reply"></x-daugt::form.icon-button>
            <x-daugt::user.reactions :reactions-enabled="true" :route="'/comments/'.$comment->id" :reactions="$comment->reactions" style="secondary"></x-daugt::user.reactions>
            @if($comment->user_id === auth()->id())
                <x-daugt::form.dropdown-button :icon-button="true" :icon="'lucide:ellipsis-vertical'" :style="'secondary'">
                    <form method="POST" action="{{$deleteUrl}}">
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