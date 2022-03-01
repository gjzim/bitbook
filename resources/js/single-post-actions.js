import singlePostLikeActions from "./single-post-like-actions.js";
import singlePostCommentActions from "./single-post-comment-actions.js";

export default function singlePostActions(post) {
    return {
        ...singlePostLikeActions(
            post.id,
            post.likes_count,
            post.liked_by_logged_in_user
        ),
        ...singlePostCommentActions(post.id, post.comments_count),
    };
}
