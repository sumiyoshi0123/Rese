<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();

//メニュー画面表示
const open = ref(false);
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
</script>

<template>
    <div class="header">
        <button class="menu" @click="menuButton"></button>
        <ul class="menu_item" v-if="open">
            <li class="item1" @click="home">Home</li>
            <li class="item2" @click="register">Registration</li>
            <li class="item3" @click="login">Login</li>
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
.item1, .item2, .item3{
    margin-bottom: 20px;
}
.name{
    margin-left: 20px;
    color: #305DFF;
}
</style>