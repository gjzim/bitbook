<header class="flex items-center">
    <div class="bg-white border border-gray-400 p-xs mr-3">
        <a x-bind:href="post.author.url">
            <img x-bind:src="post.author.avatar.small" alt="#" width="50">
        </a>
    </div>
    <div>
        <h2 class="text-lg font-bold">
            <a x-bind:href="post.author.url" x-text="post.author.name"></a>
        </h2>
        <div class="text-sm">
            <span class="font-bold text-gray-600">
                <a x-bind:href="post.author.url" x-text="`@${post.author.username}`"></a>
            </span>

            &middot;

            <a class="text-gray-600" x-bind:href="post.url" x-text="`${timeSince(new Date(post.created_at))} ago`"></a>

            <template x-if="post.deletable_by_logged_in_user">
                <span>
                    &middot;
                    <a @click.prevent="deletePost" class="text-red-500 cursor-pointer hover:underline">Delete</a>
                </span>
            </template>
        </div>
    </div>
</header>
