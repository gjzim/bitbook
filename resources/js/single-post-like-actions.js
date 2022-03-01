export default function singlePostLikeActions(postId, likesCount = 0, isLiked = false) {
    return {
        likesCount: likesCount,
        isLiked: isLiked,

        likeClickHandler() {
            if (this.isLiked) {
                this.unlikePost();
            } else {
                this.likePost();
            }
        },

        likePost() {
            const url = `/posts/${postId}/likes`;
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

            const url = `/posts/${postId}/likes`;
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
