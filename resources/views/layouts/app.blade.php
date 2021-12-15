<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased text-gray-800">
        <div class="container flex flex-col min-h-screen mx-auto">
            @include('layouts.header')

            <div class="flex justify-between flex-grow">
                <aside class="w-1/4 mr-16">
                    @include('layouts.sidebar')
                </aside>

                <main class="w-3/4">
                    @yield('content')
                </main>
            </div>

            @include('layouts.footer')
        </div>
    </body>
</html>