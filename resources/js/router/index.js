import { createRouter, createWebHistory } from 'vue-router'

import HomePage from '../pages/Home.vue'
import BlogPage from '../pages/Blog.vue'
import SingleBlogPage from '../pages/SingleBlog.vue'
import LoginPage from '../pages/Login.vue'
import RegisterPage from '../pages/Register.vue'
import DashboardPage from '../pages/Dashboard.vue'
import CreatePost from '../pages/posts/CreatePost.vue'

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
        {
            path: '/login',
            name: 'Login',
            component: LoginPage,
            meta: { requiresGuest: true }
        },
        {
            path: '/register',
            name: 'Register',
            component: RegisterPage,
            meta: { requiresGuest: true }
        },
        {
            path: '/dashboard',
            name: 'Dashboard',
            component: DashboardPage,
            meta: { requiresAuth: true }
        },
        {
            path: '/create/post',
            name: 'CreatePost',
            component: CreatePost,
            meta: { requiresAuth: true }
        },

    ]
});

router.beforeEach((to, from) => {
    const authenticated = localStorage.getItem('authenticated')

    if (to.meta.requiresGuest && authenticated) {
        return {
            name: "Dashboard"
        }
    } else if (to.meta.requiresAuth && !authenticated) {
        return {
            name: "Login"
        }
    }
});

export default router


