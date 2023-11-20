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
        if (!props.currentMonthSales || props.currentMonthSales.length === 0) {
            // You can handle this case by displaying a message or taking any other action
            return;
        }
    const ctx = document.getElementById('currentMonthSalesChart').getContext('2d');

    // Check if there are no sales data


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
                              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-blue-500 text-base font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
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
                              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-blue-900 text-base font-bold">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                  </svg> -->
                                  <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    class="w-13 h-12" viewBox="0 0 512 512"  xml:space="preserve">

                                <g>
                                    <path class="st0" style="fill: rgb(42, 95, 201);" d="M507.317,91.987c-3.734-1.406-7.891,0.5-9.297,4.219c-2.047,5.406-4.328,9.813-6.719,13.344
                                        c-2.063,3.109-4.219,5.516-6.375,7.406c0-0.188,0.016-0.406,0.016-0.625c0-5.391-0.719-10.172-2.109-14.391
                                        c-2.047-6.313-5.672-11.313-10.203-14.563c-4.516-3.297-9.781-4.781-14.813-4.781c-5.547,0-10.891,1.75-15.328,4.969
                                        c-2.188,1.656-4.172,3.672-5.719,6.063s-2.688,5.156-3.234,8.141c-0.25,1.375-0.359,2.766-0.359,4.125
                                        c0,4.406,1.203,8.594,3.188,12.344c2.969,5.625,7.625,10.375,13.313,13.828c3.328,2.016,7.016,3.578,10.953,4.547
                                        c-0.234,0.188-0.438,0.391-0.688,0.609c-5.969,4.922-14.203,9.047-22.922,11.891c-52.688-72.813-169.422-97.609-267.891-42.766
                                        c-11.203,6.234-21.234,12.719-30.375,19.203c-24.703-29.719-86.891-34.703-78.875-11.578c7.25,20.953,17.922,43.938,22.906,57.547
                                        c-18.688,15.75-35.984,27.953-58.688,32.172c-20.734,3.875-26.891,9.375-23,29.641l8.578,67.828c0,0,24.172,13.969,32.734,18.703
                                        c18.922,10.453,56.125,33.25,111.109,50.188l20.844,65.375h52.156v-49.265c20.828,2.891,43.234,4.594,67.266,4.594
                                        c12.484,0,24.219-0.844,35.25-2.422v47.093h52.141l24.234-75.968c57.672-40.75,71.907-113.672,51.532-172.266
                                        c-3.156-9.016-7.125-17.547-11.813-25.625c7.781-2.859,15.234-6.594,21.641-11.375c4.797-3.578,9.016-7.75,12.219-12.641
                                        c0.313-0.469,0.625-0.969,0.906-1.453c0.516-0.172,1.031-0.297,1.547-0.484c6-2.125,11.828-6,16.953-11.688
                                        c5.109-5.688,9.563-13.172,13.141-22.641C512.942,97.565,511.052,93.393,507.317,91.987z M470.38,119.893
                                        c-0.094,1.156-0.266,2.25-0.563,3.359c-0.141,0-0.281,0-0.406,0c-2.906,0-5.766-0.578-8.438-1.641
                                        c-3.984-1.563-7.5-4.188-9.875-7.125c-1.172-1.469-2.078-3-2.641-4.453c-0.578-1.469-0.859-2.859-0.859-4.141
                                        c0-0.531,0.063-1.047,0.141-1.531c0.203-1.078,0.578-2,1.141-2.875c0.828-1.266,2.078-2.375,3.656-3.203
                                        c1.578-0.797,3.438-1.25,5.281-1.25c1.5,0,2.969,0.281,4.344,0.875c1.031,0.453,2,1.063,2.938,1.906
                                        c1.375,1.266,2.672,3.047,3.703,5.719c1,2.641,1.703,6.188,1.703,10.797C470.505,117.456,470.458,118.643,470.38,119.893z"/>
                                </g>
                                </svg>
                              </div>
                           </div>
                        </div>
                        <div class="bg-blue-100 shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                           <div class="flex items-center">
                              <div class="flex-shrink-0">
                                 <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">385 pc/s</span>
                                 <h3 class="text-base font-normal text-gray-500">Total Feeds</h3>
                              </div>
                              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-blue-500 text-base font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
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
                   <!-- <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 2xl:col-span-2">
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
                   </div> -->
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

                    </div>
                    <div aria-label="content" class="mt-5 grid gap-2.5">
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
                                class="inline-block px-3 text-xs leading-none text-gray-600 font-normal first:pl-0"
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
                </div>
            </div>
            <div class="pt-8 px-2" >
                <div class="w-full grid grid-cols-1 xl:grid-cols-1 2xl:grid-cols-3 gap-4">
                   <!-- <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  ">

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

                        </div>
                        <div aria-label="content" class="mt-5 grid gap-2.5">
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
                                    class="inline-block px-3 text-xs leading-none text-gray-600 font-normal first:pl-0"
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
                   </div> -->
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
                                           <td class="p-4 text-left whitespace-nowrap text-sm font-normal text-gray-500">
                                              {{ formattedDate(sale.created_at) }}
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 text-left">
                                              {{ sale.totalPigs }} pc/s
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
                   <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 2xl:col-span-2">

                    </div>
                </div>
            </div>


        </div>

    </SideBarLayout>
</template>
