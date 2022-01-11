<template>
    <adminHeader />
        <div class="flex flex-1">
            <!--Sidebar-->
            <adminSideBar />
            <!--/Sidebar-->
            <!--Main-->
            <main class="bg-white-300 flex-1 p-3 overflow-hidden">
                                    <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">

                        <!-- card -->
                        <div class="rounded overflow-hidden shadow bg-white mx-2 w-full">
                            
                            <div class="px-6 py-2 border-b border-light-grey">
                                <button data-modal='centeredFormModal' @click="enableAddForm()"  class='modal-trigger bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded'> Add Test </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-grey-darkest">
                                    <thead class="bg-grey-dark text-white text-normal">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Test Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Created On</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <tr v-for="(item,index) in testList" :key="index">
                                        <th scope="row">{{index+1}}</th>
                                        <td>
                                            {{item.label}}
                                        </td>
                                        <td>{{item.price}}</td>
                                        <td>{{ moment(item.created_at).format("DD-MM-YYYY")}}</td>
                                        <td class="border px-4 py-2">
                                                
                                                <a data-modal='centeredFormModal' @click="enableEditForm(item.value)" class="modal-trigger bg-teal-300 cursor-pointer rounded p-1 mx-1 text-white">
                                                        <i class="fas fa-edit"></i></a>
                                                <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-red-500" @click="softDelete(item.value)">
                                                        <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                    </tr>
                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /card -->

                    </div>
            </main>
            <!--/Main-->
        </div>

    <!-- </div> -->
    <adminFooter />
     <EditTestModal :editmode=editmode :testId=testId   /> 

 

</template>>
<script>
import adminHeader from './header.vue'
import adminFooter from './footer.vue'
import adminSideBar from './sidebar.vue'
import EditTestModal from './EdtiTestModal.vue'
import moment from "moment";
export default {
        components:{
        adminHeader,
        adminFooter,
        adminSideBar,
        EditTestModal,
        
    },
    data:function(){
        return{
            testList:[],
            moment: moment,
            testId:'',
            editmode: false,
            
        }
    },
    methods:{
        getAllTestList(){
            axios.get('api/tests')
               .then( (response) =>{
                    
                    let getFilterVal = response.data.map((val,key) => {
                        return {value:val.id, label: val.t_name, price:val.t_price};
                    })
                    this.testList = getFilterVal;
                })
            .catch (error =>{
                console.log(error);
            })
        },

        enableAddForm(){ 
             this.testId = ''; 
             this.editmode = true;
            //$('#centeredFormModal').show();
        },

        enableEditForm(id){ 
            this.testId = id;
            this.editmode = true;
        },
        softDelete(id){ 
            if(confirm("Are you Sure want to Delete!")){
                axios.post('api/soft-delete/' + id,{
                id:id
                })
                .then((response) => {
                    if(response.data.status == 201){
                        $('.close-modal').trigger('click');
                        this.getAllTestList();
                        
                    }  
                })
                .catch(error =>{
                    console.log(error)
                });
            }else{
                retrun;
            }
            
        }
        
    },
    mounted(){
        this.getAllTestList();
        const plugin = document.createElement("script");
        plugin.setAttribute(
        "src",
        "assets/admin/js/main.js"
        );
        plugin.async = true;
        document.head.appendChild(plugin);
    }    
}
</script>
