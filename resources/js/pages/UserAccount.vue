<template>
    <div>
        <link rel="stylesheet" href="/css/user.css" />
        <div class="main-container">
            <navbar />
            <div class="info-section container">
                <h4 class="text-center">Account Details</h4>
                <h3>Working on it</h3>
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
        };
    },
    created() {
        this.user = this.$store.state.user;
    },
    components: { navbar },
};
</script>

<style></style>
