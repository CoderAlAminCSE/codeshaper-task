
<template>
  <div id="create-post">
    <div id="contact-us">
      <h1>Create New Post!</h1>
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
          <span v-if="errors.title" class="error">
            {{ errors.description[0] }}
          </span>

          <div v-if="role === 'premium'">
            <label for="scheduledDateTime"
              >Scheduled Publish Date and Time:</label
            >
            <input
              type="datetime-local"
              id="scheduledDateTime"
              v-model="fields.scheduled_at"
              name="scheduledDateTime"
            />
          </div>
          <button class="button" type="submit" :disabled="loading">
            <span v-if="loading">Loading...</span>
            <span v-else>Submit</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</template>
  <script>
export default {
  data() {
    return {
      fields: {},
      errors: {},
      role: "",
      loading: false,
    };
  },

  mounted() {
    axios
      .get("/api/user")
      .then((response) => {
        this.role = response.data.role;
        console.log(response);
      })
      .catch((error) => {
        console.log(error);
      });
  },

  methods: {
    submit() {
      this.loading = true;
      axios
        .post("/api/post/store", this.fields)
        .then(() => {
          (this.fields = {}), (this.errors = {});
          this.loading = false;
          this.$router.push({ name: "PostList" });
        })
        .catch((error) => {
          this.loading = false;
          const statusCode = error.response.status;
          if (statusCode == 403) {
            alert("Daily limit is exceeded, please upgrade your membership");
            this.$router.push({ name: "Dashboard" });
          } else {
            this.errors = error.response.data.errors;
          }
        });
    },
  },
};
</script>
  <style scoped>
#create-post {
  background-color: #f3f4f6;
  height: 150vh;
  padding: 50px;
}

.button{
  color: white;
  background-color: black;
  padding: 10px;
}
</style>