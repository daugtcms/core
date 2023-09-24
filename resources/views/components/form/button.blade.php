@props(['style', 'href', 'disabled'])

@php
$classes = '';
switch ($style ?? 'secondary') {
case 'primary':
$classes .=
'text-white bg-primary-600 hover:bg-primary-500 active:bg-primary-900 focus:border-primary-900 ring-primary-300';
break;
case 'secondary':
$classes .= 'text-white bg-gray-800 hover:bg-gray-700 active:bg-gray-900 focus:border-gray-900 ring-gray-300';
break;
case 'danger':
$classes .= 'text-white bg-red-600 hover:bg-red-500 active:bg-red-900 focus:border-red-900 ring-red-300';
break;
case 'success':
$classes .= 'text-white bg-green-600 hover:bg-green-500 active:bg-green-900 focus:border-green-900 ring-green-300';
break;
}
@endphp

@if(isset($href))
<a {{ $attributes->merge(['href' => $href, 'class' => 'inline-flex items-center justify-center px-4 py-2 border
    border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring
    disabled:opacity-25 transition ease-in-out duration-150 ' . $classes]) }}>
    {{ $slot }}
</a>
@else
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-3 py-1.5
    border border-transparent rounded-md font-medium text-sm tracking-wide focus:outline-none focus:ring
    disabled:opacity-25 transition ease-in-out duration-150 ' . $classes]) }}>
    {{ $slot }}
</button>
@endif
