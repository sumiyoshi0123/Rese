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

const router = useRouter();
//詳細ページに移動する
const detail = async () => {
    router.push({ name: "detail" });
}

</script>

<template>
    <header>
        <div class="menu"></div>
        <div class="search"></div>
    </header>
    <main>
        <div class="shop_item" v-for="shop in shops">
            <div>{{ shop.img_url }}</div>
            <div>{{ shop.name }}</div>
            <div>{{ shop.area }}</div>
            <div>{{ shop.category }}</div>
            <button class="detail" @click="detail()">詳しくみる</button>
            <button></button>
        </div>
    </main>
</template>
