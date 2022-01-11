import {createWebHistory,createRouter} from 'vue-router'
import Home from './vue/home.vue';
import About from './vue/about.vue';
import Doctors from './vue/doctors.vue';
import Labs from './vue/labs.vue';
import Contact from './vue/contact.vue';
import LabTests from './vue/labTests.vue';
import UserLogin from './vue/UserLogin.vue';
// Admin Routes
import adminDashboard from './vue/admin/dashboard.vue'
import PatientsList from './vue/admin/PatientsList.vue'
import AdminTests from './vue/admin/AdminTests.vue'
import AdminDoctors from './vue/admin/AdminDoctors.vue'
const routes=[
    {
        name:'Home',
        path:'/',
        component:Home 
    },
    {
        name:'About',
        path:'/about',
        component:About 
    },
    {
        name:'Doctors',
        path:'/doctors',
        component:Doctors 
    },
    {
        name:'Labs',
        path:'/labs',
        component:Labs 
    },
    {
        name:'Contact',
        path:'/contact',
        component:Contact 
    },
    {
        name:'LabTest',
        path:'/tests',
        component:LabTests 
    },
    {
        name:'UserLogin',
        path:'/userlogin',
        component:UserLogin 
    },
    // Admin Routes Here
    {
        name:'AdminDashboard',
        path:'/dashboard',
        component:adminDashboard 
    },
    {
        name:'PatientsList',
        path:'/patient-list',
        component:PatientsList 
    },
    {
        name:'AdminTests',
        path:'/admin-tests',
        component:AdminTests 
    },
    {
        name:'AdminDoctors',
        path:'/admin-doctors',
        component:AdminDoctors 
    },
];

const router=createRouter({
    history:createWebHistory(process.env.BASE_URL),
    routes
});
export default router;