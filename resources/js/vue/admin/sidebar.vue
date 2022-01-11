<template>
    <aside id="sidebar"  class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

                <ul class="list-reset flex flex-col" >
                    <router-link @click="classActivate(1)" class="btn btn-primary ml-lg-3" :class="[(active_el ==1) ? 'bg-white' : '']" to="dashboard">
                    <li  class="w-full h-full py-3 px-2 border-b border-light-border " >
                        <i class="fas fa-tachometer-alt float-left mx-2"></i>Dashboard<span><i class="fa fa-angle-right float-right"></i></span>
                        <!-- <a href="index.html"
                           class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                            <i class="fas fa-tachometer-alt float-left mx-2"></i>
                            Dashboard
                            <span><i class="fas fa-angle-right float-right"></i></span>
                        </a> -->
                    </li>
                    </router-link>
                    <router-link @click="classActivate(2)" class="btn btn-primary ml-lg-3" :class="[(active_el == 2) ? 'bg-white' : '']" to="patient-list">                                   
                        <li  class="w-full h-full py-3 px-2 border-b border-light-border" >
                            <i class="fab fa-wpforms float-left mx-2"></i>Patient List <span><i class="fa fa-angle-right float-right"></i></span>
                        </li>
                    </router-link>
                    <router-link @click="classActivate(3)" class="btn btn-primary ml-lg-3" :class="[(active_el == 3) ? 'bg-white' : '']" to="admin-tests">
                    <li  class="w-full h-full py-3 px-2 border-b border-light-border" >
                        <i class="fas fa-grip-horizontal float-left mx-2"></i>Tests<span><i class="fa fa-angle-right float-right"></i></span>
                    </li>
                    </router-link>
                    
                    <!-- <li class="w-full h-full py-3 px-2 border-b border-light-border">
                        <router-link class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline" to="admin-doctors"><i class="fas fa-table float-left mx-2"></i>Doctors<span><i class="fa fa-angle-right float-right"></i></span></router-link>
                    </li> -->
                    
                    
                </ul>

            </aside>
</template>

<script>

export default {
   data:function(){
       return{
           bgBackground:'bg-white',
           active_el:0
       }
   },
   methods:{
       classActivate(el){
           this.active_el = el;
       }
   }
 
}
</script>
