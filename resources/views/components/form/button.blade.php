@props(['style', 'href', 'disabled'])

@php
    $classes = '';
    switch ($style ?? 'secondary') {
    case 'primary':
    $classes .=
    'text-white bg-primary-600 hover:bg-primary-500 active:bg-primary-900 focus:border-primary-900 ring-primary-300';
    break;
    case 'secondary':
    $classes .= 'text-white bg-neutral-800 hover:bg-neutral-700 active:bg-neutral-900 focus:border-neutral-900 ring-neutral-300';
    break;
    case 'danger':
    $classes .= 'text-white bg-danger-600 hover:bg-danger-500 active:bg-danger-900 focus:border-danger-900 ring-danger-300';
    break;
    case 'success':
    $classes .= 'text-white bg-success-600 hover:bg-success-500 active:bg-success-900 focus:border-success-900 ring-success-300';
    break;
    }
@endphp

@if(isset($href))
    <a {{ $attributes->merge(['href' => $href, 'class' => 'inline-flex items-center justify-center px-2 py-1.5 border
    border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring
    disabled:opacity-25 transition ease-in-out duration-150 ' . $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-2 py-1.5
    border border-transparent rounded-md font-medium text-sm tracking-wide focus:outline-none focus:ring
    disabled:opacity-25 transition ease-in-out duration-150 ' . $classes]) }}>
        {{ $slot }}
    </button>
@endif
