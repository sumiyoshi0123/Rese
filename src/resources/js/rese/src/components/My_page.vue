<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import Header from './Header.vue';

//ユーザーのデータを取得
const user = ref('');
const shop = ref('');
const reserve = ref('');
const likes = ref([]);

const fetchReserve = async () => {
    const json = await axios.get("http://localhost/api/reserve")

    if (json.data.reserve) {
        // 予約情報
        reserve.value = json.data.reserve;
        // 予約しているshopの情報
        shop.value = json.data.reserve.shop;
    } else {
        console.log('Reservation not found.');
    }
}

const fetchLike = async () => {
    const json = await axios.get("http://localhost/api/like")
    likes.value = json.data.likes;
    console.log(likes.value);
}

// コンポーネントがマウントされた時にデータを取得
onMounted(async () => {
    const json = await axios.get("http://localhost/api/register");
    const loginUser = json.data.loginName;
    const userName = loginUser[0];
    user.value = userName['name'];

    fetchReserve();
    fetchLike();
});

// 予約削除機能
const cancel = async (reserveId) => {
    try {
        await axios.delete(`http://localhost/api/reserve/${reserveId}`);
        reserve.value = '';
        shop.value = '';
    } catch (error) {
        console.error('Error deleting reservation:', error);
    }
}

//Detail.vueへ
const router = useRouter();
const goToDetail = (shopId) => {
    router.push({ name: 'detail', params: { id: shopId } });
};

//お気に入り削除機能
const deleteLike = async (likeId) => {
    try {
        // サーバーにDELETEリクエストを送信してお気に入りを削除
        await axios.delete(`http://localhost/api/like/${likeId}`);
        // 成功したらlikesの値を更新して再描画
        await fetchLike();
    } catch (error) {
        console.error('Error deleting like:', error);
    }
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
                    <div class="reserve_menu">
                        <img class="reserve_icon" src="../img/clock.png"></img>
                        <p class="reserve_number">予約{{ reserve.id }}</p>
                        <button class="reserve_delete" @click="cancel(reserve.id)">
                            <img class="delete_icon" src="../img/multiply_circle.png" alt="Image Button"></img>
                        </button>
                    </div>
                    <table class="data_items">
                        <tr class="item">
                            <th class="item_title">Shop</th>
                            <td class="item_data">{{ shop.name }}</td>
                        </tr>
                        <tr class="item">
                            <th class="item_title">Date</th>
                            <td class="item_data">{{ reserve.date }}</td>
                        </tr>
                        <tr class="item">
                            <th class="item_title">Time</th>
                            <td class="item_data">{{ reserve.time }}</td>
                        </tr>
                        <tr class="item">
                            <th class="item_title">Number</th>
                            <td class="item_data">{{ reserve.number + '人' }}</td>
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
                            <div class="tag1">#{{ like.shop.area.name }}</div>
                            <div class="tag2">#{{ like.shop.category.name }}</div>
                        </div>
                        <div class="list_item-button" >
                            <button class="link-button" @click="goToDetail(shop.id)">詳しくみる</button>
                            <button class="like-button" @click="deleteLike(like.id)">
                                <img class="button_image" src="../img/r_heart.png" alt="Image Button">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</template>

<style>
.user_name{
    font-size: larger;
    font-weight: bold;
}
.user_item{
    display: flex;
}
.reserve_items{
    width: 40%;
    height: auto;
}
.reserve_title{
    font-weight: bold;
    margin-left: 20px;
    margin-bottom: 20px;
}
.reserve_data {
    margin-left: 20px;
    width: 80%;
    height: 250px;
    color: white;
    background-color: #4D7FFF;
    text-align: left;
}
.item {
    padding: 10px 0;
}
.item_title, .item_data {
    padding: 10px;
}
.reserve_menu{
    display: flex;
    align-items: center;
}
.reserve_icon{
    width: 20px;
    height: 20px;
    padding-left: 10px;
}
.reserve_number{
    padding-left: 20px;
}
.reserve_delete{
    border: none;
    background-color: 4D7FFF;
    text-align: right;
    margin-right: 20px;
    background-color: #4D7FFF;
}
.delete_icon{
    widows: 20px;
    height: 20px;
    cursor: pointer;
}



.like_data{
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 1100px;
    margin-left: 120px;
}
.like_title{
    font-weight: bold;
    margin-left: 10px;
    margin-bottom: 10px;
}
.like_list{
    display: flex;
    flex-wrap: wrap;
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
    cursor: pointer;
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