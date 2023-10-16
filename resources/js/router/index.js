import { createRouter, createWebHistory } from 'vue-router'

import HomePage from '../pages/Home.vue'
import BlogPage from '../pages/Blog.vue'
import SingleBlogPage from '../pages/SingleBlog.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'Home',
            component: HomePage
        },
        {
            path: '/blog',
            name: 'Blog',
            component: BlogPage
        },
        {
            path: '/blog/:slug',
            name: 'SingleBlog',
            component: SingleBlogPage,
            props: true,
        },

    ]
});

export default router


