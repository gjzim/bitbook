@extends('layouts.post')

@section('content')
    <div x-data="singlePostActions(
            JSON.parse('{{ $post->toJson() }}'),
            {
                showCommentsForm: true,
                initLoadComments: true
            }
        )"
        class="mb-8">
        @include('posts.partials.header')

        @include('posts.partials.body')
    </div>
@endsection
