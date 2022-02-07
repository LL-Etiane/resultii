import {createWebHistory, createRouter} from "vue-router"

import store from '../store'


//general site pages
import Home from "../pages/Home.vue"
import About from "../pages/About.vue"
import NotFoundPage from "../pages/404.vue"

//user pages
import UserDashboard from "../pages/UserDashoard.vue"
import UserAccount from "../pages/UserAccount.vue"
import UserResult from "../pages/UserResult.vue"

//admin pages
import AdminDashboard from "../pages/AdminDashboard"
import AdminHome from "../pages/AdminHome"
import AdminResults from "../pages/AdminResults"

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home 
    },
    {
        path: "/about",
        name: "About",
        component: About,
    },
    {
        path: "/user",
        name: "UserDashboard",
        component: UserDashboard,
        meta: {requiresAuth: true}
    },
    {
        path: "/user/account",
        name: "UserAccount",
        component: UserAccount,
        meta: {requiresAuth: true}
    },
    {
        path: "/user/:resultname",
        name: "UserResult",
        component: UserResult,
        meta: {requiresAuth: true}
    },

    {
        path: "/admin",
        name: "AdminDashboard",
        component: AdminDashboard,
        redirect: "/admin/home",

        children: [
            {
                path: "home",
                component: AdminHome,
                name: "AdminHome"
            },
            {
                path: "results",
                component: AdminResults,
                name: "AdminResults"
            }
        ]
    },

    {
        path: "/:catchAll(.*)",
        name: "404",
        component: NotFoundPage
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next)=>{
    if(to.matched.some(record => record.meta.requiresAuth)){
        
        if(jQuery.isEmptyObject(store.state.user)){
            next({
                path: '/'
            })
        } else {
            next()
        }
    }else if(to.path.startsWith('/admin')){
        let go = true
        if(jQuery.isEmptyObject(store.state.user)){
            next({
                path: '/'
            })
        } else {
            if(store.state.user.user.role_id != 2){
                next({
                    path: '/'
                })
            } else {
                next()
            }
        }
    } else {
        next()
    }
})

export default router