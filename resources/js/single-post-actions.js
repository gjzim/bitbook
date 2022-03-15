import singlePostLikeActions from "./single-post-like-actions.js";
import singlePostCommentActions from "./single-post-comment-actions.js";
import singlePostDeleteActions from "./single-post-delete-actions.js";

export default function singlePostActions(post, options = {}) {
    options.showCommentsForm ||= false;
    options.initLoadComments ||= false;
    options.redirectOnDelete ||= false;

    return {
        post,
        ...singlePostLikeActions(post, options),
        ...singlePostCommentActions(post, options),
        ...singlePostDeleteActions(post, options),
        init() {
            this.likeActionsInit();
            this.commentsActionsInit();
            this.deleteActionsInit();
        }
    };
}
