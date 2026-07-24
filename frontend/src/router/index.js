import { createRouter, createWebHistory } from "vue-router";

import Products from "../views/Products.vue";
import Orders from "../views/Orders.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            redirect: "/products",
        },
        {
            path: "/products",
            component: Products,
        },
        {
            path: "/orders",
            component: Orders,
        },
    ],
});

export default router;