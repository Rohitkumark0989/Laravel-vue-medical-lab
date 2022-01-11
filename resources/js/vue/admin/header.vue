<template>
  <!--Header Section Starts Here-->
    
        <header class="bg-nav">
            <div class="flex justify-between">
                <div class="p-1 mx-3 inline-flex items-center">
                    <i class="fas fa-bars pr-2 text-white" @click="sidebarToggle()"></i>
                    <h1 class="text-white p-2">Logo</h1>
                </div>
                <div class="p-1 flex flex-row items-center">

                    <img @click="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="https://avatars0.githubusercontent.com/u/4323180?s=460&v=4" alt="">
                    <a href="#" @click="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block">{{this.username}}</a>
                    <div id="ProfileDropDown" v-if="this.profile" class="rounded  shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                        <ul class="list-reset">
                          <li><hr class="border-t mx-2 border-grey-ligght"></li>
                          <li><a href="#" @click="logout" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!--/Header-->   
</template>

<script>

export default {
 data: function (){
     return {
         profile:false,
         sidebar:false,
         username:false,
     }
 },
 methods:{
    profileToggle(){
        this.profile = !this.profile;
    },

    sidebarToggle(){
        var sidebar = document.getElementById('sidebar'); 
        if (sidebar.style.display === "none") {
            sidebar.style.display = "block";
        } else {
            sidebar.style.display = "none";
        }
    },
    logout(){
        axios.post('logout').then(function() {
            location.reload();
        })
        .catch(e => {
            this.errors.push(e)
        })
    }

 },
 mounted() {
     this.username = $('#user-id').attr('content') 
 }

}
</script>
