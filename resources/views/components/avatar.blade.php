@props(['user' => Auth::user()])
<div {{$attributes->merge(['class' => 'rounded-full shadow overflow-hidden bg-primary-100 flex-shrink-0 group-hover:bg-white transition-colors text-primary-500 flex items-center justify-center'])}}>
    @php
        $avatar = null;
        if($user !== -1) {
            $avatar = $user->avatar();
        }
    @endphp
    @if(empty($avatar))
    <div class="i-lucide:user w-full h-full -mb-1"></div>
    @else
    <img src="{{\Daugt\Helpers\Media\MediaHelper::getMedia($avatar, 'thumbnail')}}" alt="{{$user->name}}" class="w-full h-full object-cover">
    @endif
</div>