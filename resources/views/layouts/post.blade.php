@extends('layouts.master')

@section('sidebar-menu')
    <x-sidebar-menu>
        <x-sidebar-menu-item to="{{ route('home') }}" fa-class="fa-th-list" selected>News Feed</x-sidebar-menu-item>
    </x-sidebar-menu>
@endsection

@section('content')
    @yield('content')
@endsection
