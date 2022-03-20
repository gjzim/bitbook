@extends('layouts.app')

@section('body')
    <div class="relative container flex flex-col min-h-screen mx-auto">
        @include('layouts.partials.header')

        <div class="flex justify-between flex-grow">
            <aside class="w-1/4 mr-16">
                @include('layouts.partials.sidebar')
            </aside>

            <main class="w-3/4">
                @yield('content')
            </main>
        </div>

        @include('layouts.partials.footer')

        @include('notifications.box')
    </div>

    @stack('overlays')
@endsection
