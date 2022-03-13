@extends('layouts.master')

@section('title', 'Home')

@section('sidebar-menu')
    <x-sidebar-menu>
        <x-sidebar-menu-item to="{{ route('home') }}" fa-class="fa-th-list" selected>News Feed</x-sidebar-menu-item>
        <x-sidebar-menu-item to="{{ route('users.show', ['user' => auth()->user()]) }}" fa-class="fa-user">
            View Profile
        </x-sidebar-menu-item>
        <x-sidebar-menu-item to="{{ route('users.friends', ['user' => auth()->user()]) }}" fa-class="fa-users">
            Friends
        </x-sidebar-menu-item>
    </x-sidebar-menu>
@endsection

@section('content')
    <h1 class="hidden" aria-hidden="true">Home</h1>

    @include('posts.partials.publish')

    <x-posts-list url="{{ route('home.posts.index') }}" />
@endsection
