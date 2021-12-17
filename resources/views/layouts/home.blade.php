@extends('layouts.master')

@section('sidebar-menu')
    <ul>
        <li>
            <a href="#" class="block px-5 py-1 bg-blue-500 text-white pointer-events-none">
                <i class="fa fa-th-list mr-1" aria-hidden="true"></i>
                News Feed
            </a>
        </li>
        <li>
            <a href="#" class="block px-5 py-1 text-blue-500 hover:bg-gray-200">
                <i class="fa fa-user mr-1" aria-hidden="true"></i>
                View Profile
            </a>
        </li>
        <li>
            <a href="/friends" class="block px-5 py-1 text-blue-500 hover:bg-gray-200">
                <i class="fa fa-users mr-1" aria-hidden="true"></i>
                Friends
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <h1 class="hidden" aria-hidden="true">Home</h1>

    @include('posts.partials.publish')

    @foreach ($posts as $post)
        @include('posts.single')
    @endforeach
@endsection
