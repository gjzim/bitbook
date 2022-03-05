<span x-data="{
    count: '{{ $count }}'
}" x-show="count > 0" x-text="count"
    {{ $attributes->merge([
        'class' => 'inline-block h-5 ml-2 px-2 leading-5 font-mono font-bold text-xs bg-red-500 text-white rounded-2xl text-shadow',
    ]) }}>
</span>
