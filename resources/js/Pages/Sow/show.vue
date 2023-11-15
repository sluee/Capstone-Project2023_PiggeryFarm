<template>
    <Head title="View Sow" />

    <SideBarLayout>
        <template #header>
            <!-- <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">View Sow</h2>
                <div style="position:relative">
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-9 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search customer history here" v-model="search">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#444  " width="20px" height="20px" viewBox="0 0 16 16"
                    style="position:absolute; top:10px; right:10px">
                    <path d="M12.027 9.92L16 13.95 14 16l-4.075-3.976A6.465 6.465 0 0 1 6.5 13C2.91 13 0 10.083 0 6.5 0 2.91 2.917 0 6.5 0 10.09 0 13 2.917 13 6.5a6.463 6.463 0 0 1-.973 3.42zM1.997 6.452c0 2.48 2.014 4.5 4.5 4.5 2.48 0 4.5-2.015 4.5-4.5 0-2.48-2.015-4.5-4.5-4.5-2.48 0-4.5 2.014-4.5 4.5z" fill-rule="evenodd"/>
                    </svg>
                </div>
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded mr-3" as="button" :href="'/sows/'">Back</Link>
            </div>
        </template> -->
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sows</h2>
            <div style="position:relative">
                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-9 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search sow here" v-model="search">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#444  " width="20px" height="20px" viewBox="0 0 16 16"
                style="position:absolute; top:10px; right:10px">
                <path d="M12.027 9.92L16 13.95 14 16l-4.075-3.976A6.465 6.465 0 0 1 6.5 13C2.91 13 0 10.083 0 6.5 0 2.91 2.917 0 6.5 0 10.09 0 13 2.917 13 6.5a6.463 6.463 0 0 1-.973 3.42zM1.997 6.452c0 2.48 2.014 4.5 4.5 4.5 2.48 0 4.5-2.015 4.5-4.5 0-2.48-2.015-4.5-4.5-4.5-2.48 0-4.5 2.014-4.5 4.5z" fill-rule="evenodd"/>
                </svg>
            </div>
            <div class="flex">
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded mr-3" as="button" :href="'/sows/'">Back</Link>
                <!-- <a href="/sows/pdf" class="flex  mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded mr-3 " target="blank">
                    <svg viewBox="0 0 512 512" version="1.1" height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#6666"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>pdf-document</title> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="add" fill="#000000" transform="translate(85.333333, 42.666667)"> <path d="M75.9466667,285.653333 C63.8764997,278.292415 49.6246897,275.351565 35.6266667,277.333333 L1.42108547e-14,277.333333 L1.42108547e-14,405.333333 L28.3733333,405.333333 L28.3733333,356.48 L40.5333333,356.48 C53.1304778,357.774244 65.7885986,354.68506 76.3733333,347.733333 C85.3576891,340.027178 90.3112817,328.626053 89.8133333,316.8 C90.4784904,304.790173 85.3164923,293.195531 75.9466667,285.653333 L75.9466667,285.653333 Z M53.12,332.373333 C47.7608867,334.732281 41.8687051,335.616108 36.0533333,334.933333 L27.7333333,334.933333 L27.7333333,298.666667 L36.0533333,298.666667 C42.094796,298.02451 48.1897668,299.213772 53.5466667,302.08 C58.5355805,305.554646 61.3626692,311.370371 61.0133333,317.44 C61.6596233,323.558965 58.5400493,329.460862 53.12,332.373333 L53.12,332.373333 Z M150.826667,277.333333 L115.413333,277.333333 L115.413333,405.333333 L149.333333,405.333333 C166.620091,407.02483 184.027709,403.691457 199.466667,395.733333 C216.454713,383.072462 225.530463,362.408923 223.36,341.333333 C224.631644,323.277677 218.198313,305.527884 205.653333,292.48 C190.157107,280.265923 170.395302,274.806436 150.826667,277.333333 L150.826667,277.333333 Z M178.986667,376.32 C170.098963,381.315719 159.922142,383.54422 149.76,382.72 L144.213333,382.72 L144.213333,299.946667 L149.333333,299.946667 C167.253333,299.946667 174.293333,301.653333 181.333333,308.053333 C189.877212,316.948755 194.28973,329.025119 193.493333,341.333333 C194.590843,354.653818 189.18793,367.684372 178.986667,376.32 L178.986667,376.32 Z M254.506667,405.333333 L283.306667,405.333333 L283.306667,351.786667 L341.333333,351.786667 L341.333333,329.173333 L283.306667,329.173333 L283.306667,299.946667 L341.333333,299.946667 L341.333333,277.333333 L254.506667,277.333333 L254.506667,405.333333 L254.506667,405.333333 Z M234.666667,7.10542736e-15 L9.52127266e-13,7.10542736e-15 L9.52127266e-13,234.666667 L42.6666667,234.666667 L42.6666667,192 L42.6666667,169.6 L42.6666667,42.6666667 L216.96,42.6666667 L298.666667,124.373333 L298.666667,169.6 L298.666667,192 L298.666667,234.666667 L341.333333,234.666667 L341.333333,106.666667 L234.666667,7.10542736e-15 L234.666667,7.10542736e-15 Z" id="document-pdf"> </path> </g> </g> </g></svg>
                        Export
                </a> -->
            </div>
        </div>
        </template>

        <div class="py-12">
            <div class="flex -mx-2">
                <div class="w-1/3 ml-2 ">
                    <div class=" pr-6">
                        <h4 class="text-center text-xl font-bold text-navy-700 dark:text-black">
                            Sow's Details
                        </h4>
                            <div class="w-80 m-auto lg:mt-2 max-w-sm">
                            <img src="https://images.unsplash.com/photo-1511367461989-f85a21fda167?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80" alt="" class="rounded-sm shadow-xl lg:w-full 2xl:w-full 2xl:h-44 object-cover"/>
                                <h2 class="text-center text-gray-800 text-2xl font-bold pt-2 mb-2">Sow: {{ sows.sow_no }} </h2>
                                <div class="w-5/6 m-auto">
                                <p class=" text-gray-500 ">
                                    <span class="font-bold text-gray-900">
                                    Location :
                                    </span> {{ sows.location }}
                                </p>
                                <p class=" text-gray-500">
                                    <span class="font-bold text-gray-900">
                                        Arrival Date:
                                    </span> {{ formattedDate(sows.date_arrived) }} </p>
                                </div>
                                <!-- <div class="grid grid-cols-4 w-72 lg:w-6/6 m-auto bg-indigo-50 mt-5 p-4 lg:p-4 rounded-2xl">
                                    <div class="col-span-1">
                                        <img class="w-15 lg:w-12" src="https://i.pinimg.com/236x/d6/19/93/d61993f7fb1260300645192c2a0f7dc8.jpg" alt="music icon"/>
                                    </div>
                                    <div class="col-span-2 pt-1">
                                        <p class="text-gray-800 font-bold lg:text-sm">Credit Limit</p>
                                        <p class="text-gray-500 text-sm">PHP {{ client.credit_limit }}</p>
                                    </div>
                                </div> -->
                                <div class="flex justify-between mt-3 ml-2 mr-4">
                                    <DangerButton  class="mr-2">
                                        Deactivate Sow
                                    </DangerButton>
                                    <PrimaryButton >Activate Sow</PrimaryButton>
                                </div>

                            </div>

                        <!-- <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 ">
                            <div class="bg-blue-200  shadow-lg sm:rounded-lg">
                                <div class="p-6 text-gray-900 flex">

                                    <div class="flex-1 ml-4 bg-">
                                        <div class="flex">
                                            <h3 class="text-xl flex-1 ">Details of Sow</h3>

                                        </div>
                                        <hr>
                                        <div class="mt-2" ><strong>Sow:</strong>  {{ sows.sow_no }} </div>
                                        <div class="mt-2" ><strong>Origin</strong>  {{sows.location }} </div>
                                        <div class="mt-2"><strong>Date arrived</strong> {{ formattedDate(sows.date_arrived) }}</div>

                                    </div>

                                </div>
                            </div>
                        </div> -->
                    </div>
                  </div>
                  <div class="w-3/4 ">
                    <div class="max-w-8xl mx-auto sm:px-6 lg:px-7">
                        <div class="bg-blue-200 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="flex">
                                <h3 class="text-xl flex-1 dark:text-black">Sow's History</h3>

                            </div>

                            <!-- component -->

                        <ul class="mx-auto grid max-w-full w-full grid-cols-3 gap-x-5 px-8">
                            <li class="">
                                <input class="peer sr-only" type="radio" value="yes" name="answer" id="yes" checked />
                                <label class="flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-indigo-500 transition-all duration-500 ease-in-out" for="yes">Breeding</label>

                                    <div class=" bg-white shadow-lg left-0 p-6 border mt-2 overflow-x-auto  border-indigo-300 rounded-lg w-[50vw] mx-auto transition-all duration-500 ease-in-out translate-x-40 opacity-0 invisible peer-checked:opacity-100 peer-checked:visible peer-checked:translate-x-1">
                                        <div class="flex">
                                            <h3 class="text-xl flex-1  dark:text-black">Sow's Breeding History</h3>

                                        </div>
                                        <div class="bg-white shadow-sm sm:rounded-lg">
                                            <table class="min-w-max w-full table-auto">
                                                <thead>
                                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">

                                                        <th class="py-3 px-4 text-left">Boar</th>
                                                        <th class="py-3 px-4 text-center">Breeding Date</th>
                                                        <th class="py-3 px-4 text-center"> Remarks </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 text-sm font-light" >

                                                    <tr  class="border-b border-gray-200 hover:bg-gray-100"  v-for="breed in sows.breedings" :key="breed.id">
                                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                                            <div class="flex items-center">

                                                                <p class="font-medium">{{ breed.boar.breed }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-3 px-6 text-center whitespace-nowrap">
                                                            <div class="flex items-center justify-center">

                                                                <p class="font-medium text-center">{{ formattedDate(breed.date_of_breed) }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-3 px-6 text-center">
                                                            <div class="flex justify-center mb-2">
                                                                <span v-if="breed.remarks ==='Laboring'" class="text-md font-semibold text-green-500">Labored</span>
                                                                <span v-if="breed.remarks ==='Abort'" class="text-md font-semibold text-blue-500">Aborted</span>
                                                                <span v-if="breed.remarks ==='Reheat'" class="text-md font-semibold text-red-500">Reheat</span>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                </tbody>

                                            </table>
                                        </div>
                                </div>
                            </li>

                            <li class="">
                                <input class="peer sr-only" type="radio" value="no" name="answer" id="no" />
                                <label class="flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-indigo-500 transition-all duration-500 ease-in-out" for="no">Labor</label>

                                    <div class="bg-white shadow-lg left-0 p-6 border mt-2 border-indigo-300 rounded-lg w-[50vw] mx-auto transition-all duration-500 ease-in-out translate-x-40 opacity-0 invisible peer-checked:opacity-100 peer-checked:visible peer-checked:translate-x-1">
                                        <div class="flex">
                                            <h3 class="text-xl flex-1  dark:text-black">Sow's Labor History</h3>

                                        </div>
                                        <table class="min-w-max w-full table-auto">
                                            <thead>
                                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">

                                                    <th class="py-3 px-4 text-left">Parity no</th>
                                                    <th class="py-3 px-4 text-left">Act Farrowing Date</th>
                                                    <th class="py-3 px-4 text-left">No of Pigs Born</th>
                                                    <th class="py-3 px-4 text-left">No of Pigs Alive</th>
                                                    <th class="py-3 px-4 text-left">Weaning Date </th>
                                                    <th class="py-3 px-4 text-left"> Remarks </th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 text-sm font-light" >

                                                <!-- <tr  class="border-b border-gray-200 hover:bg-gray-100"  v-for="sale in customer.sales_items" :key="sale.id">
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
                                                </tr> -->

                                            </tbody>

                                        </table>
                                </div>
                            </li>

                            <li class="">
                                <input class="peer sr-only" type="radio" value="yesno" name="answer" id="yesno" />
                                <label class="flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-indigo-500 transition-all duration-500 ease-in-out " for="yesno">Weaning</label>

                                    <div class=" bg-white shadow-lg left-0 p-6 border mt-2 border-indigo-300 rounded-lg w-[50vw] mx-auto transition-all duration-500 ease-in-out translate-x-40 opacity-0 invisible peer-checked:opacity-100 peer-checked:visible peer-checked:translate-x-1">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, voluptatum! Sequi consequatur error nulla quaerat rem fugit provident tempore nihil a aspernatur ad laboriosam, dolor nisi qui? Esse, mollitia? Nostrum?
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, voluptatum! Sequi consequatur error nulla quaerat rem fugit provident tempore nihil a aspernatur ad laboriosam, dolor nisi qui? Esse, mollitia? Nostrum?
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, voluptatum! Sequi consequatur error nulla quaerat rem fugit provident tempore nihil a aspernatur ad laboriosam, dolor nisi qui? Esse, mollitia? Nostrum?
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, voluptatum! Sequi consequatur error nulla quaerat rem fugit provident tempore nihil a aspernatur ad laboriosam, dolor nisi qui? Esse, mollitia? Nostrum?
                                </div>
                            </li>
                        </ul>



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
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';


const props = defineProps({
    sows: Object,




})

function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
}

// let search = ref(props.filters.search);
//     watch(search, (value) => {
//         router.get(
//             "/customers/{customer}",
//             { search: value },
//             {
//                 preserveState: true,
//                 replace: true,
//             }
//         );
//     });


</script>
