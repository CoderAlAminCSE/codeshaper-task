<template>
  <div id="backend-view">
    <form @submit.prevent="login">
      <h3>Login here</h3>
      <label for="email">Email</label>
      <input type="text" id="email" v-model="fields.email" />
      <span v-if="errors.email" class="error"> {{ errors.email[0] }} </span>

      <label for="password">Password</label>
      <input type="text" id="password" v-model="fields.password" />
      <span v-if="errors.password" class="error">
        {{ errors.password[0] }}
      </span>

      <button type="submti">Log In</button>
      <span>Don't have an account? <a href="">Sing Up</a> </span>
    </form>
  </div>
</template>

  <script>
export default {
  data() {
    return {
      fields: {},
      errors: {},
    };
  },

  methods: {
    login() {
      axios
        .post("/api/login", this.fields)
        .then(() => {
          this.$router.push({ name: "Dashboard" });
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>

  <style scoped>
#backend-view {
  height: 100vh;
  background-color: #f3f4f6;
  display: grid;
  align-items: center;
}
form {
  width: 400px;
  background-color: #ffffff;
  margin: 0 auto;
  border-radius: 10px;
  border: 2px solid rgba(255, 255, 255, 0.1);
  padding: 5px 35px;
}

form * {
  letter-spacing: 0.5px;
  outline: none;
}

label {
  display: block;
  margin-top: 20px;
  font-size: 16;
  font-weight: 500;
}

input {
  display: block;
  height: 50px;
  width: 100%;
  border-radius: 3px;
  padding: 0 10px;
  margin-top: 8px;
  font-size: 16px;
  font-weight: 500;
}

button {
  margin-top: 50px;
  width: 100%;
  background-color: blue;
  color: #ffffff;
  padding: 15px 0;
  font-size: 18px;
  font-weight: 600;
  border-radius: 5px;
  cursor: pointer;
}

form span {
  display: block;
  margin-top: 35px;
}

a {
  color: blue;
}
</style>