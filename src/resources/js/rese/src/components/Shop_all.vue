<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const shops = ref([]);
const image = ref('');

onMounted(async () => {
    const json = await axios.get("http://localhost/api/");
    const data = json.data;
    shops.value = data.data;
});

const open = ref(false);
const menuButton = () => {
    open.value = !open.value;
};

// const router = useRouter();
// //詳細ページに移動する
// const detail = async () => {
//     router.push({ name: "detail", params: { id: shop.id } });
// }

</script>

<template>
    <header class="header_item">
        <div class="header_item-left">
            <button class="menu" @click="menuButton"></button>
            <ul class="menu_item" v-if="open">
                <li class="item1">Home</li>
                <li class="item2">Registration</li>
                <li class="item3">Login</li>
            </ul>
            <h1 class="name">Rese</h1>
        </div>
        <div class="header_item-right">
            <form class="search_form">
                <select class="search_area">
                    <option>All area</option>
                    <option>東京都</option>
                    <option>大阪府</option>
                    <option>福岡県</option>
                </select>
                <select class="search_category">
                    <option>All category</option>
                    <option>寿司</option>
                    <option>焼肉</option>
                    <option>居酒屋</option>
                    <option>イタリアン</option>
                    <option>ラーメン</option>
                </select>
                <input class="search_word" value="Search ...">
            </form>
        </div>
    </header>
    <main>
        <div class="shop-list">
            <div class="shop-list_item" v-for="shop in shops">
                <div>
                    <img class="shop_image" :src="shop.img_url" alt="Image" />
                </div>
                <div class="list_item-name">{{ shop.name }}</div>
                <div class="list_item-tag">
                    <div class="tag1">#{{ shop.area }}</div>
                    <div class="tag2">#{{ shop.category }}</div>
                </div>
                <div class="list_item-button">
                    <router-link :to="{ name: 'detail', params: { id: shop.id } }">
                        <button class="link-button">詳しくみる</button>
                    </router-link>
                    <button class="like-button" @click="like()"></button>
                </div>
            </div>
        </div>
    </main>
</template>

<style>
.header_item{
    display: flex;
    justify-content: space-between;
    width: 1100px;
    margin-left: 120px;
    align-items: center;
}
.header_item-left{
    display: flex;
    margin-left: 10px;
}
.menu{
    width: 30px;
    height: 30px;
    margin-top: 28px;
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
    color: royalblue;
}
.item1, .item2, .item3{
    margin-bottom: 20px;
}
.name{
    margin-left: 20px;
    color: royalblue;
}
.search_form{
    display: flex;
    height: 30px;
    width: 250px;
    padding-right: 100px;
}
.shop-list{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    width: 1100px;
    margin-left: 120px;
}
.shop-list_item{
    width: 250px;
    height: auto;
    box-shadow: 2px 2px 10px 0px gray;
    margin: 8px;
    border-radius: 5px;
    background-color: white;
}
.shop_image{
    width: 250px;
    height: auto;
    border-radius: 5px 5px 0px 0px;
}
.list_item-name{
    font-weight: bold;
    margin: 5px;
}
.list_item-tag{
    display: flex;
    font-size: 12px;
    margin: 5px;
}
.list_item-button{
    display: flex;
    justify-content: space-between;
}
.link-button{
    color: white;
    background-color: royalblue;
    font-size: 12px;
    border-radius: 5px;
    margin: 5px;
}
.like-button{
    margin: 5px;
}
</style>