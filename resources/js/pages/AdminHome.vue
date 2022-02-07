<template>
    <div class="info-section container d-flex">
            <div class="users">
                <h4>Users</h4>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key=user.id>
                            <td>{{user.id}}</td>
                            <td>{{user.name}}</td>
                            <td>{{user.email}}</td>
                            <td><button class="btn btn-sm btn-primary" @click="viewuser(user.id)">View</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="payments ml-5" v-if="payments[0]">
                <h4>Payments</h4>
                {{payments}}
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key=user.id>
                            <td>{{user.id}}</td>
                            <td>{{user.name}}</td>
                            <td>{{user.email}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="payments ml-5" v-else><h1>No Payments Yet</h1></div>
    </div>
</template>

<script>
export default {
     data(){
        return {
            user: {},
            results: [],
            users: [],
            error: '',
            payments: [],
        }
    },
    created(){
        this.user = this.$store.state.user
        axios.get('/api/users').then((data)=>{
            this.users = data.data
        }).catch((error)=>{
            this.error = error
        })

        axios.get('/api/payments').then((data)=>{
            this.payments = data.data
        }).catch((error)=>{
            this.error = error
        })
    },
    methods:{
        viewuser(id){
            console.log(id)
        }
    }
}
</script>