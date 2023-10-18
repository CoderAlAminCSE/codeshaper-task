
<template>
  <div id="create-post">
    <div id="contact-us">
      <h1>Update Post!</h1>
      <div class="contact-form">
        <form @submit.prevent="submit">
          <label for="title"><span>Title</span></label>
          <input type="text" id="title" name="title" v-model="fields.title" />
          <span v-if="errors.title" class="error"> {{ errors.title[0] }} </span>

          <br />
          <label for="description"><span>Description</span></label>
          <textarea
            name="description"
            id="description"
            cols="30"
            rows="5"
            v-model="fields.description"
          ></textarea>
          <span v-if="errors.description" class="error">
            {{ errors.description[0] }}
          </span>
          <input type="submit" value="Update" />
        </form>
      </div>
    </div>
  </div>
</template>
    <script>
export default {
  props: ["id"],
  data() {
    return {
      fields: {},
      errors: {},
    };
  },

  methods: {
    submit() {
      axios
        .post("/api/post/update/" + this.id, this.fields)
        .then((response) => {
          this.fields = response.data;
          this.$router.push({ name: "PostList" });
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },

  mounted() {
    axios
      .get("/api/post/edit/" + this.id)
      .then((response) => {
        this.fields = response.data;
        console.log(response.data);
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>
    <style scoped>
#create-post {
  background-color: #f3f4f6;
  height: 150vh;
  padding: 50px;
}
</style>