<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import Header from './Header.vue';

//ユーザーのデータを取得
const user = ref('')
const shop = ref('')
const reserve = ref('')
const likes = ref('')

const fetchUser = async () => {
    const json = await axios.get("http://localhost/api/register");
    const loginUser = json.data.loginName;
    const userName = loginUser[0];
    user.value = userName['name'];
};

const fetchReserve = async () => {
    const json = await axios.get("http://localhost/api/reserve")

    if (reserve !== null) {
        //予約情報
        reserve.value = json.data.reserve;
        //予約しているshopの情報
        shop.value = json.data.reserve.shop;
    } else {
        console.log('Reservation not found.');
    }
}

const fetchLike = async () => {
    const json = await axios.get("http://localhost/api/like")
    likes.value = json.data.like;
    console.log(json.data.like);
}

// コンポーネントがマウントされた時にデータを取得
onMounted(() => {
    fetchUser();
    fetchReserve();
    fetchLike();
});

// 予約削除機能
const reserveId = reserve.id;
const cancel = async () => {
    const json = await axios.delete(`http://localhost/api/reserve/${reserveId}`)
}

//Detail.vueへ
const goToDetail = (shopId) => {
    router.push({ name: 'detail', params: { id: shopId } });
};

</script>

<template>
    <Header />
    <main>
        <p class="user_name">{{ user }}さん</p>
        <div class="user_item">
            <div class="reserve_items">
                <div class="reserve_title">予約状況</div>
                <div class="reserve_data">
                    <p class="reserve_icon"></p>
                    <div class="reserve_menu">
                        <p>予約</p>
                        <button class="reserve_delete" @click="cancel(reserve.id)">
                        </button>
                    </div>
                    <table class="data_items">
                        <tr>
                            <th>Shop</th>
                            <td class="item">{{ shop.name }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td class="item">{{ reserve.date }}</td>
                        </tr>
                        <tr>
                            <th>Time</th>
                            <td class="item">{{ reserve.time }}</td>
                        </tr>
                        <tr>
                            <th>Number</th>
                            <td class="item">{{ reserve.number + '人' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="like_data">
                <div class="like_title">お気に入り店舗</div>
                <div class="like_list">
                    <div class="shop-list_item" v-for="like in likes" :key="like.id">
                        <div>
                            <img class="shop_image" :src="like.shop.img_url" alt="Image" />
                        </div>
                        <div class="list_item-name">{{ like.shop.name }}</div>
                        <div class="list_item-tag">
                            <div class="tag1">#{{ like.shop.area }}</div>
                            <div class="tag2">#{{ like.shop.category }}</div>
                        </div>
                        <div class="list_item-button" >
                                <button class="link-button" @click="goToDetail(shop.id)">詳しくみる</button>
                            <button class="like-button" @click="toggleLike(shop.id)">
                                <img v-if="like" class="button_image" src="../heart/w_heart.png" alt="Image Button">
                                <img v-else class="button_image" src="../heart/r_heart.png" alt="Image Button">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</template>

<style>
.user_item{
    display: flex;
}
.reserve_items{
    width: 60%;
}
.reserve_delete{
    width: 20px;
    height: 20px;
}
.reserve_menu{
    display: flex;
    align-items: center;
}


.like_data{
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 1100px;
    margin-left: 120px;
}
.like_list{
    display: flex;
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
    background-color: #305DFF;
    font-size: 12px;
    border-radius: 5px;
    margin: 5px;
}
.like-button{
    margin: 5px;
    border: none;
    background-color: white;
}
.button_image{
    border: none;
    padding: 0;
    background: none;
    cursor: pointer;
    width: 30px;
}
</style>