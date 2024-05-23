<script setup>
import { ref, onMounted, watch } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import Header from './Header.vue';

const shops = ref([]);
const router = useRouter();

onMounted(async () => {
    const json = await axios.get("http://localhost/api/shop");
    const data = json.data;
    shops.value = data.shopData;
    areas.value = data.areaData;
    categories.value = data.categoryData;

    // 初期表示時に全てのショップを表示する
    searchedShops.value = shops.value;
    //console.log(shops.value)

    const likeShops = await axios.get("http://localhost/api/like");
    const like = likeShops.data.likes;
    //console.log(like);

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

//検索機能

//データを格納するための変数
const selectedArea = ref('');
const selectedCategory = ref('');
const areas = ref([]);
const categories = ref([]);
const searchedShops = ref([]);
const searchKeyword = ref('');

watch([selectedArea, selectedCategory, searchKeyword], () => {
    filterShops();
});

const filterShops = () => {
    let filtered = shops.value;
    if (selectedArea.value) {
        filtered = filtered.filter(shop => shop.area.id === selectedArea.value);
    }
    if (selectedCategory.value) {
        filtered = filtered.filter(shop => shop.category.id === selectedCategory.value);
    }
    if (searchKeyword.value) {
        const keyword = searchKeyword.value.toLowerCase();
        filtered = filtered.filter(shop => shop.name.toLowerCase().includes(keyword));
    }
    searchedShops.value = filtered.length > 0 ? filtered : shops.value;
};
</script>

<template>
    <header class="header_item">
        <Header />
        <div class="header_item-right">
            <form class="search_form">
                <select class="search_area" v-model="selectedArea">
                    <option value="">All area</option>
                    <option v-for="area in areas" :key="area.id" :value="area.id">{{ area.name }}</option>
                </select>
                <select class="search_category" v-model="selectedCategory">
                    <option value="">All category</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                </select>
                <div class="search_input">
                    <img class="search_icon" src="../img/search.png" alt="Image" />
                    <input class="search_Keyword" placeholder="Search ..." v-model="searchKeyword">
                </div>
            </form>
        </div>
    </header>
    <main>
        <div class="shop-list">
            <div class="shop-list_item" v-for="shop in searchedShops" :key="shop.id">
                <div>
                    <img class="shop_image" :src="shop.img_url" alt="Image" />
                </div>
                <div class="list_item-name">{{ shop.name }}</div>
                <div class="list_item-tag">
                    <div class="tag1">#{{ shop.area.name }}</div>
                    <div class="tag2">#{{ shop.category.name }}</div>
                </div>
                <div class="list_item-button" >
                        <button class="link-button" @click="goToDetail(shop.id)">詳しくみる</button>
                    <button class="like-button" @click="toggleLike(shop.id)">
                        <img v-if="shop.like" class="button_image" src="../img/r_heart.png" alt="Image Button" />
                        <img v-else class="button_image" src="../img/w_heart.png" alt="Image Button" />
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
.search_input {
    position: relative;
    display: inline-block;
}
.search_icon {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    width: 20px;
    height: 20px;
}
.search_Keyword {
    height: 25px;
    padding-left: 40px;
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