<template>
    <Head title="View Customer" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">View Customer</h2>
                <div style="position:relative">
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-9 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search customer history here" v-model="search">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#444  " width="20px" height="20px" viewBox="0 0 16 16"
                    style="position:absolute; top:10px; right:10px">
                    <path d="M12.027 9.92L16 13.95 14 16l-4.075-3.976A6.465 6.465 0 0 1 6.5 13C2.91 13 0 10.083 0 6.5 0 2.91 2.917 0 6.5 0 10.09 0 13 2.917 13 6.5a6.463 6.463 0 0 1-.973 3.42zM1.997 6.452c0 2.48 2.014 4.5 4.5 4.5 2.48 0 4.5-2.015 4.5-4.5 0-2.48-2.015-4.5-4.5-4.5-2.48 0-4.5 2.014-4.5 4.5z" fill-rule="evenodd"/>
                    </svg>
                </div>
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
                            <div class="flex">
                                <h3 class="text-2xl flex-1  dark:text-black">Customer's Transaction</h3>

                            </div>
                            <table class="min-w-max w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">Id</th>
                                        <th class="py-3 px-6 text-left">Date of Purchase</th>
                                        <th class="py-3 px-6 text-left">Pen no</th>
                                        <th class="py-3 px-6 text-left">Pig weight</th>
                                        <th class="py-3 px-6 text-left">Rate</th>
                                        <th class="py-3 px-6 text-left"> Total </th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light" >

                                    <tr  class="border-b border-gray-200 hover:bg-gray-100"  v-for="sale in customer.sales_items" :key="sale.id">
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
                                        <td class="py-3 px-6 text-left">
                                            <div class="flex items-center">
                                                <p class="font-medium">{{ sale.total }}</p>
                                            </div>
                                        </td>                                        
                                    </tr>

                                </tbody>
                                <tr>
                                    <td></td>   
                                    <td></td>   
                                    <td></td>   
                                    <td></td>   
                                   <td class="py-3 px-6 text-center"><div class="flex items-center justify-center">
                                      <p class="font-medium">Total Amount: {{totalAmount}}</p>
                                   </div></td>
                               </tr>
                            </table>
                            <!-- <Pagination :links="salesItems.links" class="mt-6 flex justify-center"/> -->
                        </div>
                    </div>
                  </div>
            </div>
        </div>

    </SideBarLayout>
</template>

<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import moment from 'moment'
import {Head, Link, router} from '@inertiajs/vue3'
import { ref,watch } from 'vue';


const props = defineProps({
    customer: Object,
    salesItems:Object,
    filters:Object,
    totalAmount:Number
   


})

function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
}

let search = ref(props.filters.search);
    watch(search, (value) => {
        router.get(
            "/customers/{customer}",
            { search: value },
            {
                preserveState: true,
                replace: true,
            }
        );
    });


</script>
