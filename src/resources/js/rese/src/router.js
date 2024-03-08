import { createRouter, createWebHashHistory } from 'vue-router';
import Shop_all from './components/Shop_all.vue';
import Detail from './components/Detail.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Thanks from './components/Thanks.vue';
import My_page from './components/My_page.vue';

const routes = [
    {
        path: "/",
        name: "shop_all",
        component: Shop_all
    },
    {
        path: "/detail/{id}",
        name: "detail",
        component: Detail,
        props: true // パラメータをコンポーネントのプロパティとして渡すために必要
    },
    {
        path: "/login",
        name: "login",
        component: Login
    },
    {
        path: "/register",
        name: "register",
        component: Register
    },
    {
        path: "/thanks",
        name: "thanks",
        component: Thanks
    },
    {
        path: "/my_page",
        name: "my_page",
        component: My_page
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

export default router;
