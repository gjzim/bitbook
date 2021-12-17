<header class="flex justify-between items-center my-2 mb-4">
    <p class="font-bold md:text-3xl lg:text-5xl text-gray-500">
        <a href="{{ route('home') }}">{{ config('app.name') }}</a>
    </p>

    @include('layouts.partials.navigation')
</header>
