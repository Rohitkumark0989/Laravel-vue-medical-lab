<template>
    <Header />
      <div class="page-banner overlay-dark bg-image" style="background-image: url(/img/bg_image_1.jpg);">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">

        <h1 class="font-weight-normal">User Login</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Welcome To User Login Panel</h1>
        
      <form class="contact-form mt-5" @submit.prevent="saveForm">
        <div class="row mb-3">
          <div v-if="this.error" class="col-12 py-2 wow fadeInUp alert alert-danger" role="alert">
            Please Enter Valid User Name and Password!
        </div>
          <div class="col-12 py-2 wow fadeInUp">
            <label for="name">User Name</label>
            <input type="text" id="name" class="form-control" v-model="userName" placeholder="Enter Name" required>
          </div>

          <div class="col-12 py-2 wow fadeInUp">
            <label for="password">Password</label>
            <input type="password" id="password" class="form-control" v-model="password" placeholder="Enter Password" required>
          </div>
          
        </div>
        <button type="submit" class="btn btn-primary wow zoomIn">Login</button>
      </form>
    </div>
  </div>


    <Footer />
</template>
<script>

import Header from './header.vue'
import Footer from './footer.vue'



export default {
    components:{
        Header,
        Footer
    },
    data:function(){
      return{
         userName:'',
         password:'',
         error:false,
      }
    },
    methods:{
      saveForm(){
         if(this.userName =='' ||  this.password == ''){
           return false;
         }
         axios.post('api/front-user',{
           name:this.userName,
           password:this.password
          })
         .then((response) =>{

             if(response.data.status == 200){
                window.location.href = "/tests";
             }
             else{
               this.error =true;  
             }
         })
         .catch(error =>{
           console.log(error);
         })
      }
    }
}

</script>
