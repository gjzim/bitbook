@extends('layouts.master')

@section('title', 'Search')

@section('sidebar-menu')
    <x-sidebar-menu>
        <x-sidebar-menu-item to="{{ route('search') }}" fa-class="fa-search">
            Search Result
        </x-sidebar-menu-item>
    </x-sidebar-menu>
@endsection

@section('content')
    @yield('content')
@endsection
