import singlePostLikeActions from "./single-post-like-actions.js";
import singlePostCommentActions from "./single-post-comment-actions.js";

export default function singlePostActions(post, options = {}) {
    options.showCommentsForm ||= false;
    options.initLoadComments ||= false;

    return {
        post,
        ...singlePostLikeActions(post, options),
        ...singlePostCommentActions(post, options),
        init() {
            this.likeActionsInit();
            this.commentsActionsinit();
        }
    };
}
