<template>
    <div>
        <link rel="stylesheet" href="/css/user.css" />
        <div class="main-container">
            <navbar />
            <div class="info-section container">
                <h4 class="text-center">List of results available</h4>
                <div class="results-list">
                    <div
                        class="result"
                        v-for="result in results"
                        :key="result.key"
                    >
                        <router-link to="/user/{{result.name}}">{{
                            result.name
                        }}</router-link>
                    </div>
                </div>
            </div>

            <div class="footer">
                <p>@copyright 2022 etiane</p>
            </div>
        </div>
    </div>
</template>

<script>
import navbar from "../components/navbar.vue";

export default {
    data() {
        return {
            user: {},
            results: [],
        };
    },
    created() {
        this.user = this.$store.state.user;
        axios
            .get("/api/results")
            .then((data) => {
                this.results = data.data;
            })
            .catch((error) => {
                console.log(error);
            });
    },
    components: { navbar },
};
</script>

<style></style>
