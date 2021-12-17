<div class="bg-gray-100 p-5">
    <h3 class="text-2xl leading-none font-bold text-gray-600 mb-4">What's on your mind?</h3>
    <form action="/posts" method="POST" class="mt-2">
        @csrf

        <div>
            <label for="content" class="hidden">Status</label>
            <textarea name="content" id="content" cols="30" rows="4"
                      class="w-full border border-gray-300 p-3" required></textarea>

            @error('content')
            <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="flex items-center justify-between mt-2">
            <div>
                <label for="image"
                       class="bg-gray-500 text-center text-white px-3 pt-1 pb-2 hover:bg-gray-600 cursor-pointer">
                    <input type="file" name="image" id="image" class="absolute" style="left:-99999px;">
                    <span class="text-sm">Add Image</span>
                </label>

                @error('image')
                <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-center text-white px-4 py-1 mr-2 hover:bg-blue-500">
                    Publish
                </button>

                <a class="text-red-500 hover:underline" href="#" id="cancel-status">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>
