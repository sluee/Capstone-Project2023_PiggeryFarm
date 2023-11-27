<template>
    <Head title="View Boar" />

    <SideBarLayout>

        <template #header>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-1">View Boar</h2>
                <Breadcrumb :crumbs="crumbs"  />
            </div>

        </template>
        <div class="py-6">
            <div class="flex ">
                <div class="w-1/3 ml-2 ">
                    <div class=" pr-6">
                        <h4 class="text-center text-xl font-bold text-navy-700 dark:text-black">
                            Boar's Details
                        </h4>
                            <div class="w-80 m-auto lg:mt-2 max-w-sm">
                            <img src="https://images.unsplash.com/photo-1550825570-1959166c6e66?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="rounded-sm shadow-xl lg:w-full 2xl:w-full 2xl:h-44 object-cover"/>
                                <h2 class="text-center text-gray-800 text-2xl font-bold pt-2 mb-2">Boar: {{ boar.boar_no }} </h2>
                                <div class="w-5/6 m-auto">
                                <p class=" text-gray-500 ">
                                    <span class="font-bold text-gray-900">
                                    Breed :
                                    </span> {{ boar.breed }}
                                </p>
                                <p class=" text-gray-500 ">
                                    <span class="font-bold text-gray-900">
                                    Location :
                                    </span> {{ boar.location }}
                                </p>
                                <p class=" text-gray-500">
                                    <span class="font-bold text-gray-900">
                                        Arrival Date:
                                    </span> {{ formattedDate(boar.date_arrived) }} </p>
                                </div>

                                <div class="flex justify-center mt-3 ml-2 mr-4" v-if="boar.status===1">
                                    <Link class="border border-red-500 bg-red-500 text-white rounded-md px-3 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" as="button" method="POST"  :href="'/boars/deactivate/'+ boar.id" >Deactivate Boar</Link>

                                </div>
                                <div class="flex justify-center mt-3 ml-2 mr-4" v-if="boar.status===0">
                                    <Link class="border border-green-500 bg-green-500 text-white rounded-md px-3 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline" as="button" method="POST" :href="'/boars/activate/'+ boar.id" >Activate Boar</Link>
                                </div>

                            </div>
                    </div>
                </div>

                    <div class="w-3/4 ">
                    <h4 class="text-center text-xl font-bold text-navy-700 dark:text-black">
                        Boar's Breeding History
                    </h4>
                    <div ref="tabs" class="p-8">
                        <div class="max-w-full mx-auto">
                        <div class="mb-4 flex space-x-4 p-2 bg-white rounded-lg shadow-md">
                            <button @click="openTab = 1" :class="{ 'bg-blue-600 text-white': openTab === 1 }" class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300">
                            Breedings
                            </button>
                            <button @click="openTab = 2" :class="{ 'bg-blue-600 text-white': openTab === 2 }" class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300">
                            Labors
                            </button>
                            <button @click="openTab = 3" :class="{ 'bg-blue-600 text-white': openTab === 3 }" class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300">
                            Weanings
                            </button>
                        </div>

                        <div v-show="openTab === 1" class="transition-all duration-300 bg-white p-4 rounded-lg shadow-md border-l-4 border-blue-600">
                            <h2 class="text-xl font-semibold mb-2 text-blue-600">Breedings</h2>

                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-2 px-2">Sow No.</th>
                                        <th class="py-2 px-2">Date Of Breed</th>
                                        <th class="py-2 px-2">Exp Farrowing Date</th>
                                        <th class="py-2 px-2">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="bred in breedings.data" :key="bred.id">
                                        <td class="py-2 px-2 text-center whitespace-nowrap">
                                            <p class="font-sm  text-sm">{{ bred.sow.sow_no }}</p>
                                        </td>
                                        <td class="py-2 px-2">
                                            <p class="font-sm text-sm text-center">{{ formattedDate(bred.date_of_breed) }}</p >
                                        </td>
                                        <td class="py-2 px-2">
                                            <p class="font-sm text-center  text-sm">{{ formattedDate(bred.exp_date_of_farrowing) }}</p >
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex justify-center mb-2  text-sm">
                                                <span v-if="bred.remarks ==='Waiting for results'" class="text-md font-semibold text-green-500">Waiting for result</span>
                                                <span v-if="bred.remarks ==='Laboring'" class="text-md font-semibold text-green-500">Labored</span>
                                                <span v-if="bred.remarks ==='Abort'" class="text-md font-semibold text-blue-500">Aborted</span>
                                                <span v-if="bred.remarks ==='Reheat'" class="text-md font-semibold text-red-500">Reheat</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination :links="breedings.links" class="mt-6 flex justify-center"/>

                        </div>

                        <div v-show="openTab === 2" class="transition-all duration-300 bg-white p-4 rounded-lg shadow-md border-l-4 border-blue-600">
                            <h2 class="text-xl font-semibold mb-2 text-blue-600">Labors</h2>
                                <table class="w-full table-auto">
                                    <thead>
                                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                            <th class="py-2 px-2">Breeding ID</th>
                                            <th class="py-2 px-2">Actual Farrowing Date</th>
                                            <th class="py-2 px-2">Pigs Born</th>
                                            <th class="py-2 px-2">Pigs Alive</th>
                                            <th class="py-2 px-2">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="lab in labors.data" :key="lab.id">
                                            <td class="py-2 px-2 text-left whitespace-nowrap">
                                                <p class="font-sm text-center  text-sm">{{ lab.id }}</p >
                                            </td>
                                            <td class="py-2 px-2">
                                                <p class="font-sm text-center  text-sm">{{ formattedDate(lab.actual_date_farrowing) }}</p >
                                            </td>
                                            <td class="py-2 px-2 text-left whitespace-nowrap">
                                                <p class="font-sm text-center  text-sm">{{ lab.no_pigs_born }}</p >
                                            </td>
                                            <td class="py-2 px-2 text-left whitespace-nowrap">
                                                <p class="font-sm text-center  text-sm">{{ lab.no_pigs_alive }}</p >
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <div class="flex justify-center mb-2  text-sm">
                                                    <span v-if="lab.remarks ==='Weaned'" class="text-md font-semibold text-green-500">Weaned</span>
                                                    <span v-if="lab.remarks ==='Waiting for results'" class="text-md font-semibold text-blue-500">Waiting for results</span>
                                                    <span v-if="lab.remarks ===''" class="text-md font-semibold text-red-500">N/A</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination :links="labors.links" class="mt-6 flex justify-center"/>

                        </div>

                        <div v-show="openTab === 3" class="transition-all duration-300 bg-white p-4 rounded-lg shadow-md border-l-4 border-blue-600">
                            <h2 class="text-xl font-semibold mb-2 text-blue-600">Weanings</h2>

                                <table class="w-full table-auto">
                                    <thead>
                                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                            <th class="py-2 px-2">Labor ID</th>
                                            <th class="py-2 px-2">No of Pigs Born</th>
                                            <th class="py-2 px-2">No of Pigs Alive</th>
                                            <th class="py-2 px-2">No of Pigs Weaned</th>
                                            <th class="py-2 px-2">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="wean in weanings.data" :key="wean.id">
                                            <td class="py-2 px-2 text-left whitespace-nowrap">
                                                <p class="font-sm text-center  text-sm">{{ wean.labors.id }}</p >
                                            </td>
                                            <td class="py-2 px-2 text-left whitespace-nowrap">
                                                <p class="font-sm text-center  text-sm">{{ wean.labors.no_pigs_born }}</p >
                                            </td>
                                            <td class="py-2 px-2 text-left whitespace-nowrap">
                                                <p class="font-sm text-center  text-sm">{{ wean.labors.no_pigs_alive }}</p >
                                            </td>
                                            <td class="py-2 px-2">
                                                <p class="font-sm text-center  text-sm">{{ wean.no_of_pigs_weaned}}</p >
                                            </td>
                                            <td class="py-2 px-2 text-center whitespace-nowrap">
                                                <p class="text-md font-semibold text-green-500  text-sm">{{ wean.remarks }}</p >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination :links="weanings.links" class="mt-6 flex justify-center"/>

                            </div>
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

import Breadcrumb from '@/Components/Breadcrumbs.vue'

const props = defineProps({
    boar: Object,
    breedings:Object,
    labors:Object,
    weanings:Object
})
const crumbs = [
    {
        name: 'Dashboard',
        url: '/dashboard',
        active: false,
    },
    {
        name: 'List of Sows',
        url: '/boars',
        active: false,
    },
    {
        name:  "Showing Boar #"+ props.boar.id ,
        url: null,
        active: true,
    },
    ]
function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
}
const openTab = ref(1);

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
