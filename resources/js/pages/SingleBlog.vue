<template>
  <section class="single-blog-post" v-if="post">
    <h1>{{ post.title }}</h1>

    <p class="time-and-author">
      Writen by {{ post.user }}
      <span>{{ post.created_at }}</span>
    </p>

    <div class="single-blog-post-ContentImage" data-aos="fade-left"></div>

    <div class="about-text">
      <p>
        {{ post.description }}
      </p>
    </div>
  </section>
</template>


  <script>
export default {
  props: ["slug"],
  data() {
    return {
      post: {},
    };
  },

  mounted() {
    axios
      .get("/api/post/" + this.slug)
      .then((response) => {
        this.post = response.data.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>

  <style lang="scss" scoped>
</style>