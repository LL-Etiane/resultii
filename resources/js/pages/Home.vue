<template>
    <div v-if="loading"><loading /></div>
    <div class="container">
        <div class="home-container">
            <div class="home-container__caption">
                <h1>Resultii</h1>
                <h2>Get your results fast and in an easy way</h2>
                <router-link :to="{ name: 'About' }">About</router-link>
            </div>

            <div class="home-container__auth">
                <div v-if="!showRegister">
                    <Login v-on:changeAuthForm="showRegister = true" />
                </div>
                <div v-if="showRegister">
                    <Register v-on:changeAuthForm="showRegister = false" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapMutations, mapState } from "vuex";
import Login from "../components/login.vue";
import Register from "../components/register.vue";
import loading from "../components/loading.vue";
export default {
    data() {
        return {
            name: "etiane",
            showRegister: false,
            loading: false,
        };
    },
    components: { Login, Register, loading },
    computed: {
        ...mapState(["user"]),
    },
    methods: {},
};
</script>

<style></style>
