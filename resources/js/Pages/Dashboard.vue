<script setup>
// import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
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
                                 <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">2,340</span>
                                 <h3 class="text-base font-normal text-gray-500">No of Employees</h3>
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
                                 <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">5,355</span>
                                 <h3 class="text-base font-normal text-gray-500">Total No of Pigs</h3>
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
            <div class="pt-6 px-4">
                <div class="w-full grid grid-cols-1 xl:grid-cols-3 2xl:grid-cols-3 gap-4">
                   <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  ">
                      <div class="flex items-center justify-between mb-4">
                         <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">₱45,385</span>
                            <h3 class="text-base font-normal text-gray-500">Sales this month</h3>
                         </div>
                         <div class="flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                            12.5%
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                         </div>
                      </div>
                      <div id="main-chart">Chart here</div>
                   </div>
                   <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 2xl:col-span-2">
                      <div class="mb-4 flex items-center justify-between">
                         <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Latest Invoice</h3>
                            <span class="text-base font-normal text-gray-500">This is a list of latest Sales</span>
                         </div>
                         <div class="flex-shrink-0">
                            <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
                         </div>
                      </div>
                      <div class="flex flex-col mt-8 ">
                         <div class="overflow-x-auto rounded-lg">
                            <div class="align-middle inline-block min-w-full">
                               <div class="shadow overflow-hidden sm:rounded-lg">
                                  <table class="min-w-full divide-y divide-gray-200">
                                     <thead class="bg-gray-50">
                                        <tr>
                                           <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                              Customer
                                           </th>
                                           <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                              Date
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
                                        <tr>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                              Payment from <span class="font-semibold">Bonnie Green</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              Apr 23 ,2021
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              300
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              ₱2300
                                           </td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                              Payment refund to <span class="font-semibold">#00910</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              Apr 23 ,2021
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              60
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              ₱670
                                           </td>
                                        </tr>
                                        <tr>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                              Payment failed from <span class="font-semibold">#087651</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              Apr 18 ,2021
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              234
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              ₱234
                                           </td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                              Payment from <span class="font-semibold">Lana Byrd</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              Apr 15 ,2021
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              80
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              ₱5000
                                           </td>
                                        </tr>
                                        <tr>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                              Payment from <span class="font-semibold">Jese Leos</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              Apr 15 ,2021
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              70
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              ₱2300
                                           </td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                              Payment from <span class="font-semibold">THEMESBERG LLC</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              Apr 11 ,2021
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              90
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              ₱560
                                           </td>
                                        </tr>
                                        <tr>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                              Payment from <span class="font-semibold">Lana Lysle</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              Apr 6 ,2021
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              37
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              ₱1437
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
        </div>

    </SideBarLayout>
</template>
