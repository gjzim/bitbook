<div class="">
    <template x-if="'image' in post">
        <img x-bind:src="post.image.large" alt="" class="max-h-full mt-3 mb-4 mx-auto">
    </template>

    <div x-text="post.content"></div>
</div>
