<template>
                <div class="login">
                    <div v-if="loading"><loading /></div>
                    <form @submit.prevent = "register">
                        <h1>Register</h1>
                        <div class="text-danger p-1" v-if="errors != ''">{{errors}}</div>
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" name="name" id="name" class="form-control" required autocomplete="off" v-model="name">
                            <div class="text-danger p-1" v-if="err.matricule != ''">{{err.matricule}}</div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required autocomplete="off" v-model="email">
                            <div class="text-danger p-1" v-if="err.email != ''">{{err.email}}</div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required v-model="password">
                            <div class="text-danger p-1" v-if="err.password != ''">{{err.password}}</div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Reinter password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required v-model="password_confirmation">
                        </div>
                        <button type="submit" class="r-btn">Register</button>
                        <p class="text-center">Already have an account? <a @click.prevent="$emit('changeAuthForm')">Login</a></p>
                    </form>
                </div>
</template>

<script>
import loading from '../components/loading.vue'

export default {
    data(){
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            errors: '',
            err: {
                name: '',
                email: '',
                password: ''
            },
            loading: false
        }
    },
    components: {loading},
    methods: {
        register(){
            if(this.name == '' || this.email == '' || this.password == '' || this.password_confirmation == ''){
                this.errors = "All fields must be filled"
                return
            }

            if(this.password != this.password_confirmation){
                this.errors = "Passwords not match"
                return
            }
            
            this.loading = true

            axios.post('/api/register',{name:this.name,email:this.email,password:this.password,password_confirmation:this.password_confirmation}).then((data)=>{
                this.loading = false
                alert("Account Successfully created")
                this.$emit('changeAuthForm',false)
                this.$router.push({name: "Home"})
            }).catch((error)=>{
                this.loading = false
                if(error.response.status == 422){
                    if(error.response.data.errors.name){
                        this.err.name = error.response.data.errors.name.join()
                    }else if(error.response.data.errors.email){
                        this.err.email = error.response.data.errors.email.join()
                    }else if(error.response.data.errors.password){
                        this.err.password = error.response.data.errors.password.join()
                    }
                }
                this.errors = "Error registering"
                return
            })
        }
    }
}
</script>

<style>

</style>