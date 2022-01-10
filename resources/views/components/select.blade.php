@props([
'options' => [],
'disabled' => false
])

<select
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}
>
    <option value=""></option>
    @foreach($options as $value => $text)
        <option value="{{$value}}" {{ old($attributes['name']) == $value ? 'checked' : '' }}>{{__($text)}}</option>
    @endforeach
</select>
