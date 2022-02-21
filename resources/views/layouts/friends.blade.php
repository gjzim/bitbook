@extends('layouts.master')

@section('sidebar-menu')
    <x-sidebar-menu>
        <x-sidebar-menu-item to="{{ route('users.friends', ['user' => auth()->user()]) }}" fa-class="fa-user-friends">
            Friends List
        </x-sidebar-menu-item>
        <x-sidebar-menu-item to="{{ route('users.friends.pending', ['user' => auth()->user()]) }}"
            fa-class="fa-user-plus">
            Friend Requests
            @if (auth()->user()->pendingFriendRequestsCount() > 0)
                <x-notification-count-bubble :count="auth()->user()->pendingFriendRequestsCount()" />
            @endif
        </x-sidebar-menu-item>
        <x-sidebar-menu-item to="{{ route('users.friends.suggestions', ['user' => auth()->user()]) }}"
            fa-class="fa-users">
            People You May Know
        </x-sidebar-menu-item>
    </x-sidebar-menu>
@endsection

@section('content')
    @yield('content')
@endsection
