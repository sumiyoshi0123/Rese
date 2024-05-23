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
            <div class="form-title">
                <p class="form-title_item">Login</p>
            </div>
            <div class="form_item">
                <div class="email_form">
                    <img class="email_icon" src="../img/email.png" alt="Email Icon" />
                    <input type="text" class="item-email" v-model="email" placeholder="Email">
                </div>
                <div class="pass_form">
                    <img class="pass_icon" src="../img/lock.png" alt="Pass Icon" />
                    <input type="text" class="item-pass" v-model="password" placeholder="Password">
                </div>
                <button class="from_item-button"  @click="login()">ログイン</button>
            </div>
        </div>
    </main>
</template>

<style>
.login_form{
    width: 250px;
    margin-left: 500px;
    box-shadow: 2px 2px 10px 0px gray;
}
.form-title{
    color: white;
    background-color: #305DFF;
    padding: 20px 0px;
}
.form-title_item{
    margin-left: 5px;
}
.from_item{
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: white;
}
.email_form, .pass_form{
    display: flex;
}
.email_icon, .pass_icon{
    width: 20px;
    height: 20px;
    margin-top: 10px;
    padding-left: 10px;
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