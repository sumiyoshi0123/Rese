<script setup>
import { ref, computed } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

// 画像をインポート
import menuImageClosed from '../img/menu.png';
import menuImageOpen from '../img/multiply.png';

const router = useRouter();

//メニュー画面表示
const open = ref(false);

const menuImage = computed(() => open.value ? menuImageOpen : menuImageClosed);

const menuButton = () => {
    open.value = !open.value;
}

//ホーム画面へ
const home = () => {
    router.push({ name: "shop_all"})
}

//会員登録ページへ
const register = () => {
    router.push({ name: "register" });
}

//ログイン画面へ
const login = () => {
    router.push({ name: "login" });
}

//ログアウト
const logout = async () => {
    localStorage.removeItem('token');
    router.push({ name: "login" });
}

//マイページ画面へ
const myPage = () => {
    router.push({ name: "my_page" });
}

// ユーザーがログインしているかどうかを確認
const isLoggedIn = computed(() => {
    return !!localStorage.getItem('token');
});
</script>

<template>
    <div class="header">
        <button class="menu" @click="menuButton">
            <img class="menu_icon" :src="menuImage" alt="Menu Icon" />
        </button>
        <ul class="menu_item" v-if="open">
            <li class="item1" @click="home">Home</li>
            <li class="item2" v-if="!isLoggedIn" @click="register">Registration</li>
            <li class="item3" v-if="!isLoggedIn" @click="login">Login</li>
            <li class="item4" v-if="isLoggedIn" @click="logout">Logout</li>
            <li class="item5" v-if="isLoggedIn" @click="myPage">Mypage</li>
            </ul>
        <h1 class="name">Rese</h1>
    </div>
</template>

<style>
.header{
    display: flex;
    margin-left: 10px;
}
.menu{
    width: 30px;
    height: 30px;
    margin-top: 28px;
    background-color: #305DFF;
}
.menu_icon {
    width: 100%;
    height: 100%;
}
.menu_item {
    width: 100%;
    height: 100%;
    text-align: center;
    position: fixed;
    top: 60px;
    left: 0;
    background-color: white;
    list-style: none;
    color: #305DFF;
}
.item1, .item2, .item3, .item4, .item5{
    margin-bottom: 20px;
}
.name{
    margin-left: 20px;
    color: #305DFF;
}
</style>