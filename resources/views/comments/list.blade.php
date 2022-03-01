<div class="bg-white border border-gray-200 mt-4">
    <div @click="loadComments" x-show="hasCommentsLeft"
        class="bg-blue-400 text-white text-center py-1 cursor-pointer hover:bg-blue-500">
        Load more comments
    </div>

    <div class="p-4">
        <template x-for="(comment, index) in comments" :key="comment.id">
            <div class="flex text-sm justify-start"
                :class="{'pb-4 mb-4 border-b border-gray-200': index < comments.length - 1}">
                <div class="mr-3" style="width: 4%">
                    <a x-bind:href="comment.author.url">
                        <img x-bind:src="comment.author.avatar.small" alt="">
                    </a>
                </div>
                <div class="text-gray-600" style="width: 96%">
                    <h4 class="text-sm leading-none mb-1">
                        <a x-bind:href="comment.author.url" x-text="comment.author.name" class="font-bold"></a>
                        &middot;
                        <span x-text="`${timeSince(new Date(comment.created_at))} ago`"></span>
                        <template x-if="comment.deletable_by_logged_in_user">
                            <span>
                                &middot;
                                <a @click.prevent="removeComment(comment.id)"
                                    class="text-red-500 cursor-pointer hover:underline">Delete</a>
                            </span>
                        </template>
                    </h4>

                    <div x-text="comment.content"></div>
                </div>
            </div>
        </template>
    </div>
</div>
