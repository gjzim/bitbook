<div class="bg-gray-100 p-5 pt-4 mt-3">
    @include('posts.partials.content')

    <hr class="border-t border-gray-300 my-2">

    @include('posts.partials.actions')

    <template x-if="'comments' in posts">
        @include('comments.list')
    </template>

    @include('comments.partials.form')
</div>
