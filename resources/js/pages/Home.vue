<template>
  <h2 class="header-title">Latest Blog Posts</h2>
  <section class="cards-blog latest-blog">
    <div class="card-blog-content" v-for="post in posts" :key="post.id">
      <p>
        Written By {{ post.user }}
        <span style="float: right">{{ post.created_at }}</span>
      </p>
      <h4 style="font-weight: bolder">
        <!-- <a href="single-blog.html">Benefits of Getting Covid 19 Vaccination</a> -->
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
</template>

  <script>
export default {
  data() {
    return {
      posts: [],
    };
  },

  mounted() {
    axios
      .get("/api/frontend/post")
      .then((response) => {
        this.posts = response.data;
        console.log(this.posts);
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>

  <style lang="scss" scoped>
</style>