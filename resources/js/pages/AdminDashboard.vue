<template>
    <div>
        <link rel="stylesheet" href="/css/user.css" />
        <div class="main-container">
            <adminNavbar />
            <router-view></router-view>

            <div class="footer">
                <p>@copyright 2022 etiane</p>
            </div>
        </div>
    </div>
</template>

<script>
import adminNavbar from "../components/adminNavbar.vue";

export default {
    data() {
        return {};
    },
    components: { adminNavbar },
};
</script>

<style></style>
