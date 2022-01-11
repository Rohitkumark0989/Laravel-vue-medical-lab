<template>
                    <div class="flex flex-col">
                    <!-- Stats Row Starts Here -->
                    <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
                        <div class="shadow-lg bg-red-vibrant border-l-8 hover:bg-red-vibrant-dark border-red-vibrant-dark mb-2 p-2 md:w-1/4 mx-2">
                            <div class="p-4 flex flex-col">
                                <a href="#" class="no-underline text-white text-2xl">
                                    {{this.totalTest}}
                                </a>
                                <a href="#" class="no-underline text-white text-lg">
                                    Total Tests
                                </a>
                            </div>
                        </div>

                        <div class="shadow bg-info border-l-8 hover:bg-info-dark border-info-dark mb-2 p-2 md:w-1/4 mx-2">
                            <div class="p-4 flex flex-col">
                                <a href="#" class="no-underline text-white text-2xl">
                                    {{grandSubtotal}}
                                </a>
                                <a href="#" class="no-underline text-white text-lg">
                                    Grand Sub Total
                                </a>
                            </div>
                        </div>

                        <div class="shadow bg-warning border-l-8 hover:bg-warning-dark border-warning-dark mb-2 p-2 md:w-1/4 mx-2">
                            <div class="p-4 flex flex-col">
                                <a href="#" class="no-underline text-white text-2xl">
                                    {{grandDiscount}}
                                </a>
                                <a href="#" class="no-underline text-white text-lg">
                                    Grand Discount
                                </a>
                            </div>
                        </div>

                        <div class="shadow bg-success border-l-8 hover:bg-success-dark border-success-dark mb-2 p-2 md:w-1/4 mx-2">
                            <div class="p-4 flex flex-col">
                                <a href="#" class="no-underline text-white text-2xl">
                                    {{grandTotal}}
                                </a>
                                <a href="#" class="no-underline text-white text-lg">
                                    Grand Total
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- /Stats Row Ends Here -->

                    <!-- Card Sextion Starts Here -->

                    <!-- /Cards Section Ends Here -->

                </div>

</template>

<script>

export default {
   data:function(){
       return{
           totalTest:0,
           grandSubtotal:0,
           grandDiscount:0,
           grandTotal:0,
       }

   },
   methods:{
       getTestCount(){
           axios.get('api/get-test-count/')
           .then((response) =>{
               if(response.status == 200){ 
                   this.totalTest = Number(response.data.totalTest)
               }
           })
           .catch(error =>{
               console.log(error);
           })
       },
       getTotalCount(){
           axios.get('api/get-total-count/')
           .then((response) =>{
               if(response.status == 200){ 
                   this.grandSubtotal = Number(response.data.subtotal);
                   this.grandDiscount = Number(response.data.discount);
                   this.grandTotal = Number(response.data.total);
               }
           })
           .catch(error =>{

           })
       }
   },
   mounted(){
     this.getTestCount();
     this.getTotalCount();
   }

}   
</script>
