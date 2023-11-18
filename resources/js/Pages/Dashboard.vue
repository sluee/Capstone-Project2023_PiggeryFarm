<script setup>
// import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import moment from 'moment'
import { ref, onMounted, watch, computed } from 'vue';
import Chart from 'chart.js/auto';


    const props = defineProps({
        sales:Object,
        totalAmountAllSales: Number,
        employeeCount:Number,
        pigsCount:Number,
        currentMonthSales :Array,
        percentageChange:Number,
        breedingCountReheat:Number,
        breedingCountAbort:Number,
        breedingCountLabor:Number,
        breedingCountTotal:Number,
        laborCount:Number,
        weaningCount:Number,
        totalNoPigsAlive:Number,
        totalNoPigsWeaned:Number
        // totalPigs: Number, // Assuming you have a totalPigs prop
        // totalWeight: Number,
    });

    function formattedDate(date){
        return moment(date).format('MMMM   D, YYYY');
    }

    const currentMonthSalesChart = ref(null);

    watch(() => props.currentMonthSales, () => {
    if (currentMonthSalesChart.value) {
        currentMonthSalesChart.value.destroy(); // Destroy the existing chart if it exists
    }

    createChart();
    });

    function createChart() {
    const ctx = document.getElementById('currentMonthSalesChart').getContext('2d');

    // Check if there are no sales data
        if (!props.currentMonthSales || props.currentMonthSales.length === 0) {
            // You can handle this case by displaying a message or taking any other action
            return;
        }

    const monthNames = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    currentMonthSalesChart.value = new Chart(ctx, {
        type: 'bar',
        data: {
        labels: props.currentMonthSales.map(item => `${monthNames[item.month - 1]} ${item.year}`),
        datasets: [
            {
            label: `Total Sales of ${monthNames[props.currentMonthSales[0].month - 1]}`, // Display the month name
            data: props.currentMonthSales.map(item => item.total_sales),
            backgroundColor: 'rgba(39,150,248,0.68)',
            borderColor: 'rgba(23, 68, 88, 1)',
            borderWidth: 1,
            },
        ],
        },
    });
    }

    onMounted(() => {
    createChart();
    });


    const isPositiveChange = computed(() => {
      return props.percentageChange !== null && props.percentageChange > 0;
    });

</script>

<template>
    <Head title="Dashboard" />

    <SideBarLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template> -->

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                        <div class="bg-blue-100 shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                           <div class="flex items-center">
                              <div class="flex-shrink-0">
                                 <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ employeeCount }}</span>
                                 <h3 class="text-base font-medium text-gray-900">No. of Employees</h3>
                              </div>
                              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                                 14.6%
                                 <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                 </svg>
                              </div>
                           </div>
                        </div>
                        <div class="bg-blue-100 shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                           <div class="flex items-center">
                              <div class="flex-shrink-0">
                                 <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ pigsCount }}</span>
                                 <h3 class="text-base font-medium text-gray-900">Total No. of Pigs</h3>
                              </div>
                              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                                 32.9%
                                 <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                 </svg>
                              </div>
                           </div>
                        </div>
                        <div class="bg-blue-100 shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                           <div class="flex items-center">
                              <div class="flex-shrink-0">
                                 <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">385</span>
                                 <h3 class="text-base font-normal text-gray-500">Total Feeds</h3>
                              </div>
                              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-red-500 text-base font-bold">
                                 -2.7%
                                 <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                 </svg>
                              </div>
                           </div>
                        </div>
                     </div>
                </div>
            </div>
            <div class="pt-8 px-2" >
                <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                   <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  ">
                      <div class="flex items-center justify-between mb-4">
                         <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">₱ {{ totalAmountAllSales }}</span>
                            <h3 class="text-base font-normal text-gray-500">Sales this month</h3>
                         </div>
                         <div v-if="percentageChange !== null">
                            <div :class="{ 'text-green-500': isPositiveChange, 'text-red-500': !isPositiveChange }" class="flex items-center justify-end flex-1 text-base font-bold">
                              {{ Math.min(Math.abs(percentageChange), 100).toFixed(2) }}%
                              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <template v-if="isPositiveChange">
                                  <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </template>
                                <template v-else>
                                  <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </template>
                              </svg>
                            </div>
                          </div>
                      </div>
                      <div id="main-chart">
                        <div v-if="props.currentMonthSales && props.currentMonthSales.length > 0">
                            <canvas id="currentMonthSalesChart"></canvas>
                        </div>
                        <div v-else>
                            No sales data available this month.
                        </div>
                    </div>

                   </div>
                   <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 2xl:col-span-2">
                      <div class="mb-4 flex items-center justify-between">
                         <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Latest Invoice</h3>
                            <span class="text-base font-normal text-gray-500">This is a list of latest Sales</span>

                         </div>
                         <div class="flex-shrink-0">
                            <a href="/histories" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
                         </div>
                      </div>
                      <div class="flex flex-col mt-8 ">
                         <div class="overflow-x-auto rounded-lg">
                            <div class="align-middle inline-block min-w-full">
                               <div class="shadow overflow-hidden sm:rounded-lg">
                                  <table class="min-w-full divide-y divide-gray-200">
                                     <thead class="bg-gray-50">
                                        <tr >
                                           <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                              Customer
                                           </th>
                                           <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                              Date
                                           </th>
                                           <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                              Quantity
                                           </th>
                                           <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                              Weight
                                           </th>
                                           <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                              Amount
                                           </th>
                                        </tr>
                                     </thead>
                                     <tbody class="bg-white">
                                        <tr v-for="sale in sales" :key="sale.id">
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                             <span class="font-normal">{{sale.customers.name}}</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              {{ formattedDate(sale.created_at) }}
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 text-center">
                                              {{ sale.totalPigs }}
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                              {{ sale.totalWeight }} kgs
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                            ₱ {{ sale.total_amount }}
                                           </td>
                                        </tr>

                                     </tbody>
                                  </table>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
            </div>
            <div class="pt-8 px-2" >
                <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                   <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  ">
                    
                        <div aria-label="header" class="flex items-center space-x-2">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-8 h-8 shrink-0"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          >
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M13 3l0 7l6 0l-8 11l0 -7l-6 0l8 -11"></path>
                          </svg>
                          <div class="space-y-0.5 flex-1">
                            <h3
                              class="font-medium text-lg tracking-tight text-gray-900 leading-tight"
                            >
                              Pigs Breeding this month
                            </h3>
                            <p class="text-sm font-normal text-gray-400 leading-none">
                              Breeding Summary
                            </p>
                          </div>
                          <a
                            href="/"
                            class="inline-flex items-center shrink-0 justify-center w-8 h-8 rounded-full text-white bg-gray-900 focus:outline-none"
                          >
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="w-5 h-5"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              stroke-width="1.5"
                              stroke="currentColor"
                              fill="none"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            >
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M17 7l-10 10"></path>
                              <path d="M8 7l9 0l0 9"></path>
                            </svg>
                          </a>
                        </div>
                        <div aria-label="content" class="mt-9 grid gap-2.5">
                            <a :href="route('breeding.index')">
                                <div
                                  class="flex items-center space-x-4 p-3.5 rounded-full bg-blue-100 "
                                >
                                  <span
                                    class="flex items-center justify-center w-10 h-10 shrink-0 rounded-full bg-white text-gray-900"
                                  >
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                    </svg>

                                  </span>
                                  <div class="flex flex-col flex-1">
                                    <h3 class="text-xl font-medium">Breeding <span class="inline-block px-3 text-sm leading-none text-gray-600 font-normal  first:pl-0"> | Sow Breed: {{breedingCountTotal }}</span></h3>
                                    <div class="divide-x divide-blue-900 mt-auto">
                                      <span
                                        class="inline-block px-3 text-xs leading-none text-gray-600 font-normal first:pl-0"
                                        >{{breedingCountReheat}} Reheat</span
                                      >
                                      <span
                                        class="inline-block px-3 text-xs leading-none text-gray-600 font-normal first:pl-0"
                                        >{{breedingCountLabor}} Labor</span
                                      >
                                      <span
                                        class="inline-block px-3 text-xs leading-none text-gray-600 font-normal first:pl-0"
                                        >{{breedingCountLabor}} Abort</span
                                      >
                                    </div>
                                  </div>
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 shrink-0"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  >
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 6l6 6l-6 6"></path>
                                  </svg>
                                </div>
                              </a>
                          <a :href="route('labor.index')">
                            <div
                              class="flex items-center space-x-4 p-3.5 rounded-full bg-blue-100"
                            >
                              <span
                                class="flex items-center justify-center w-10 h-10 shrink-0 rounded-full bg-white text-gray-900"
                              >
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                                </svg>
  
                              </span>
                              <div class="flex flex-col flex-1">
                                <h3 class="text-sm font-medium">Labor</h3>
                                <div class="divide-x divide-blue-900 mt-auto">
                                  <span
                                    class="inline-block px-3 text- leading-none text-gray-600 font-normal first:pl-0"
                                    >{{ laborCount }} Labored</span
                                  >
                                  <span
                                    class="inline-block px-3 text-xs leading-none text-gray-600 font-normal first:pl-0"
                                    >Piglet Alive: {{ totalNoPigsAlive }}</span
                                  >
                                </div>
                              </div>
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 shrink-0"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              >
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 6l6 6l-6 6"></path>
                              </svg>
                            </div>
                          </a>
                         
                          <a :href="route('weaning.index')">
                            <div
                              class="flex items-center space-x-4 p-3.5 rounded-full bg-blue-100"
                            >
                              <span
                                class="flex items-center justify-center w-10 h-10 shrink-0 rounded-full bg-white text-gray-900"
                              >
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                </svg>
  
                              </span>
                              <div class="flex flex-col flex-1">
                                <h3 class="text-xl font-medium">Weaning</h3>
                                <div class="divide-x divide-blue-900 mt-auto">
                                  <span
                                    class="inline-block px-3 text-xs leading-none text-gray-600 font-normal first:pl-0"
                                    >{{ weaningCount }} Weaned</span
                                  >
                                  <span
                                    class="inline-block px-3 text-xs leading-none text-gray-600 font-normal first:pl-0"
                                    >Piglet Weaned: {{ totalNoPigsWeaned }}</span
                                  >
                                </div>
                              </div>
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 shrink-0"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              >
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 6l6 6l-6 6"></path>
                              </svg>
                            </div>
                          </a>
                        </div>
                   </div>
                   <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 2xl:col-span-2">
                      
                    </div>
                </div>
            </div>


        </div>

    </SideBarLayout>
</template>
