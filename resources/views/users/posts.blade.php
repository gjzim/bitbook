@extends('layouts.users')

@section('content')
    <div>
        <h2 class="text-4xl font-bold text-gray-700">{{ "Posts by {$user->name}" }}</h2>

        <hr class="border-t border-gray-300 my-3">

        <x-posts-list url="{{ route('users.posts', ['user' => $user]) }}" />
    </div>
@endsection
