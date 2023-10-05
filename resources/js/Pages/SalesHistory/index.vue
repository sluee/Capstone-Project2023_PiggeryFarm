<script setup>
// import {Head, useForm } from "@inertiajs/vue3";
import {Head} from '@inertiajs/vue3'
import SideBarLayout from "@/Layouts/SideBarLayout.vue";


const props = defineProps({
    salesItems:Array,
    customers:Object,
    sale:Object,
    total:Number,
    totalAmount:Number
});


</script>

<template>
    <Head title="Sales History" />

    <SideBarLayout>
        <template #header >
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sales History</h2>

            </div>
        </template>


            <div class="w-full px-5 py-4">
                <div class="h-12">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <!-- <th class="py-3 px-6 text-center">Customer</th> -->
                                    <th class="py-3 px-6 text-center">Customer Name</th>
                                    <th class="py-3 px-6 text-center">Pen No</th>
                                    <th class="py-3 px-6 text-center">Weight</th>
                                    <th class="py-3 px-6 text-center">Rate</th>
                                    <th class="py-3 px-6 text-center">Total</th>
                                    <!-- <th class="py-3 px-6 text-center">Action</th> -->
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light" v-for="items in salesItems" :key="items.id">

                                <tr  class="border-b border-gray-200 hover:bg-gray-100" >

                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ items.sale.cust_id }}</p>

                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{items.pen_no}}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{items.pig_weight}}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{items.rate}}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{items.total}}</p>
                                        </div>
                                    </td>

                                    <!-- <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">

                                            <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                <a href="#" class="btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="w-4  ml-2 mr-2 transform hover:text-red-500 hover:scale-110">
                                                <a href="#" class="btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </td> -->
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
                    </div>
                </div>
            </div>



   </SideBarLayout>
</template>
