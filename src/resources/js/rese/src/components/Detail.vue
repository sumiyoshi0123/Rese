<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const shop = ref([])
const date = ref('')
const time = ref('')
const number = ref('')

onMounted(async () => {
    const json = await axios.get("http://localhost/api/detail/");
});

</script>

<template>
    <div class="menu"></div>
    <div class="shop_data">
        <button class="prev" @click="prev()"> ＜ </button>
        <div class="shop_name">{{ shop.name }}</div>
        <div class="shop_img">{{ shop.img_url }}</div>
        <div class="shop_tag">#{{ shop.area }}#{{ shop.category }}</div>
        <div class="shop_detail">{{ shop.detail }}</div>
    </div>
    <div class="reserve_form">
        <div class="form_title">予約</div>
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
        <table class="reserve_data">
            <tr>
                <th>shop</th>
                <td>{{ shop.name }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ date }}</td>
            </tr>
            <tr>
                <th>Time</th>
                <td>{{ time }}</td>
            </tr>
            <tr>
                <th>Number</th>
                <td>{{ number }}</td>
            </tr>
        </table>
        <button type="button" class="reserve_button" @click="submit">予約する</button>
    </div>
</template>
