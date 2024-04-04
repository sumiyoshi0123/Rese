<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import Header from './Header.vue';

const router = useRouter();

//ホーム画面へ
const back = () => {
    router.push({ name: "shop_all" });
}
</script>

<template>
    <Header />
    <main>
        <div class="thanks_item">
            <div class="item_message">ご予約ありがとうございます</div>
            <button class="item_button" @click="back()">戻る</button>
        </div>
    </main>
</template>

<style>
.thanks_item{
    width: 30%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: white;
    box-shadow: 2px 2px 10px 0px gray;
    border-radius: 5px;
}
.item_button{
    color: white;
    background-color: #305DFF;
}
</style>