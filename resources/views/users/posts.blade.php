@extends('layouts.users')

@section('title', "Posts by {$user->name}")

@section('content')
    <div>
        <h2 class="text-4xl font-bold text-gray-700">{{ "Posts by {$user->name}" }}</h2>

        <hr class="border-t border-gray-300 my-3">

        @if (auth()->user()->id === $user->id)
            @include('posts.partials.publish')
        @endif

        <x-posts-list url="{{ route('users.posts', ['user' => $user]) }}" />
    </div>
@endsection
