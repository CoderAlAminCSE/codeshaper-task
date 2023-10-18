
<template>
  <div class="categories-list">
    <h1>Posts List</h1>
    <div class="item" v-for="(post, index) in posts" :key="post.id">
      {{ index + 1 }}.
      <p>{{ post.title }}</p>
      <div>
        <router-link :to="{ name: 'EditPost', params: { id: post.id } }"
          >Edit</router-link
        >
      </div>
      <input type="submit" @click="destroy(post.id)" value="Delete" />
    </div>
    <div class="index-categories">
      <router-link :to="{ name: 'CreatePost' }">
        Create Posts<span>&#8594;</span></router-link
      >
    </div>
  </div>
</template>

  <script>
export default {
  data() {
    return {
      posts: [],
    };
  },

  methods: {
    destroy(id) {
      axios
        .delete("/api/post/delete/" + id)
        .then((response) => {
          axios
            .get("/api/post/index")
            .then((response) => {
              this.posts = response.data;
            })
            .catch((error) => {
              console.log(error);
            });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  mounted() {
    axios
      .get("/api/post/index")
      .then((response) => {
        this.posts = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>


  <style scoped>
.categories-list {
  min-height: 100vh;
  background: #fff;
}

.categories-list h1 {
  font-weight: 300;
  padding: 50px 0 30px 0;
  text-align: center;
}
.categories-list .item {
  display: flex;
  justify-content: right;
  align-items: center;
  max-width: 300px;
  margin: 0 auto !important;
}

.categories-list .item p {
  font-size: 16px;
}
.categories-list .item p,
.categories-list .item div,
.categories-list .item {
  margin: 15px 8px;
}

.categories-list .item div a {
  padding: 6px 20px;
  background-color: #4caf50;
  color: #fff;
  font-size: 14px;
  display: inline-block;
}

.categories-list .item input {
  padding: 6px 13px;
  background-color: red;
  color: #fff;
  border: none;
  font-size: 16px;
  cursor: pointer;
  font-size: 14px;
}

.categories ul li {
  list-style: none;
  background-color: #494949;
  margin: 20px 5px;
  border-radius: 15px;
}

.categories ul {
  display: flex;
  justify-content: center;
}

.categories a {
  color: white;
  padding: 10px 20px;
  display: inline-block;
}
.create-categories a,
.index-categories a {
  all: revert;
  margin: 20px 0;
  display: inline-block;
  text-decoration: none;
}
.create-categories a span,
.index-categories a span {
  font-size: 22px;
}

.index-categories {
  text-align: center;
}
</style>