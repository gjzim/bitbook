<div class="bg-white border border-gray-200 my-4 p-5">
    <template x-for="comment in post.comments" :key="comment.id">
        <div class="flex text-sm justify-start" :class="{'pb-5 mb-5 border-b border-gray-200': true}">
            <div class="mr-3" style="width: 5%">
                <a x-bind:href="comment.author.url">
                    <img x-bind:src="comment.author.avatar.small" alt="">
                </a>
            </div>
            <div class="text-gray-600" style="width: 95%">
                <h4 class="font-bold text-base leading-none mb-1">
                    <a x-bind:href="comment.author.url" x-text="comment.author.name"></a>
                </h4>
                <div x-text="comment.content"></div>
            </div>
        </div>
    </template>
</div>
