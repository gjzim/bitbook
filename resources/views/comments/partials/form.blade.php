<div class="comment-form flex items-start mt-3">
    <div class="bg-white border border-gray-400 p-px mr-4">
        <img src="{{auth()->user()->avatar}}" alt="" width="40px">
    </div>

    <form action="/comments" method="POST" class="flex flex-col flex-grow">
        @csrf

        <input type="hidden" name="post_id" value="{{$post->id}}">

        <div>
            <label for="content" class="hidden">Add Comment</label>
            <textarea name="content" id="content" cols="30" rows="2"
                      class="w-full border border-gray-300 p-3"></textarea>

            @error('content')
            <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="self-end text-sm mt-2">
            <button type="submit" class="bg-blue-600 text-center text-white px-3 py-1 mr-2 hover:bg-blue-500">Comment
            </button>

            <a class="text-red-500 hover:underline" href="#" id="cancel-post">
                Cancel
            </a>
        </div>
    </form>
</div>
