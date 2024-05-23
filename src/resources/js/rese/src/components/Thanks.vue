<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import Header from './Header.vue';

const router = useRouter();

//ログイン画面へ
const login = () => {
    router.push({ name: "login" });
}
</script>

<template>
    <Header />
    <main>
        <div class="thanks_item">
            <div class="item_message">会員登録ありがとうございます</div>
            <button class="item_button" @click="login()">ログインする</button>
        </div>
    </main>
</template>

<style>
.thanks_item{
    width: 20%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: white;
    box-shadow: 2px 2px 10px 0px gray;
    border-radius: 5px;
}
.item_message{
    height: 60px;
    margin-top: 50px;
}
.item_button{
    width: 36%;
    margin-bottom: 50px;
    color: white;
    background-color: #305DFF;
}
</style>