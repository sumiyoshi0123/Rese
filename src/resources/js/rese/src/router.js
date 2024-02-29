import { createRouter, createWebHashHistory } from 'vue-router';
import Shop_all from './components/Shop_all.vue';

const routes = [
    {
        path: "/",
        name: "shop_all",
        component: Shop_all
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

export default router;
