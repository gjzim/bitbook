@props(['field' => ''])

@error($field)
<span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
@enderror
