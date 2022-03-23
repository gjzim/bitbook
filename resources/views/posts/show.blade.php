@extends('layouts.post')

@section('title', $pageTitle)

@section('content')
    <div x-data="singlePostActions(
            {{ \Illuminate\Support\Js::from($post) }},
            {
                showCommentsForm: true,
                initLoadComments: true,
                redirectOnDelete: true,
            }
        )"
        class="mb-8">
        @include('posts.partials.header')

        @include('posts.partials.body')
    </div>
@endsection
