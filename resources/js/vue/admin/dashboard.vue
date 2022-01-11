<template>
    <!-- <div id="dashboard"> -->
        <adminHeader />
        <div class="flex flex-1">
            <!--Sidebar-->
            <adminSideBar />
            <!--/Sidebar-->
            <!--Main-->
            <main class="bg-white-300 flex-1 p-3 overflow-hidden">
                <adminMain />
            </main>
            <!--/Main-->
        </div>

    <!-- </div> -->
    <adminFooter />
</template>
<script>
import adminHeader from './header.vue'
import adminFooter from './footer.vue'
import adminSideBar from './sidebar.vue'
import adminMain from './main.vue'
export default {
    components:{
        adminHeader,
        adminFooter,
        adminSideBar,
        adminMain
    }
}
</script>

<style scoped>
#footer {
   position:fixed;
   left:0px;
   bottom:0px;
   height:60px;
   width:100%;
}
</style>
