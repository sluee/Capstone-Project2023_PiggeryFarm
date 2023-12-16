<template>

    <Head title="Sales Reports" />

    <SideBarLayout>
        <div class="py-6">
            <div class="flex justify-center mb-2">
                <div>
                    <img src="/images/logo.png" alt="Logo" class="w-[70px] h-[70px] rounded-full object-cover">
                </div>
                <div class="text-sm">
                    <h3 class="font-bold text-slate-700">RQR Piggery Farm || Saint Agustin Piggery Farm</h3>
                    <h3 class="font-bold text-slate-700 text-center">San Agustin, Sagbayan, Bohol</h3>
                    <h3 class="font-bold text-slate-700 text-center">Canmaya Centro, Sagbayan, Bohol</h3>
                    <br>
                    <h3 class="font-bold text-slate-700 text-center text-lg">Sales Report for  {{ currentMonthAndYear }}</h3>
                    <br>
                </div>

            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

               
                    <p class="text-justify">
                        In this report for <strong>{{ currentMonthAndYear }}</strong>, we're happy to share that we successfully sold a total of 
                        <strong>{{ totalWeightAllPigs }} kilograms</strong> of pigs, bringing in <strong>₱{{ totalAmountAllSales }}</strong>.
                
                        The report gives a simple summary of all our sales, showing the total weight of pigs sold, how many pigs were in each sale, and the overall sales amount. Our main goal is to be clear and open, helping everyone involved understand how well our sales are going.
                        <br>Here are the list of the sales of the month:
                       
                    </p>
              
                

                <p></p>

                <!-- Display individual sales data as needed -->
                <!-- <ul>
                  <li v-for="sale in allSales" :key="sale.id">
                    Sale ID: {{ sale.id }} | Total Weight: {{ sale.totalWeight }} | Total Pigs: {{ sale.totalPigs }}
                  </li>
                </ul> -->

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Sale Id</th>
                                <th class="py-3 px-6 text-left">Customer</th>
                                <th class="py-3 px-6 text-center">Total Pigs</th>
                                <th class="py-3 px-6 text-center">Total Weight</th>
                                <th class="py-3 px-6 text-center">Total Amount</th>

                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light" >

                            <tr  class="border-b border-gray-200 hover:bg-gray-100" v-for="sale in allSales.data" :key="sale.id">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">

                                        <p class="font-medium">{{ sale.id }}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <p class="font-medium">{{ sale.customers.name }}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        <p class="font-medium">{{ sale.totalPigs}}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        <p class="font-medium">{{ sale.totalWeight}}</p>
                                    </div>

                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        <p class="font-medium"> ₱ {{ sale.total_amount}}</p>
                                    </div>

                                </td>



                            </tr>
                        </tbody>
                    </table>
                    
                </div>
               
                <div class="text-end mt-5">
                    <p class="font-bold">Total Weight of All Pigs: {{ totalWeightAllPigs }} kgs</p> 
                    <p class="font-bold">Total Amount of All Sales: ₱ {{ totalAmountAllSales }}</p>
                </div>
                <Pagination v-if="allSales.data.length >0" :links="allSales.links" class="mt-6 flex justify-center"/>

            </div>

        </div>
    </SideBarLayout>
</template>

<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, router, useForm } from '@inertiajs/vue3';
    import Pagination from '@/Components/Pagination.vue';

    const props = defineProps({
        allSales:Object,
        totalWeightAllPigs:Number,
        totalAmountAllSales:Number,
        currentMonthAndYear:String

    })
</script>


