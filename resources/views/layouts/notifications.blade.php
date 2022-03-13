@extends('layouts.master')

@section('title', 'Notifications')

@section('sidebar-menu')
    <x-sidebar-menu>
        <x-sidebar-menu-item to="{{ route('notifications.index') }}" fa-class="fa-bell">
            All Notifications
        </x-sidebar-menu-item>
    </x-sidebar-menu>
@endsection

@section('content')
    @yield('content')
@endsection
