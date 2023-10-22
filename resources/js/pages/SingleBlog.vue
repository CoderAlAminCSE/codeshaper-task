<template>
  <section class="single-blog-post" v-if="post">
    <div v-if="post.user ">
      <h1>{{ post.title }}</h1>

      <p class="time-and-author">Writen by - {{ post.user.name }}</p>

      <div class="single-blog-post-ContentImage" data-aos="fade-left"></div>

      <div class="about-text">
        <p>
          {{ post.description }}
        </p>
      </div>
    </div>
  </section>
  <div
    v-if="post.comments && post.comments.length > 0"
    class="comment-container"
  >
    <div
      class="comment"
      v-for="(comment, index) in post.comments"
      :key="comment.id"
    >
      {{ index + 1 }}. <strong>{{ comment.comment }}</strong> -by:
      {{ comment.user.name }}
    </div>
  </div>
  <div v-else>No comments found</div>
  <form @submit.prevent="commentStore(post)">
    <div class="comment-container">
      <input
        type="text"
        placeholder="Write a comment"
        v-model="fields.comment"
      />
      <span v-if="errors.comment" class="error">
        {{ errors.comment[0] }}
      </span>
      <button class="button" type="submit" :disabled="loading">
        <span v-if="loading">Submit...</span>
        <span v-else>Submit</span>
      </button>
    </div>
  </form>
</template>


  <script>
export default {
  props: ["slug"],
  data() {
    return {
      post: {},
      fields: {},
      errors: {},
      loading: false,
    };
  },

  mounted() {
    axios
      .get("/api/post/" + this.slug)
      .then((response) => {
        this.post = response.data;
        console.log(this.post);
      })
      .catch((error) => {
        console.log(error);
      });
  },

  methods: {
    commentStore(post) {
      this.loading = true;
      axios
        .post("/api/post/comment/store/" + post.id, this.fields)
        .then((response) => {
          this.loading = false;
          (this.fields = {}), (this.errors = {});
          axios
            .get("/api/post/" + this.slug)
            .then((response) => {
              this.post = response.data;
            })
            .catch((error) => {
              console.log(error);
            });
        })
        .catch((error) => {
          this.loading = false;
          this.errors = error.response.data.errors;
          if (error.response.status == 401) {
            this.$router.push({ name: "Login" });
          }
        });
    },
  },
};
</script>

  <style scoped>
.comment-container {
  border: 1px solid #ccc;
  padding: 10px;
  margin: 10px;
}

.comment {
  margin-bottom: 10px;
}

input[type="text"] {
  width: 100%;
  padding: 5px;
}

.submit-button {
  margin-top: 10px;
}

.button {
  margin-top: 10px;
  background-color: #6d49d1;
  color: white;
  border: none;
  padding-left: 15px;
  padding-right: 15px;
  padding-top: 7px;
  padding-bottom: 7px;
  cursor: pointer;
}
</style>