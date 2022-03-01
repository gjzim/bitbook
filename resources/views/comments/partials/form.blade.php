<div x-show="showCommentsForm" class="flex items-start mt-4">
    <div class="bg-white border border-gray-400 p-px mr-2">
        <img src="{{ auth()->user()->getAvatarUrl('small') }}" alt="Avatar image of {{ auth()->user()->name }}"
            width="40px">
    </div>

    <form x-ref="addCommentForm" @submit.prevent="addComment" class="flex flex-col flex-grow">
        @csrf

        <div>
            <label class="hidden">Add Comment:</label>
            <textarea name="content" class="w-full border border-gray-300 px-2 py-1" rows="2"></textarea>
        </div>

        <div class="self-end text-sm mt-2">
            <a @click.prevent="closeCommentBox" class="text-blue-500 underline cursor-pointer mr-2">Close</a>

            <button type="submit" class="bg-blue-600 text-center text-white px-3 py-1 hover:bg-blue-500">
                Add Comment
            </button>
        </div>
    </form>
</div>
