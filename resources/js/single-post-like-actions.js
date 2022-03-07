export default function singlePostLikeActions(post, options) {
    return {
        likesCount: post.likes_count,
        isLiked: post.liked_by_logged_in_user,

        likeActionsInit() {},

        likeClickHandler() {
            if (this.isLiked) {
                this.unlikePost();
            } else {
                this.likePost();
            }
        },

        likePost() {
            const url = `/posts/${post.id}/likes`;
            axios
                .post(url)
                .then((response) => {
                    this.isLiked = true;
                    this.likesCount += 1;
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        unlikePost() {
            if (this.likesCount === 0) {
                return;
            }

            const url = `/posts/${post.id}/likes`;
            axios
                .delete(url)
                .then((response) => {
                    this.isLiked = false;
                    this.likesCount -= 1;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    };
}
