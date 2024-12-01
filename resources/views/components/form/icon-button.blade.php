@props(['icon', 'style', 'href', 'disabled'])

@php
    $classes = '';
    switch ($style ?? 'secondary') {
    case 'primary':
        $classes .= 'text-primary-600 bg-transparent hover:bg-primary-200 active:bg-primary-100 focus:border-primary-200 ring-primary-300';
    break;
    case 'secondary':
    $classes .= 'text-neutral-600 bg-transparent hover:bg-neutral-200 active:bg-neutral-100 focus:border-neutral-200 ring-neutral-300';
    break;
    case 'danger':
    $classes .= 'text-danger-600 bg-transparent hover:bg-danger-200 active:bg-danger-100 focus:border-danger-200 ring-danger-300';
    break;
    case 'dark':
    $classes .= 'text-white bg-black/25! hover:bg-black/50! active:bg-black/30! focus:border-black/50! ring-black/25!';
    }

    if($slot->isEmpty()) {
       $classes .= ' w-8';
    }
@endphp

@if(isset($href))
    <a {{ $attributes->merge(['href' => $href, 'class' => 'inline-flex items-center justify-center p-1 h-8
border border-transparent rounded-md focus:outline-none focus:ring
disabled:opacity-25 transition ease-in-out duration-150 gap-x-1 ' . $classes]) }}>
        @isset($icon)
            <div class="i-{{$icon}} flex-shrink-0"></div>
        @endisset
        @if($slot->isNotEmpty())
            <p>{{$slot}}</p>
        @endif
    </a>
@else
    <button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center p-1 h-8
border border-transparent rounded-md focus:outline-none focus:ring
disabled:opacity-25 transition ease-in-out duration-150 gap-x-1 ' . $classes]) }}>
        @isset($icon)
            <div class="i-{{$icon}} flex-shrink-0"></div>
        @endisset
        @if($slot->isNotEmpty())
            <p>{{$slot}}</p>
        @endif
    </button>
@endif
