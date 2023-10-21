<template>
  <h2 class="header-title">Latest Blog Posts</h2>
  <div v-if="loading" class="loading-message">Loading...</div>
  <div v-else>
    <div v-if="posts.length === 0" class="no-post-found">No Post Found</div>
    <section v-else class="cards-blog latest-blog">
      <div class="card-blog-content" v-for="post in posts" :key="post.id">
        <p>
          Written By {{ post.user }}
          <span style="float: right">{{ post.created_at }}</span>
        </p>
        <h4 style="font-weight: bolder">
          <router-link
            :to="{
              name: 'SingleBlog',
              params: { slug: post.slug },
            }"
            >{{ post.title }}</router-link
          >
        </h4>
        <div>
          <p>
            {{ post.description }}
          </p>
        </div>
      </div>
    </section>
  </div>
</template>

  <script>
export default {
  data() {
    return {
      posts: [],
      loading: true,
    };
  },

  mounted() {
    axios
      .get("/api/frontend/post")
      .then((response) => {
        this.posts = response.data;
        this.loading = false;
        console.log(this.posts);
      })
      .catch((error) => {
        console.log(error);
        this.loading = false;
      });
  },
};
</script>

  <style scoped>
.loading-message {
  margin-left: 450px;
}
.no-post-found {
  margin-left: 450px;
}
</style>