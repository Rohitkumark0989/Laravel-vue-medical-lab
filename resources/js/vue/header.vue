<template>
    <div class="back-to-top"></div>

  <header>
    <div class="topbar">
      <div class="container">
        
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#">
          <!-- <span class="text-primary">One</span>-Health -->
          <img class="text-primary" src="img/doctors/logo.png" style="width:70px" alt="">
        </a>

        <!-- <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
          </div>
        </form> -->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active" id="menu1"  @click="classActivate(1)" >
              <router-link class="nav-link" to="/">Home</router-link>

            </li>
            <li class="nav-item" id="menu2" @click="classActivate(2)" >
              <!-- <a class="nav-link" href="about.html">About Us</a> -->
              <router-link class="nav-link" to="about">About Us</router-link>
            </li>
            <li class="nav-item" id="menu3" @click="classActivate(3)" >
              <router-link class="nav-link" to="doctors">Doctors</router-link>
            </li>
            <li class="nav-item" id="menu4" @click="classActivate(4)" >
              <router-link class="nav-link" to="labs">Labs</router-link>
            </li>
            <li class="nav-item" id="menu5" @click="classActivate(5)" >
              <router-link class="nav-link" to="contact">Contact Us</router-link>
            </li>
            <li class="nav-item" v-if="this.labTestBtn" id="menu6" @click="classActivate(6)">
              <router-link class="btn btn-primary ml-lg-3"  to="tests">Lab Tests</router-link>
            </li>
            <li class="nav-item" v-if="this.userLoginBtn">
              <router-link class="btn btn-primary ml-lg-3"  to="userlogin">User Login</router-link>
            </li>
          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>
</template>
<script>

export default {
  data(){
      return{
        isActive: false,
        bgBackground:'bg-white',
        active_el:0,
        labTestBtn:false,
        userLoginBtn:true
      }
  },
  methods: {
    classActivate(el){
      $('#menu1').removeClass('active');
      $('#menu'+el).addClass('active'); 
           //this.active_el = el;
    }
  },
  
   mounted(){
     if (window.Laravel.isLoggedin) {
            this.labTestBtn = true;
            this.userLoginBtn = false;
      }
   }
}
</script>
