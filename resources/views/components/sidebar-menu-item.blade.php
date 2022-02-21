@props([
'to' => '#',
'faClass' => '',
'selected' => false
])

@php
    $selected = request()->url() === $to;
    $classes = 'block flex items-center w-full px-5 py-1 ' . ($selected ? 'bg-blue-500 text-white pointer-events-none' : 'text-blue-500');
@endphp

<li class="">
    <a href="{{$to}}" {{ $attributes->merge(['class' => $classes]) }}>
        <i class="fa {{$faClass}} mr-2" aria-hidden="true"></i>
        {{$slot}}
    </a>
</li>
