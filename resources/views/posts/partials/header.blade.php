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
            <span class="font-bold text-gray-500">
                <a x-bind:href="post.author.url" x-text="`@${post.author.username}`"></a>
            </span>

            &middot;

            <a class="text-gray-500" x-bind:href="post.url" x-text="`${timeSince(new Date(post.created_at))} ago`"></a>
        </div>
    </div>
</header>
