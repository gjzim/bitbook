<div x-data="{
    hasPostsLeft: true,
    currentPage: -1,
    nextPageUrl: '{{ $url }}',
    posts: [],
    loadPosts() {
        if( !this.hasPostsLeft ) {
            return
        }

        axios.get(this.nextPageUrl)
        .then(response => {
            const {data: posts, links, meta} = response.data
            this.posts = this.posts.concat(posts)
            this.currentPage = meta.current_page
            this.nextPageUrl = links.next

            if( meta.current_page == meta.last_page ) {
                this.hasPostsLeft = false
            }
        })
        .catch(err => {
            console.log(err)
        })
    },
    deletePost(event) {
        this.posts = this.posts.filter(post => post.id !== event.detail.postId)
    }
}" @post-deleted.window="deletePost">
    <template x-for="post in posts" :key="post.id">
        @include('posts.single.index')
    </template>

    <div x-show="hasPostsLeft" x-intersect="loadPosts" @click="loadPosts">
        @include('posts.single.skeleton')
    </div>

    <div x-show="!hasPostsLeft" x-text="posts.length === 0 ? 'No posts available.' : 'No more posts available.'"
        class="bg-yellow-100 text-center py-4 mt-6 mb-10"></div>
</div>
