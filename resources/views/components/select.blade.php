@props([
'options' => [],
'disabled' => false,
'selected' => '',
])

<select
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'block mt-1 w-full shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50']) !!}
>
    <option value="" {{$selected == '' ? 'selected' : ''}}></option>
    @foreach($options as $value => $text)
        <option value="{{$value}}" {{$selected == $value ? 'selected' : ''}}>{{__($text)}}</option>
    @endforeach
</select>
