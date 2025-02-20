import { createRouter, createWebHistory } from "vue-router";

import Home from "./views/Home.vue";

const routes = [
    // {
    //     // Catch all for routes that do not exist
    //     path: "/:catchAll(.*)",
    //     name: "NotFound",
    //     component: NotFound,
    // },
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    // {
    //     // restricted view that required authentication to enter
    //     path: "/dashboard",
    //     name: "Dashboard",
    //     component: Dashboard,
    //     beforeEnter: validateAccessToken,
    // },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

async function validateAccessToken(to, from, next) {
    next();
}

export default router