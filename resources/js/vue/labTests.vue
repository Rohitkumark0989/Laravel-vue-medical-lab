<template>
    <Header />
      <div class="page-banner overlay-dark bg-image" style="background-image: url(/img/bg_image_1.jpg);">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">Tests</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Lab Tests</h1>

      <form class="contact-form mt-5" @submit.prevent="saveForm">
        <div class="row mb-3">
          <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Name<span style="color:red">*</span></label>
            <input type="text" id="fullName" v-model="userName" class="form-control" placeholder="Full name.." required>
          </div>
          <div class="col-sm-6 py-2 wow fadeInRight">
            <label for="mobileNumber">Mobile Number</label>
            <input type="number" id="mobileNumber" v-model="mobileNo" class="form-control" placeholder="Mobile Number..">
          </div>
           <!-- Gender  -->
            <div class="col-sm-6 py-2 wow fadeInLeft">
              <label for="age">Age<span style="color:red">*</span></label>
              <input type="number" id="age" v-model="age" class="form-control" placeholder="Age" required>
            </div>
            <div class="col-sm-6 py-2 wow fadeInRight">
              <label for="gender">Gender<span style="color:red">*</span></label>
              <select id="gender" class="form-control" v-model="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>  

            </div>
           <!-- Gender  -->
          
           
          <!-- Multiselect -->
            
          <div class="col-12 py-2 wow fadeInUp">
            <label for="multi">Lab Tests<span style="color:red">*</span></label>
            <Multiselect
              v-model="value"
              mode="multiple"
              :searchable="true"
              :options="options"
               @select="toggleSelected"
               @clear="clear"

            />

          </div>

          <!-- Multiselect -->
          <div class="col-12 py-2 wow fadeInUp">
            <label for="discount">Discount</label>
            <input type="number" @keyup="getDiscount($event)" id="discount" v-model="discount" class="form-control" placeholder="Discount">
          </div>

          <div class="col-12 py-2 wow fadeInUp">
            <label for="cnic">CNIC</label>
            <input type="number" v-model="cnic" id="cnic" class="form-control" placeholder="CNIC">
          </div>
          
          <div class="col-12 py-2 wow fadeInUp">
            <label for="address">Address</label>
            <input type="text" id="address" v-model="address" class="form-control" placeholder="Address">
          </div>

          
        </div>
        <!-- Result Section -->
          <div v-if="this.testSelected">
               
              <div class="col-lg-12">
                    <div class="row">
                          <div class="col-md-6 py-4 ">
                                <h5 class="post-title test-heading">Test Name</h5>
                          </div>
                          <div class="col-md-6 py-4 ">
                                <h5 class="post-title test-heading">Price</h5>
                          </div>
                    </div>

                    <div class="row" v-for="(item, index) in this.allSelectedOptions" key="index">
                          
                          <div class="col-md-6 py-4 ">
                                <h5 class="post-title price-sec">{{item.label}}</h5>
                          </div>
                          <div class="col-md-6 py-4 ">
                                <h5 class="post-title price-sec">{{item.price}}</h5>
                          </div>
                    </div> 
               </div> 
               <hr>
               <div class="col-md-12">
                   <h5><span class="check-heading">Subtotal:</span> <strong class="subtotal-price"> {{this.subtotal}} </strong></h5>
                   <h5><span class="check-heading">Discount:</span> <strong class="discount-price">{{this.discount}} </strong></h5>
                   <h5><span class="check-heading">Total:</span> <strong class="totoal-price"> {{this.total}} </strong></h5>
               </div>
          </div>  
          <!-- Result Section -->
        <button type="submit"  class="btn btn-primary wow zoomIn "  :disabled="btnDisalbed">{{this.saveBtn}}</button>
      </form>
    </div>
  </div>


    <Footer />
</template>

<script>
import axios from 'axios'
import Header from './header.vue'
import Footer from './footer.vue'
import Multiselect from '@vueform/multiselect'

//import { ref } from 'vue'


export default {
    components:{
        Header,
        Footer,
        Multiselect

    },
    data:function (){
        return{
            testList:[],
            testSelected:false,
            selected: null,
            value: null,
            options:[],
            btnDisalbed:true,
            saveBtn:'Save',
            btnDisalbedClass:'btn-secondary ',
            allSelectedOptions:[],
            discount:0,
            subtotal:0,
            total:0,
            userName:'',
            mobileNo:'',
            age:'',
            gender:'',
            cnic:'',
            address:'',
            allAmounts:[]
        }
    },
    methods:{
        
        getAllTestData(){
                axios.get('api/tests')
               .then( (response) =>{
                
                let getFilterVal = response.data.map((val,key) => {
                   return {value:val.id, label: val.t_name, price:val.t_price};
                })
                this.options = getFilterVal;
              })
              .catch (error =>{
                console.log(error);
              }) 
            
        },
        toggleSelected(id, value) { 
          /* can use a comma with console log for multiple values*/
          /* No need for  console.log(' >> '+ `${value}` ) */

          this.subtotal = (Number(this.subtotal) + Number(value.price));
          this.total = (Number(this.subtotal) - Number(this.discount));
          this.allSelectedOptions.push({id:value.value,label:value.label, price:value.price});
          this.testSelected = true;
          this.btnDisalbed = false;

        },
        getDiscount($event){
          this.discount = $event.target.value;
          if($event.target.value == ''){
            this.discount = 0;
          } 
          this.total = (Number(this.subtotal) - Number(this.discount));
        },
        saveForm(){
            this.saveBtn = "Saving...";
            this.allAmounts.push({subtotal:this.subtotal,total:this.total,discount:this.discount}); 
            axios.post('api/store',{
              name:this.userName,
              mobile:this.mobileNo,
              age:this.age,
              gender:this.gender,
              cnic:this.cnic,
              address:this.address,
              labs:this.allSelectedOptions,
              amounts:this.allAmounts
            })
            .then((response) => {
              this.saveBtn = "Save";
              if( response.status == 201){
                this.testSelected = false;
                this.selected = null;
                this.value = null;
                this.btnDisalbed = true;
                this.btnDisalbedClass = 'btn-secondary';
                this.allSelectedOptions = [];
                this.discount = 0;
                this.subtotal = 0;
                this.total = 0;
                this.userName = '';
                this.mobileNo = '';
                this.age = '';
                this.gender = '';
                this.cnic = '';
                this.address = '';
                this.allAmounts =[];
                window.open('/storage/pdf/tests.pdf','_blank');

              }
              console.log(response);
            })
            .catch(error => {
              console.log(error);
            })
        },
        clear(){
          this.testSelected = false;
          this.allSelectedOptions=[];
          this.subtotal = 0;
          this.discount = 0;
          this.total = 0;
          this.btnDisalbed = true;
        }

        
    },
    
    mounted() {
      this.getAllTestData();

    }


}

</script>


<style scoped>
@import '@vueform/multiselect/themes/default.css';


  .m-control-wrapper {
      margin: 0 auto;
      width: 64%;
  }
.p-section{
  padding-left:136px;
}
.test-heading{
  color: #00D9A5;
  text-align: center;
 
}
.price-sec{
  text-align: center;
}
.check-heading{
  padding-left:536px;
}
.totoal-price{
  padding-left:54px;
}
.subtotal-price{
  padding-left:22px;
}
.discount-price{
  padding-left:18px;
}
</style>