<template>
    <div id='centeredFormModal' class="modal-wrapper">
    <div class="overlay close-modal" ></div>
    <div class="modal modal-centered">
        <div class="modal-content shadow-lg p-5">
            <div class="border-b p-2 pb-3 pt-0 mb-4">
               <div class="flex justify-between items-center">
                    {{this.modalHeader}}
                    <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                        <i class="fas fa-times text-gray-700"></i>
                    </span>
               </div>
            </div>
            <!-- Modal content -->
            <form id='form_id' class="w-full" @submit.prevent="editStatus ? updateTestData() : createTestData()">
                
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-password">
                            Test Name
                        </label>
                        <input
                            class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                            id="grid-password" v-model="testName" type="text" placeholder="Enter Name" required>
                        
                    </div>

                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-password">
                            Price
                        </label>
                        <input
                            class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                            id="grid-password" type="text" v-model="testPrice" placeholder="Enter Price" required >
                        
                    </div>
                </div>

                <div class="mt-5">
                    <button class='bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded'> {{editButton}} </button>
                    &nbsp;&nbsp;
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
import axios from 'axios';


export default {
    props:['editmode','testId'],
    data:function(){
        return{
            modalHeader:'Update Test',
            editButton:'Update',
            testName:'',
            testPrice:'',
            editStatus:false
        }
    },
    watch: {
        // Functionality added for the first time Add button
        editmode:function(newVal, oldVal){ 
                this.modalHeader = 'New Test';
                this.editButton = 'Save';
                this.testName = '';
                this.testPrice = '';
                this.editStatus = false;  
        }, 
      	testId: function(newVal, oldVal) { 
            // When user click on add button after the clicked on edit  
            if(this.testId == ''){ 
                  this.modalHeader = 'New Test';
                  this.editButton = 'Save';
                  this.testName = '';
                  this.testPrice = '';
                  this.editStatus = false;
            }else{
                $('#centeredFormModal').addClass('modal-is-open');
                this.modalHeader = 'Update Test';
                this.editButton = 'Update';
                this.editStatus = true;

                axios.get('api/gettestdetail/'+this.testId)
                .then((response) => {
                    this.testName = response.data.testData.t_name;
                    this.testPrice = response.data.testData.t_price;
                })
                .catch(error => {
                    console.log(error)
                })
                }    
            }
            
            
        
    },
    methods:{
        updateTestData(){
            if(this.testName == '' || this.testPrice == ''){ return false;}
            axios.post('api/update/' + this.testId,{
              testName:this.testName,
              testPrice:this.testPrice,
            })
            .then((response) => {
                  if(response.data.status == 201){
                      $('.close-modal').trigger('click');
                      this.$parent.getAllTestList();
                      //this.$emit('changeTitle','Awesome ')
                  }  
            })
            .catch(error =>{
                console.log(error)
            });
        },
        createTestData(){
            if(this.testName == '' || this.testPrice == ''){ return false;}
            axios.post('api/savetestdata',{
                testName:this.testName,
                testPrice:this.testPrice
            })
            .then((response) => {
                if(response.data.status == 201){
                    $('.close-modal').trigger('click');
                    this.$parent.getAllTestList();
                }
                console.log(response);
            })
            .catch(error => {
                console.log(error);
            })
        }
    },

}
</script>
