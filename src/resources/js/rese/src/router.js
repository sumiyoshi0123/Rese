import { createRouter, createWebHashHistory } from 'vue-router';
import Shop_all from './components/Shop_all.vue';
import Detail from './components/Detail.vue';

const routes = [
    {
        path: "/",
        name: "shop_all",
        component: Shop_all
    },
    {
        path: "/detail/:id",
        name: "detail",
        component: Detail,
        props: true // パラメータをコンポーネントのプロパティとして渡すために必要
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

export default router;
