<template>
    <div class="info-section container d-flex justify-content-center">
        <div>
            <div class="text-danger p-1" v-if="errors != ''">{{errors}}</div>
            <div class="text-primary p-1" v-if="success != ''">{{success}}</div>
            <table class="table table responsive border">
            <thead>
                <th>SN</th>
                <th>Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr v-for="concour in concours" :key=concour.id>
                    <td>{{concour.id}}</td>
                    <td>{{concour.name}}</td>
                    <td><button class="btn btn-sm btn-danger" @click="deleteConcour(concour.id)">delete</button></td>
                </tr>
            </tbody>
            <span><input type="text" name="concour" id="concour" v-model="newconcour"><button class="btn btn-sm btn-primary" @click="addConcour">Add</button></span>
            </table>
        </div>

        <div class="ml-5 border p-3">
            <h4>Add results data</h4>
            <div class="text-danger p-1" v-if="errors != ''">{{errors}}</div>
            <div class="text-primary p-1" v-if="success != ''">{{success}}</div>
            <form @submit.prevent="uploadImage">
                <div class="form-group">
                    <label for="concourname">Select Concour</label>
                    <select name="concourname" id="concourname" v-model="image.concourId">
                        <option  v-for="concour in concours" :key=concour.id :value="concour.id" class="form-control">{{concour.name}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Select Image File</label>
                    <input type="file" name="image" id="image" class="form-control" @change="imageChange">
                </div>
                <div class="form-group">
                    <input type="submit" value="Save" class="form-control btn btn-sm btn-primary">
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            newconcour: '',
            concours: [],
            image: {
                name: '',
                concourId: ''
            },
            errors: '',
            formData:  new FormData(),
            success: '',
        }
    },

    created() {
        this.getConcour()
    },

    methods: {
        clearMessages(){
            this.success = ''
            this.errors = ''
        },
        getConcour(){
            axios.get('/api/results').then((data)=>{
            this.concours = data.data
            }).catch((error)=>{
                console.log(error)
            })
        },
        addConcour(){
            this.clearMessages()
            if(this.newconcour != ''){
                axios.post('/api/results',{concour: this.newconcour}).then((data)=>{
                    this.success = "Successfully Added"
                    this.getConcour()
                    this.newconcour = ''
                }).catch((error)=>{
                    this.errors = "Error Adding"
                })
            }else{
                this.errors = 'Please make sure you fill the input box'
            }
        },
        deleteConcour(id){
            this.clearMessages()
            axios.post('/api/results/delete',{id:id}).then((data)=>{
                    this.success = "Successfully Deleted"
                    this.getConcour()
                }).catch((error)=>{
                    this.errors = "Error Deleting"
                })
        },
        imageChange(event){
            this.image.name = event.target.files[0]
        },
        uploadImage(){
            this.clearMessages()
            this.formData.append('concourId',this.image.concourId)
            this.formData.append('image',this.image.name)
            
            axios.post('/api/results/upload',this.formData).then((data)=>{
                this.success = "Result successfully added"
            }).catch((error)=>{
                this.errors = "Error Saving Please Try Again Later"
            })
        }
    }
}
</script>