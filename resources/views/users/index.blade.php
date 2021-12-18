<div class="">
    <div class="flex">
        <div class="p-1 mr-5 border border-gray-300">
            <img src="{{$user->avatar}}" alt="" class="" style="width: 150px;">
        </div>

        <div>
            <h1 class="text-4xl font-bold text-gray-700">{{$user->name}}</h1>
            <div>
                <span class="font-bold text-gray-500"><a href="#">{{ '@' . $user->username}}</a></span>
                @if( $user->tagline )
                    <span class="text-gray-500"> &middot; {{$user->tagline}}</span>
                @endif
            </div>

            <div class="flex items-center mt-3">
                <form method="POST" action="{{route('profile.add-friend', $user)}}">
                    @csrf

                    <button type="submit"
                            class="mr-3 px-5 py-2 border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white">
                        <i class="fa fa-user mr-1" aria-hidden="true"></i>
                        Add as Friend
                    </button>
                </form>
            </div>

        </div>

    </div>

    <hr class="border-t border-gray-300 my-5">

    @foreach ($user->posts as $post)
        @include('post.single')
    @endforeach
</div>
