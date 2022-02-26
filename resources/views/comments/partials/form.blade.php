<div x-show="showCommentForm" class="flex items-start mt-3">
    <div class="bg-white border border-gray-400 p-px mr-2">
        <img src="{{ auth()->user()->getAvatarUrl('small') }}" alt="Avatar image of {{ auth()->user()->name }}"
            width="40px">
    </div>

    <form action="/posts/12/comments" method="POST" class="flex flex-col flex-grow">
        @csrf

        <div>
            <x-label for="content" :value="__('Add Comment:')" class="hidden" />
            <x-textarea name="content" id="content" class="w-full border border-gray-300 p-3" rows="2"></x-textarea>
            <x-form-error field="content" />
        </div>

        <div class="self-end text-sm mt-2">
            <button type="submit" class="bg-blue-600 text-center text-white px-3 py-1 hover:bg-blue-500">
                Add Comment
            </button>
        </div>
    </form>
</div>
