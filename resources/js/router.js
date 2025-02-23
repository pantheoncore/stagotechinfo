import { createRouter, createWebHistory } from "vue-router";

import Home from "./views/Home.vue";
import Dashboard from "./views/Dashboard.vue";
import NotFound from "./views/NotFound.vue";

import SystemsOverview from "./views/System.vue";

const routes = [
    {
        // Catch all for routes that do not exist
        path: "/:catchAll(.*)",
        name: "NotFound",
        component: NotFound,
    },
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/a",
        beforeEnter: validateAccessToken,
        // restricted views that required authentication to enter
        children: [
            {
                path: "dashboard",
                name: "Dashboard",
                component: Dashboard
            },
            {
                path: "systems/overview/:id",
                name: "System Overview",
                component: SystemsOverview
            }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

async function validateAccessToken(to, from, next) {
    // Set app in window so that router can access it
    const app = window.stago_app.config.globalProperties;
    const valid = await app.$session.validate()
    
    valid ? next() : next({name: "Home", query: {then: to.path}});
}

export default router