

require('./bootstrap');

import {createApp} from 'vue'


import App from './app.vue'
import store from './store'
import Router from './router/index'



const app = createApp(App)

app.use(store)
app.use(Router)

app.mount('#app')