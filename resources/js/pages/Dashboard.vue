<template>
  <div id="backend-view">
    <div class="logout"><a href="#" @click="logout">Logout</a></div>
    <h1 class="heading">Dashboard</h1>
    <span>Hi {{ name }}</span>
    <div class="links">
      <ul>
        <li>
          <router-link :to="{ name: 'CreatePost' }">Create Post</router-link>
        </li>
        <li>
          <router-link :to="{ name: 'PostList' }">Post List</router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

  <script>
export default {
  data() {
    return {
      name: " ",
    };
  },
  mounted() {
    axios
      .get("/api/user")
      .then((response) => {
        this.name = response.data.name;
        console.log(response);
      })
      .catch((error) => {
        console.log(error);
      });
  },

  methods: {
    logout() {
      axios
        .post("/api/logout")
        .then((response) => {
          this.$router.push({ name: "Home" });
          localStorage.removeItem("authenticated");
          this.$emit("updateSidebar");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

  <style scoped>
#backend-view {
  text-align: center;
  background-color: aliceblue;
  height: 100vh;
  padding-top: 15vh;
}

.logout {
  position: absolute;
  top: 30px;
  right: 40px;
}

.heading {
  margin-bottom: 5px;
}

.links {
  margin-top: 30px;
  margin-left: auto;
  margin-right: auto;
  background: white;
  max-width: 500px;
  padding: 15px;
  border-radius: 15px;
}

.links ul {
  list-style: none;
}

.links a {
  all: revert;
  font-size: 26px;
  display: inline-block;
  margin: 10px 0;
}
</style>