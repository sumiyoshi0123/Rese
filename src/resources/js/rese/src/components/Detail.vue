<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter, useRoute } from "vue-router";
import Header from './Header.vue';

const shop = ref('')
const date = ref('')
const time = ref('')
const number = ref('')
const options = [
    { value: '1', text: '1人' },
    { value: '2', text: '2人' },
    { value: '3', text: '3人' },
    { value: '4', text: '4人' },
    { value: '5', text: '5人' }
];
// value は実際の値、text はオプションの表示テキスト

const router = useRouter();
const route = useRoute();


onMounted(async () => {
    const id = route.params.id;
    const json = await axios.get(`http://localhost/api/shop/${id}`);
    shop.value = json.data.data;
});

//shop_all.vueに戻る
const prev = () => {
    router.push({ name: "shop_all"})
}

//予約機能
const reserve = async (shop_id) => {
    const json = await axios.post("http://localhost/api/reserve/", {
        shop_id: shop_id,
        date: date.value,
        time: time.value,
        number: number.value,
    });
    router.push({ name: "done"})
}

</script>

<template>
    <Header />
    <main class="detail_index">
        <div class="shop_data">
            <div class="shop_data-item">
                <button class="prev" @click="prev()"> ＜ </button>
                <div class="data_item-name">{{ shop.name }}</div>
            </div>
            <img class="data_image" :src="shop.img_url" alt="Image" />
            <div class="data_tag">#{{ shop.area }}#{{ shop.category }}</div>
            <div class="data_detail">{{ shop.detail }}</div>
        </div>
        <div class="reserve_form">
            <div class="form_title">予約</div>
            <div class="select_item">
                <input type="date" class="reserve_date" v-model="date">
                <select class="reserve_time" v-model="time">
                    <option disabled value="">予約時間</option>
                    <option>17:00</option>
                    <option>18:00</option>
                    <option>19:00</option>
                    <option>20:00</option>
                    <option>21:00</option>
                    <option>22:00</option>
                </select>
                <select class="reserve_number" v-model="number">
                    <option disabled value="">予約人数</option>
                    <option v-for="option in options" :key="option.value" :value="option.value">{{ option.text }}</option>
                </select>
            </div>
            <div class="reserve_data">
                <table class="data_items">
                    <tr>
                        <th>Shop</th>
                        <td class="item">{{ shop.name }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td class="item">{{ date }}</td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td class="item">{{ time }}</td>
                    </tr>
                    <tr>
                        <th>Number</th>
                        <td class="item">{{ number ? number + '人' : '' }}</td>
                        <!-- 三項演算子で選択された値に’人’を追加し、選択されていない場合は何も表示しない -->
                    </tr>
                </table>
            </div>
            <button class="reserve_button" @click="reserve(shop.id)">予約する</button>
        </div>
    </main>
</template>

<style>
.detail_index{
    display: flex;
}
.shop_data{
    display: flex;
    flex-direction: column;
    width: 50%;
}
.shop_data-item{
    display: flex;
}
.data_item-name{
    margin-left: 10px;
    font-size: large;
    font-weight: bold;
}
.data_image{
    width: 80%;
    margin-top: 20px;
}
.data_tag{
    display: inline-block;
    margin: 20px 0px;
}
.data_detail{
    width: 80%;
}
.reserve_form{
    width: 30%;
    background-color: #305DFF;
}
.form_title{
    padding: 25px 0px 20px 20px;
    color: white;
    font-weight: bold;
}
.select_item{
    padding-left: 20px;
    display: flex;
    flex-direction: column;
    border-radius: 5px;
}
.reserve_date{
    border-radius: 5px;
    margin-bottom: 10px;
    width: 40%;
}
.reserve_time{
    border-radius: 5px;
    margin-bottom: 10px;
    width: 90%;
}
.reserve_number{
    border-radius: 5px;
    margin-bottom: 10px;
    width: 90%;
}
.reserve_data{
    margin-left: 20px;
    width: 80%;
    color: white;
    background-color: #4D7FFF;
    text-align: left;
}
.data_items{
    padding: 10px;
}
.item{
    padding-left: 20px;
}
.reserve_button{
    width: 100%;
    padding: 10px;
    margin-top: 250px;
    color: white;
    background-color: #0538FF;
}
</style>
