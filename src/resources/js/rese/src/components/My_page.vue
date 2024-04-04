<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import Header from './Header.vue';

//ユーザーのデータを取得
const user = ref('')
const reserve = ref('')
const like = ref('')

const fetchUser = async () => {
    const json = await axios.get("http://localhost/api/register")
    user.value = json.data;
};

const fetchReserve = async () => {
    const json = await axios.get("http://localhost/api/reserve")
    reserve.value = json.data;
}

const fetchLike = async () => {
    const json = await axios.get("http://localhost/api/like")
    like.value = json.data;
}

// コンポーネントがマウントされた時にデータを取得
onMounted(() => {
    fetchUser();
    fetchReserve();
    fetchLike();
});

</script>

<template>
    <Header />
    <main>
        <p class="user_name">{{ user }}さん</p>
        <div class="user_item">
            <div class="reserve_data">

            </div>
            <div class="like_data">

            </div>
        </div>
    </main>

</template>