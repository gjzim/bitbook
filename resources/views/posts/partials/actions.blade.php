<div class="post-actions flex justify-between">
    <ul class="flex text-blue-500">
        <li class="mr-2"><a href="#">Like</a></li>
        <li class="mr-2">&middot; <a @click.prevent="showCommentForm = true" class="cursor-pointer ml-1">Add Comment</a></li>
    </ul>

    <ul class="flex text-blue-500">
        <li class="mr-3">
            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            <span>45</span>
        </li>
        <li>
            <i class="fa fa-comments" aria-hidden="true"></i>
            <span>25</span>
        </li>
    </ul>
</div>
