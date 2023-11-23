<template>
    <Head title="View Labor" />

    <SideBarLayout>
        <template #header>
            
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">View Labor Details</h2>
                    <Breadcrumb :crumbs="crumbs"  />
                </div>
                <div class="flex">
                    <Link class="button1 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded" as="button" :href="'/labors/'">Back</Link>
                </div>
            </div>
            
        </template>
        
        <div class="py-12 px-4">
            <div class="flex items-center justify-center">
                <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-lg">
                    <div class="flex justify-center ">
                        <div><img src="/images/logo.png" alt="Logo" class="w-[70px] h-[70px] rounded-full object-cover"></div>
                        <div class=" ">
                            <h3 class="font-bold text-sm text-slate-700">RQR Piggery Farm || Saint Agustin Piggery Farm</h3>
                            <h3 class="font-bold text-sm text-slate-700 text-center">San Agustin, Sagbayan, Bohol</h3>
                            <h3 class="font-bold text-sm text-slate-700 text-center">Canmaya Centro, Sagbayan, Bohol</h3><br>
                            
                        </div>
        
                    </div>
                  <h1 class="text-xl font-semibold text-center text-slate-700 mb-2">Details of Labor</h1> 
                  <p class="text-sm text-slate-700 text-left mt-3 "><strong>Sow:</strong>  {{ labor.sow.sow_no }} </p> 
                  <p class="text-sm text-slate-700 text-left"><strong>Boar Breed:</strong>  {{ labor.boar.breed }} </p> 
                  <p class="text-sm text-slate-700 text-left"><strong>Date of Breed:</strong> {{ formattedDate(labor.breeding.date_of_breed) }}</p> 
                  <p class="text-sm text-slate-700 text-left"><strong>Expected Date of Farrowing:</strong> {{formattedDate (labor.breeding.exp_date_of_farrowing)}} </p> 
                  <p class="text-sm text-slate-700 text-left"><strong>Actual Date of Farrowing:</strong> {{formattedDate (labor.actual_date_farrowing)}} </p> 
                  <p class="text-sm text-slate-700 text-left"><strong>No of Pigs Born:</strong> {{labor.no_pigs_born}} </p> 
                  <p class="text-sm text-slate-700 text-left"><strong>No of Pigs Alive:</strong> {{labor.no_pigs_alive}} </p> 
                  <p class="text-sm text-slate-700 text-left"><strong>Remarks: </strong><span class="remarks-cell  py-1 px-3 rounded-full text-xs"
                    :class="{
                        'bg-green-200 text-green-600': labor.remarks == 'Waiting for results',
                        'bg-blue-200 text-blue-600':labor.remarks == 'Weaned',
                       
                    }"
                >{{ labor.remarks }}</span> </p> 
                  <div class="flex justify-center space-x-4 my-4">
                    <div v-if="labor.remarks== 'Waiting for results'">
                        
                        <Link class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline" as="button"  :href="'/weaning/create/'+ labor.id" >Wean</Link>
                    </div>
                  </div>
                  
                </div>
              </div>
        </div>
    </SideBarLayout>
</template>

<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import moment from 'moment'
import {Head, Link, useForm} from '@inertiajs/vue3'
import Breadcrumb from '@/Components/Breadcrumbs.vue';

const props = defineProps({
    breeding: Object,
    sow:Object,
    boar:Object,
    labor:Object

})

function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
}

const crumbs = [
        {
            name: 'Dashboard',
            url: '/dashboard',
            active: false,
        },
        {
            name: 'Breedings',
            url: '/breedings',
            active: false,
        },
        {
            name: 'Labors',
            url: '/labors',
            active: false,
        },
        {
            name:  "Labor no "+ props.labor.id ,
            url: null,
            active: true,
        },
    ]


</script>
