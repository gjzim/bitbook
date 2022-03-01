<div class="bg-gray-100 px-5 py-4 mt-3">
    @include('posts.partials.content')

    <hr class="border-t border-gray-300 my-3">

    @include('posts.partials.actions')

    <template x-if="showComments && comments.length > 0">
        @include('comments.list')
    </template>

    @include('comments.partials.form')
</div>
