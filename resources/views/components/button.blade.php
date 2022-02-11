@props([
'variant' => '',
])

@php
    $classes = "inline-flex items-center px-4 py-2 border border-transparent text-white focus:ring focus:ring-opacity-50 disabled:opacity-25 transition ease-in-out duration-150 ";

    if ($variant === 'error') {
        $classes .= "bg-red-600 hover:bg-red-500 active:bg-red-900 focus:border-red-900 focus:ring-red-200";
    } else {
        $classes .= "bg-blue-600 hover:bg-blue-500 active:bg-blue-900 focus:border-blue-900 focus:ring-blue-200";
    }
@endphp

<button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
    {{ $slot }}
</button>
