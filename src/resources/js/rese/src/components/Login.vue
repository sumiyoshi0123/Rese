<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import Header from './Header.vue';

const email = ref("");
const password = ref("");
const router = useRouter();

const login = async () => {
    const json = await axios.post("http://localhost/api/login", {
        email: email.value,
        password: password.value
    });
    console.log(json.data.token);
    const token = json.data.token;
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
    localStorage.setItem("token", token);
    router.push({ name: "my_page"}); //ログイン後はmy_page.vueへ移動
}

</script>

<template>
    <Header />
    <main>
        <div class="login_form">
            <div class="login_form-title">Login</div>
            <div class="form_item">
                <input type="text" class="item-email" v-model="email" placeholder="Email">
                <input type="text" class="item-pass" v-model="password" placeholder="Password">
                <button class="from_item-button"  @click="login()">ログイン</button>
            </div>
        </div>
    </main>
</template>

<style>
.login_form{
    width: 220px;
}
.login_form-title{
    color: white;
    background-color: #305DFF;
    width: 100%;
    padding: 10px 0px;
}
.from_item{
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: white;
}
.item-email, .item-pass{
    border: none;
    border-bottom: 1px solid #000;
    outline: none;
    margin: 10px;
    width: 70%;
}
.from_item-button{
    width: 35%;
    color: white;
    background-color: #305DFF;
    margin-left: 130px;
    border-radius: 5px;
}
</style>