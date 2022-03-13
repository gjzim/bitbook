<div class="post-actions flex justify-between items-center">
    <ul class="flex text-blue-500">
        <li class="mr-2">
            <a @click.prevent="likeClickHandler" x-text="isLiked ? 'Unlike' : 'Like'" class="cursor-pointer"></a>
        </li>
        <li class="mr-2">
            &middot;
            <a @click.prevent="showCommentsForm = true" class="cursor-pointer ml-1">Add Comment</a>
        </li>
        <li x-cloak x-show="commentsCount > 0">
            &middot;
            <a @click.prevent="showHideCommentsBtnClickHandler"
                x-text="showComments ? 'Hide Comments' : 'Show Comments'" class="cursor-pointer ml-1"></a>
        </li>
    </ul>

    <ul class="flex text-blue-500">
        <li class="mr-3">
            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            <span x-text="likesCount"></span>
        </li>
        <li>
            <i class="fa fa-comments" aria-hidden="true"></i>
            <span x-text="commentsCount"></span>
        </li>
    </ul>
</div>
