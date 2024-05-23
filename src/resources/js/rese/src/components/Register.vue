<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import Header from './Header.vue';

const name = ref("");
const email = ref("");
const password = ref("");
const router = useRouter();

const register = async () => {
    const json = await axios.post("http://localhost/api/register", {
        name: name.value,
        email: email.value,
        password: password.value
    });
    router.push({ name: "thanks" });
}

</script>

<template>
    <Header />
    <main>
        <div class="register_from">
            <div class="form-title">
                <p class="form-title_item">Registration</p>
            </div>
            <div class="from_item">
                <div class="name_form">
                    <img class="user_icon" src="../img/person_alt.png" alt="User Icon" />
                    <input type="text" v-model="name" class="item-name" placeholder="Username">
                </div>
                <div class="email_form">
                    <img class="email_icon" src="../img/email.png" alt="Email Icon" />
                    <input type="text" v-model="email" class="item-email" placeholder="Email">
                </div>
                <div class="pass_form">
                    <img class="pass_icon" src="../img/lock.png" alt="Pass Icon" />
                    <input type="password" class="item-pass" v-model="password" placeholder="Password">

                </div>
                <button class="from_item-button" @click="register">登録</button>
            </div>
        </div>
    </main>
</template>

<style>
.register_from{
    width: 250px;
    margin-left: 500px;
    box-shadow: 2px 2px 10px 0px gray;
}
.form-title{
    color: white;
    background-color: #305DFF;
    padding: 2px 0px;
}
.form-title_item{
    margin-left: 5px;
}
.form_item{
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: white;
}
.name_form, .email_form, .pass_form{
    display: flex;
}
.user_icon, .email_icon, .pass_icon{
    width: 20px;
    height: 20px;
    margin-top: 10px;
    padding-left: 10px;
}
.item-name, .item-email, .item-pass{
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