@if( count($post->comments) > 0 )
    <div class="post-comments-list bg-white border border-gray-200 my-4 p-5">
        @foreach ($post->comments as $comment)
            <div
                class="comment flex text-sm justify-start {{ $loop->last ? '' : 'pb-5 mb-5 border-b border-gray-200' }}">
                <div class="mr-3" style="width: 5%">
                    <a href="{{$comment->user->url()}}">
                        <img src="{{$comment->user->avatar}}" alt="">
                    </a>
                </div>
                <div class="text-gray-600" style="width: 95%">
                    <h4 class="font-bold text-base leading-none mb-1">
                        <a href="{{$comment->user->url()}}">
                            {{$comment->user->name}}
                        </a>
                    </h4>
                    <div class="comment-content">
                        {{$comment->content}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
