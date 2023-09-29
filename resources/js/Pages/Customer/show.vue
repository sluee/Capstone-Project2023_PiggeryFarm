<template>
    <Head title="View Customer" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">View Customer</h2>
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded mr-3" as="button" :href="'/customers/'">Back</Link>
            </div>
        </template>

        

        <div class="py-12">
            <div class="flex -mx-2">
                <div class="w-1/3 ml-2 ">
                    <div class=" pr-6">
                        <h4 class="text-center text-xl font-bold text-navy-700 dark:text-black">
                            Customer's Details
                        </h4>
                        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 ">
                            <div class="bg-white  shadow-lg sm:rounded-lg">
                                <div class="p-6 text-gray-900 flex">
            
                                    <div class="flex-1 ml-4 bg-">
                                        <div class="flex">
                                            <h3 class="text-2xl flex-1 ">Details of Customer</h3>
            
                                        </div>
                                        <hr>
                                        <div class="mt-2" ><strong>Customer:</strong>  {{ customer.name }} </div>
                                        <div class="mt-2" ><strong>Address</strong>  {{customer.address }} </div>
                                        <div class="mt-2"><strong>Phone</strong> {{ customer.phone }}</div>
            
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="w-3/4 ">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-7">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <!-- <div class="p-6 text-gray-900">You're logged in!</div> -->
                            <table class="min-w-max w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">Id</th>
                                        <th class="py-3 px-6 text-left">Date of Purchase</th>
                                        <th class="py-3 px-6 text-left">Pen no</th>
                                        <th class="py-3 px-6 text-left">Pig weight</th>
                                        <th class="py-3 px-6 text-left">Rate</th>
                                        <th class="py-3 px-6 text-left"> Total </th>
                                        <th class="py-3 px-6 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light" >

                                    <tr  class="border-b border-gray-200 hover:bg-gray-100" v-for="sale in customer.sales_items" :key="sale.id">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">

                                                <p class="font-medium">{{ sale.id }}</p>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">

                                                <p class="font-medium">{{ formattedDate(sale.created_at) }}</p>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">

                                                <p class="font-medium">{{ sale.pen_no }}</p>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">

                                                <p class="font-medium">{{ sale.pig_weight }}</p>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <div class="flex items-center">
                                                <p class="font-medium">{{ sale.rate }}</p>
                                            </div>
                                        </td>



                                        
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
            </div>
        </div>

    </SideBarLayout>
</template>

<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import PigPurchased from '@/Components/PigPurchased.vue';
import moment from 'moment'
// import { ref } from 'vue';
import {Head, Link, useForm} from '@inertiajs/vue3'


const props = defineProps({
    customer: Object,
     salesItems:Object,
   


})

function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
}



</script>
