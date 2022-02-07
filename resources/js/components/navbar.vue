<template>
    <header class="pt-4 pb-5">
            <div class="top-nav container">
                <div class="logo">Resultii</div>
                <div class="navs">
                    <p>{{user.user.name}} <button class="btn btn btn-sm logout-btn" @click="logout">logout</button></p>
                </div>
            </div>
            <div class="bottom-nav container">
                <nav>
                    <ul>
                        <router-link :to="{name: 'UserDashboard'}" tag="li" active-class="active">Home</router-link>
                        <router-link :to="{name: 'UserAccount'}" tag="li" active-class="active">Account</router-link>
                    </ul>
                </nav>
            </div>
        </header>
</template>

<script>
export default {
    data(){
        return {
            user: this.$store.state.user
        }
    },

    methods: {
        logout(){
            axios.post('/api/logout')
            this.$store.commit('setUser',{})
            window.axios.defaults.headers.common['Authorization'] = `Bearer `
            this.$router.push({name: 'Home'})
            console.log("done")
        }
    }
}
</script>

<style>
    .logout-btn {
        border: 1px solid chocolate;
        background-color: #fff;
        color: chocolate;
    }
</style>