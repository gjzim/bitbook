@props([
'to' => '#',
'faClass' => '',
'selected' => false
])

@php($classes = 'block px-5 py-1 ' . ($selected ? 'bg-blue-500 text-white pointer-events-none' : 'text-blue-500'))

<li>
    <a href="{{$to}}" {{ $attributes->merge(['class' => $classes]) }}>
        <i class="fa {{$faClass}} mr-1" aria-hidden="true"></i>
        {{$slot}}
    </a>
</li>
