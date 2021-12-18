<header class="flex items-center">
    <div class="bg-white border border-gray-400 p-xs mr-3">
        <a href="{{$post->user->url()}}">
            <img src="{{$post->user->avatar}}" alt="#" width="50">
        </a>
    </div>
    <div class="text-base">
        <h2 class="text-xl font-bold">
            <a href="{{$post->user->url()}}">{{ $post->user->name }}</a>
        </h2>
        <div>
            <span class="font-bold text-gray-500"><a href="{{$post->user->url()}}">{{ "@" . $post->user->username }}</a></span>
            @if( $post->user->tagline )
                <span class="text-gray-500"> &middot; {{ $post->user->tagline }}</span>
            @endif
        </div>
    </div>
</header>
