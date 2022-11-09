import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: "/",
      component: () => import("../views/Home"),
      children: [
        {
          path: "",
          name: "home",
          component: () => import("../views/HomeGlobal")
        },
        {
          path: "my-feed",
          name: "home-my-feed",
          component: () => import("../views/HomeMyFeed")
        },
        {
          path: "tag/:tag",
          name: "home-tag",
          component: () => import("../views/HomeTag")
        }
      ]
    },
    {
      name: "login",
      path: "/login",
      component: () => import("../views/Login")
    },
    {
      name: "register",
      path: "/register",
      component: () => import("../views/Register")
    },
    {
      name: "settings",
      path: "/settings",
      component: () => import("../views/Settings")
    },
    // Handle child routes with a default, by giving the name to the
    // child.
    // SO: https://github.com/vuejs/vue-router/issues/777
    {
      path: "/@:username",
      component: () => import("../views/Profile"),
      children: [
        {
          path: "",
          name: "profile",
          component: () => import("../views/ProfileArticles")
        },
        {
          name: "profile-favorites",
          path: "favorites",
          component: () => import("../views/ProfileFavorited")
        }
      ]
    },
    {
      name: "article",
      path: "/articles/:slug",
      component: () => import("../views/Article"),
      props: true
    },
    {
      name: "article-edit",
      path: "/editor/:slug?",
      props: true,
      component: () => import("../views/ArticleEdit")
    }
  ]
});


// import Vue from 'vue'
// import VueRouter from 'vue-router'
// import Home from '../views/Home.vue'

// Vue.use(VueRouter)

// const routes = [
//   {
//     path: '/',
//     name: 'Home',
//     component: Home,
//     meta:{
// layout:'AppLayoutHome'
//     }
//   },
//   {
//     path: '/test',
//     name: 'Test',
//     component: () => import('../views/Home.vue')
//   },
//   {
//     path: '/about',
//     name: 'About',
//     meta: {
//       layout: 'AppLayoutAbout'
//     },
//     // route level code-splitting
//     // this generates a separate chunk (about.[hash].js) for this route
//     // which is lazy-loaded when the route is visited.
//     component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
//   }
// ]

// const router = new VueRouter({
//   mode: 'history',
//   base: process.env.BASE_URL,
//   routes
// })

// export default router
