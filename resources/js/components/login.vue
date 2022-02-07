<template>
  <div class="login">
      <div v-if="loading"><loading /></div>
        <form @submit.prevent="login">
                        <h1>Login</h1>
                        <div class="text-danger p-1" v-if="errors != ''">{{errors}}</div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required autocomplete="off" v-model="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required v-model="password">
                        </div>
                        <button type="submit" class="r-btn">Login</button>
                        <p class="text-center">Don't yet have an account? <a @click.prevent="$emit('changeAuthForm')">Register</a></p>
        </form>
    </div>
</template>

<script>
const axios = require('axios')
import {mapMutations} from 'vuex'

import loading from '../components/loading.vue'

axios.defaults.withCredentials = true
export default {
    data(){
        return {
            email: '',
            password: '',
            errors: '',
            loading: false
        }
    },
    components: {loading},
    methods: {
        ...mapMutations(['setUser']),
        login(){
            if(this.email == '' || this.password == ''){
                this.errors = "All fields must be filled"
                return
            }
            this.loading = true
            axios.post('/api/login',{email:this.email,password:this.password}).then((data)=>{
                this.$store.commit('setUser',data.data)
                window.axios.defaults.headers.common['Authorization'] = `Bearer ${data.data.token}`
                this.loading = false
                if(data.data.user.role_id == 2){
                    this.$router.push({name:'AdminDashboard'})
                }else{
                    this.$router.push({name:'UserDashboard'})
                }
            }).catch((error)=>{
                this.loading = false
                this.errors = "Error Logging in: check credentials"
            })
        }
    }
}
</script>

<style>

</style>