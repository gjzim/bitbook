@extends('layouts.master')

@section('sidebar-menu')
    <x-sidebar-menu>
        <x-sidebar-menu-item to="{{ route('users.show', ['user' => $user]) }}" fa-class="fa-user">About
        </x-sidebar-menu-item>
        <x-sidebar-menu-item to="{{ route('users.posts', ['user' => $user]) }}" fa-class="fa-th-list">Posts
        </x-sidebar-menu-item>
        @can('update', $user)
            <x-sidebar-menu-item to="{{ route('users.edit', ['user' => $user]) }}" fa-class="fa-edit">Edit Profile
            </x-sidebar-menu-item>
            <x-sidebar-menu-item to="{{ route('users.change.password', ['user' => $user]) }}" fa-class="fa-wrench">
                Change Password
            </x-sidebar-menu-item>
            <x-sidebar-menu-item to="{{ route('users.delete.confirm', ['user' => $user]) }}" fa-class="fa-trash">
                Delete Profile
            </x-sidebar-menu-item>
        @endcan
    </x-sidebar-menu>
@endsection

@section('content')
    @yield('content')
@endsection
