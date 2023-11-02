<script setup>
// import {Head, useForm } from "@inertiajs/vue3";
import {Head, Link, useForm} from '@inertiajs/vue3'
import SideBarLayout from "@/Layouts/SideBarLayout.vue";
import moment from 'moment'



    const props = defineProps({
        sales:Object,
        totalAmountAllSales: Number,

    });

    function formattedDate(date){
        return moment(date).format('MMMM   D, YYYY');
    }


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
                                    <th class="py-3 px-6 text-center">Invoice ID</th>
                                    <th class="py-3 px-6 text-center">Customer Name</th>
                                    <th class="py-3 px-6 text-center">Date</th>
                                    <th class="py-3 px-6 text-center">Quantity</th>
                                    <th class="py-3 px-6 text-center">Total Weight</th>
                                    <th class="py-3 px-6 text-center">Total Amount</th>
                                    <!-- <th class="py-3 px-6 text-center">Action</th> -->
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light" v-for="sale in sales" :key="sale.id">

                                <tr  class="border-b border-gray-200 hover:bg-gray-100" >
                                    <td class="px-3 py-4 text-center">
                                        <Link :href="'/sales/'+sale.id" style="text-decoration: underline; color: blue;">
                                            00{{ sale.id }}
                                        </Link>
                                    </td>

                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ sale.customers.name }}</p>

                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{formattedDate(sale.created_at)}}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{sale.totalPigs}}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{sale.totalWeight}} kgs.</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">₱ {{sale.total_amount}}</p>
                                        </div>
                                    </td>


                                </tr>


                            </tbody>
                            <tfoot>

                                <tr>
                                    <th scope="row" colspan="5" class="hidden pt-6 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                       <p class="font-medium">Total Amount: </p>
                                    </th>
                                    <!-- <th scope="row" class="pt-6 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden">
                                        Total Amount
                                    </th> -->
                                    <td class="pt-6  text-sm text-center  sm:pr-6 md:pr-0">
                                       <p class="font-medium text-bold"><strong> ₱ {{ totalAmountAllSales }} </strong></p>
                                    </td>
                                </tr>


                            </tfoot>

                        </table>


                    </div>
                </div>


            </div>


   </SideBarLayout>
</template>
