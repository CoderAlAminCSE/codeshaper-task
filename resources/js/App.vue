<template>
    <div id="wrapper">
      <!-- sidebar -->
      <div class="sidebar">
        <span class="closeButton">&times;</span>
        <p class="brand-title"><a href="">Blog</a></p>

        <div class="side-links">
          <ul>
            <li><router-link :to="{ name: 'Home' }">Home</router-link></li>
            <li><router-link :to="{ name: 'Blog' }">Blog</router-link></li>
          </ul>
        </div>

        <!-- sidebar footer -->
        <footer class="sidebar-footer">
          <div>
            <a href=""><i class="fab fa-facebook-f"></i></a>
            <a href=""><i class="fab fa-instagram"></i></a>
            <a href=""><i class="fab fa-twitter"></i></a>
          </div>

          <small>&copy; 2023  Blog</small>
        </footer>
      </div>
      <!-- Menu Button -->
      <div class="menuButton">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
      <!-- main -->
      <main class="container">
        <router-view></router-view>
      </main>

      <!-- Main footer -->
      <footer class="main-footer">
        <div>
          <a href=""><i class="fab fa-facebook-f"></i></a>
          <a href=""><i class="fab fa-instagram"></i></a>
          <a href=""><i class="fab fa-twitter"></i></a>
        </div>
        <small>&copy; 2023 Blog</small>
      </footer>
    </div>
  </template>

  <script>

  </script>

  <style lang="scss" scoped>
  </style>