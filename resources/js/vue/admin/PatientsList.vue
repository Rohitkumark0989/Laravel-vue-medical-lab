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
                                <div class="font-bold text-xl">Patient List</div>
                                    <div class="flex flex-wrap -mx-3 mb-2">
                                        <div class="w-full md:w-1/3 px-3 mb-4 md:mb-0">
                                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                                   for="grid-city">
                                                Search
                                            </label>
                                            <input @keyup="searchPatient($event)" class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                   id="grid-city" type="text" placeholder="Search by Name">
                                        </div>
                                        <div class=" px-3 mb-4 md:mb-0">
                                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                                   for="grid-state">
                                                From
                                            </label>
                                            <div class="relative">
                                                <input type="date" id="grid-state" v-model="dateFrom"  @change="getSelectedDate()" class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" />
                                            </div>
                                        </div>
                                        <div class="  px-3 mb-4 md:mb-0">
                                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                                   for="grid-zip">
                                                To 
                                            </label>
                                            <input type="date" id="grid-zip" @change="getSelectedDate()" v-model="dateTo" class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey">
                                             
                                        </div>
                                        <div class="  px-3 mb-4 md:mb-0">
                                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                                   for="grid-zip">
                                                &nbsp;
                                            </label>
                                            <button @click="downloadExcel()"
                                                class="bg-green-500 hover:bg-green-800  text-white font-bold py-2 px-4 rounded  ">
                                                Download
                                            </button>
                                        </div>    
                                        
                                    </div>
                                         
                                        <!-- <datepicker v-model="picked" /> -->
                                
                            </div>
                            <div class="table-responsive">

                                <table class="table text-grey-darkest">
                                    <thead class="bg-grey-dark text-white text-normal">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Detail</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(item,index) in this.allPatientList" :key="index">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{item.p_name}}</td>
                                        <td>{{ moment(item.created_at).format("DD-MM-YYYY")}} </td>
                                        <td>{{item.p_subtotal}}</td>
                                        <td>{{item.p_discount}}</td>
                                        <td>{{item.p_total}}</td>
                                        <td>
                                            <button data-modal='centeredFormModal' @click="passPatientId(item.id)"
                                                class="modal-trigger bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Detail
                                            </button>
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
<!-- Modal Div -->
  <patientDetail :patientDetail="patientDetailId" />
<!-- Modal Div -->
</template>>

<script>

import adminHeader from './header.vue'
import adminFooter from './footer.vue'
import adminSideBar from './sidebar.vue'
import patientDetail from './PatientDetail.vue'
import moment from "moment";

var date = new Date(), y = date.getFullYear(), m = date.getMonth();
var firstDate = new Date(y, m, 1).toISOString().slice(0,10);

                               

import Datepicker from 'vue3-datepicker'
//import Datepicker from 'vuejs-datepicker';

export default {
        components:{
        adminHeader,
        adminFooter,
        adminSideBar,
        patientDetail,
        Datepicker,

    },
    data:function(){
        return{
            moment: moment,
            allPatientList:[],
            myModel:false,
            patientDetailId:'',
            searchVal:'',
            dateTo:new Date().toISOString().slice(0,10),
            dateFrom:firstDate,
            callTriggered:false,
            
        }
    },
    methods:{
       getAllPatientList(){
            var dateFrom = moment((this.dateFrom)).format('YYYY-MM-DD') 
            var dateTo = moment((this.dateTo)).format('YYYY-MM-DD') 
 
           axios.get('api/allPatientList/'+dateFrom+'/'+dateTo)
           .then((response) => {
               this.allPatientList = response.data.data; 
           })
           .catch( error => {
               console.log(error);
           });
       },
       openModel(){ 
            this.myModel = true;
        },
        passPatientId(id){
            this.patientDetailId = id;
        },
        
        getSelectedDate(){
            var dateFrom = moment((this.dateFrom)).format('YYYY-MM-DD') 
            var dateTo = moment((this.dateTo)).format('YYYY-MM-DD') 

                 axios.get('api/allPatientList/'+dateFrom+'/'+dateTo)
                .then((response) => {
                    console.log('rohit');
                    if(response.status == 200){
                        //console.log(response.data);
                        this.allPatientList = response.data.data;
                    }
                          
                    //this.getAllPatientList();
                })
                .catch( error => {
                    console.log(error);
                })
                 
                
            //}
           
        },
        searchPatient($event){
            this.searchVal = $event.target.value;
            var dateFrom = moment((this.dateFrom)).format('YYYY-MM-DD') 
            var dateTo = moment((this.dateTo)).format('YYYY-MM-DD') 
            //axios.post('api/allPatientList',{search:$event.target.value})
            axios.get('api/allPatientList/'+dateFrom+'/'+dateTo+'/'+this.searchVal)
           .then((response) => {
               if(response.status == 200){
                   this.allPatientList = response.data.data;
               }
                
           })
           .catch( error => {
               console.log(error);
           });
        },
        downloadExcel(){
            var dateFrom = moment((this.dateFrom)).format('YYYY-MM-DD') 
            var dateTo = moment((this.dateTo)).format('YYYY-MM-DD')
            
            axios.post('api/download',{
              from:dateFrom,
              to:dateTo,
              name:this.searchVal,
            })
            .then((response)=>{
                 if(response.status == 200){
                     window.open('/storage/uploads/release/all-test-list.xlsx');
                 }   
            })
            .catch( error => {
               console.log(error);
           });
        }    
    },
    mounted() {
      this.getAllPatientList();
       const plugin = document.createElement("script");
    plugin.setAttribute(
      "src",
      "assets/admin/js/main.js"
    );
    plugin.async = true;
    document.head.appendChild(plugin);
      //this.allPatientList = this.tempPatientList;
    }
}
</script>

