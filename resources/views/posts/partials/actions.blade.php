<div class="post-actions flex justify-between items-center">
    <ul class="flex text-blue-500">
        <li class="mr-3">
            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            <span x-text="likesCount"></span>
        </li>
        <li>
            <i class="fa fa-comments" aria-hidden="true"></i>
            <span>25</span>
        </li>
    </ul>

    <ul class="flex text-blue-500">
        <li class="mr-2">
            <a @click.prevent="likeClickHandler" x-text="isLiked ? 'Unlike' : 'Like'" class="cursor-pointer"></a>
        </li>
        <li>
            &middot;
            <a @click.prevent="showCommentForm = true" class="cursor-pointer ml-1">Add Comment</a>
        </li>
    </ul>
</div>
