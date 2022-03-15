export default function singlePostLikeActions(post, options) {
    return {
        deleteActionsInit() {},

        deletePost() {
            if (!confirm("Do you really want to delete this post?")) {
                return;
            }

            const url = `/posts/${post.id}`;
            axios
                .delete(url)
                .then(() => {
                    if (options.redirectOnDelete) {
                        window.location.replace("/");
                    } else {
                        this.$dispatch("post-deleted", { postId: post.id });
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    };
}
