<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import Header from './Header.vue';

const shops = ref()
const router = useRouter()

onMounted(async () => {
    const json = await axios.get("http://localhost/api/shop");
    const data = json.data;
    shops.value = data.data;

    const likeShops = await axios.get("http://localhost/api/like");
    const like = likeShops.data.like;

    // ログインユーザーのお気に入り情報をshops配列に反映する
    shops.value.forEach(shop => {
        // ログインユーザーのお気に入りに含まれているかを判定するフラグ
        let isLiked = false;

        // like配列内の各オブジェクトのshop_idと比較して、お気に入りに含まれているかを判定する
        like.forEach(item => {
            if (item.shop_id === shop.id) {
                isLiked = true;
            }
        });

        // お気に入りに含まれている場合、shop.likeをtrueに設定する
        shop.like = isLiked;
        console.log(shop.like);
    });
});

//Detail.vueへ
const goToDetail = (shopId) => {
    router.push({ name: 'detail', params: { id: shopId } });
};

//お気に入り登録機能
const like = ref({});

const toggleLike = async (shop_id) => {
    const shop = shops.value.find(s => s.id === shop_id);
    //shops配列の中からidが指定されたshop_idと一致する要素を探す

    if (shop) {
    //特定のshop_idに対応するショップがshops配列内で見つかった場合

        const newLikeState = !shop.like;
        //shop.likeがtrueであればfalseに、falseであればtrue

        shop.like = newLikeState;
        //shopオブジェクトのlikeプロパティに新しい状態を代入して特定のショップのお気に入りの状態を更新

        const json = await axios.post('http://localhost/api/like', {
            shop_id: shop_id,
            like: newLikeState
        });
        //更新されたお気に入りの状態をサーバーに送信

    }
}

</script>

<template>
    <header class="header_item">
        <Header />
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
            <div class="shop-list_item" v-for="shop in shops" :key="shop.id">
                <div>
                    <img class="shop_image" :src="shop.img_url" alt="Image" />
                </div>
                <div class="list_item-name">{{ shop.name }}</div>
                <div class="list_item-tag">
                    <div class="tag1">#{{ shop.area }}</div>
                    <div class="tag2">#{{ shop.category }}</div>
                </div>
                <div class="list_item-button" >
                        <button class="link-button" @click="goToDetail(shop.id)">詳しくみる</button>
                    <button class="like-button" @click="toggleLike(shop.id)">
                        <img v-if="shop.like" class="button_image" src="../heart/r_heart.png" alt="Image Button">
                        <img v-else class="button_image" src="../heart/w_heart.png" alt="Image Button">
                    </button>
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

.search_form{
    display: flex;
    height: 30px;
    width: 250px;
    padding-right: 100px;
}

/* main */
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