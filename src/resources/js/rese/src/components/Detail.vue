<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";

const shops = ref([
    {
        "id": 1,
        "name": "仙人",
        "area": "東京都",
        "category": "寿司",
        "detail": "料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。",
        "img_url": "https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg",
    },
]);

const date = ref('')

const time = ref('')

const number = ref('')

</script>

<template>
    <div class="menu"></div>
    <div class="shop_data">
        <button class="prev" @click="prev()"> ＜ </button>
        <div class="shop_name">{{ shops.name }}</div>
        <div class="shop_img">{{ shops.img_url }}</div>
        <div class="shop_tag">{{ shops.area }}{{ shops.category }}</div>
        <div class="shop_detail">{{ shops.detail }}</div>
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
                <td>{{ shops.name }}</td>
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
