<template>
<div id='centeredFormModal' class="modal-wrapper">
    <div class="overlay close-modal"></div>
    <div class="modal modal-centered">
        <div class="modal-content shadow-lg p-5">
            <div class="border-b p-2 pb-3 pt-0 mb-4">
               <div class="flex justify-between items-center">
                   {{this.name}}  Detail {{moment(this.date).format("DD-MM-YYYY")}} 
                    <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                        <i class="fas fa-times text-gray-700"></i>
                    </span>
               </div>
            </div>
            <!-- Modal content -->
            <form id='form_id' class="w-full">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-first-name">
                             Name
                        </label>
                        <p>{{this.name}}</p>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                            Mobile No
                        </label>
                        <p>{{this.mobileNo}}</p>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-first-name">
                             Age
                        </label>
                        <p>{{this.age}}</p>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                            Gender
                        </label>
                        <p>{{this.gender}}</p>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-first-name">
                            CNIC
                        </label>
                        <p>{{this.cnic}}</p>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                            Address
                        </label>
                        <p>{{this.address}}</p>
                    </div>
                </div>

                <div v-for="(item,index) in allTest" :key="index" class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-first-name">
                            Test
                        </label>
                        <p>{{item.t_name}}</p>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                            Price
                        </label>
                        <p>{{item.t_price}}</p>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-city">
                            Sub Total
                        </label>
                        <p>{{this.subTotal}}</p>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-state">
                            Discount
                        </label>
                        <p>{{this.discount}}</p>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-zip">
                            Total
                        </label>
                         <p>{{this.total}}</p>
                    </div>
                </div>

                <div class="mt-5">
                    <span class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded'>
                        Close
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>    
</template>

<script>
import axios from 'axios'
import moment from "moment";
export default {
      
   props:[ 'patientDetail'],
        
   data(){
       return{
           moment: moment,
           userId:null,
           name:'',
           date:'',
           mobileNo:'',
           age:'',
           gender:'',
           cnic:'',
           address:'',
           subTotal:'',
           discount:'',
           total:'',
           allTest:[] 
       }
    },
    watch: { 
      	patientDetail: function(newVal, oldVal) { // watch it
          console.log('Prop changed: ', newVal, ' | was: ', oldVal)
          axios.get('api/getdetail/'+newVal)
          .then((response) => { 
              $('#centeredFormModal').addClass('modal-is-open');
              console.log(response.data.patientData);
              this.allTest = response.data.testData;
               this.mobileNo = response.data.patientData.p_mobile;
               this.date = response.data.patientData.created_at;
               this.age = response.data.patientData.p_age;
               this.name = response.data.patientData.p_name;
               this.gender = response.data.patientData.p_gender;
               this.cnic = response.data.patientData.p_cnic;
               this.address = response.data.patientData.p_address;
               this.subTotal = response.data.patientData.p_subtotal;
               this.discount = response.data.patientData.p_discount;
               this.total = response.data.patientData.p_total;
          })
          .catch(error => {
              console.log(error)
          })
        }
    },

   methods:{
    
   },
   
}
</script>
