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
            <div class="register_form-title">Registration</div>
            <div class="from_item">
                <div class="form_item-name">
                    <div class="name-img">
                    </div>
                    <input type="text" class="item-name" placeholder="Username">
                </div>
                <div class="form_item-email">
                    <div class="email-img">
                    </div>
                    <input type="text" class="item-email" placeholder="Email">
                </div>
                <div class="form_item-pass">
                    <div class="pass-img">
                    </div>
                    <input type="text" class="item-pass" placeholder="Password">
                </div>
                <button class="from_item-button" @click="register()">登録</button>
            </div>
        </div>
    </main>
</template>

<style>
.register_from{
    width: 220px;
}
.register_form-title{
    color: white;
    background-color: #305DFF;
    width: 100%;
    padding: 10px 0px;
}
.form_item{
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: white;
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