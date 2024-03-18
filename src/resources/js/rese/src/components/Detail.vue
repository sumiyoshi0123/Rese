<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import Header from './Header.vue';

const shop = ref([])
const shopId = ref('')
const date = ref('')
const time = ref('')
const number = ref('')
const router = useRouter();

const fetchShops = (async () => {
    const json = await axios.get("http://localhost/api/shop/", {
        params: {
            shopId: shopId.value
        }
    });
    const data = json.data;
    shop.value = data.data;
    console.log(data);
});

onMounted(async () => {
    (fetchShops());
})
//const prevは何をする機能？

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
                    <option>1人</option>
                    <option>2人</option>
                    <option>3人</option>
                    <option>4人</option>
                    <option>5人</option>
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
                        <td class="item">{{ number }}</td>
                    </tr>
                </table>
            </div>
            <button type="button" class="reserve_button" @click="submit">予約する</button>
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
