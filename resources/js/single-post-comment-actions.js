export default function singlePostCommentActions(post, options) {
    return {
        showComments: false,
        showCommentsForm: options.showCommentsForm,
        comments: [],
        commentsCount: post.comments_count,
        hasCommentsLeft: post.comments_count > 0,
        currentCommentsPage: -1,
        postCommentsUrl: `/posts/${post.id}/comments`,
        nextCommentsPageUrl: `/posts/${post.id}/comments`,

        commentsActionsInit() {
            if (options.initLoadComments) {
                this.showComments = options.initLoadComments;
                this.loadComments();
            }
        },

        showHideCommentsBtnClickHandler() {
            if (this.showComments) {
                this.showComments = false;
                this.showCommentsForm = false;
            } else {
                this.showComments = true;
            }

            if (this.hasCommentsLeft && this.comments.length == 0) {
                this.loadComments();
            }
        },

        loadComments() {
            if (!this.hasCommentsLeft) {
                return;
            }

            axios
                .get(this.nextCommentsPageUrl)
                .then((response) => {
                    const { data: comments, links, meta } = response.data;
                    this.comments = this.comments.concat(comments);
                    this.sortCommentsByCreatedAtDesc();
                    this.currentCommentsPage = meta.current_page;
                    this.nextCommentsPageUrl = links.next;

                    if (meta.current_page == meta.last_page) {
                        this.hasCommentsLeft = false;
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        async refreshComments() {
            let freshCommentsList = [];
            let curPage = -1;
            let nextPageUrl = this.postCommentsUrl;
            let hasCommentsLeft = true;

            while (curPage < this.currentCommentsPage && hasCommentsLeft) {
                const response = await axios.get(nextPageUrl);
                const { data: comments, links, meta } = response.data;
                freshCommentsList = freshCommentsList.concat(comments);
                curPage = meta.current_page;
                nextPageUrl = links.next;

                if (meta.current_page == meta.last_page) {
                    hasCommentsLeft = false;
                }
            }

            this.currentCommentsPage = curPage;
            this.nextCommentsPageUrl = nextPageUrl;
            this.hasCommentsLeft = hasCommentsLeft;

            this.comments = freshCommentsList;
            this.sortCommentsByCreatedAtDesc();
        },

        sortCommentsByCreatedAtDesc() {
            this.comments.sort(
                (a, b) => new Date(a.created_at) - new Date(b.created_at)
            );
        },

        closeCommentBox(event) {
            this.showCommentsForm = false;
            this.$refs.addCommentForm.reset();
        },

        addComment() {
            axios
                .post(this.postCommentsUrl, {
                    content: this.$refs.addCommentForm.elements.content.value,
                })
                .then(() => {
                    this.showComments = true;
                    this.hasCommentsLeft = true;
                    this.commentsCount += 1;

                    if (this.currentCommentsPage == -1) {
                        this.loadComments();
                    } else {
                        this.refreshComments();
                    }

                    this.$refs.addCommentForm.reset();
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        removeComment(commentId) {
            if (!confirm("Do you really want to delete this comment?")) {
                return;
            }

            const url = `/comments/${commentId}`;
            axios
                .delete(url)
                .then(() => {
                    this.commentsCount -= 1;

                    if (this.showComments) {
                        this.refreshComments();
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    };
}
