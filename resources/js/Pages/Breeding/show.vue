<template>
    <Head title="View Breedings" />

    <SideBarLayout>
       

        <div class="py-12 px-4">
            <div class="flex justify-between">
                <Breadcrumb :crumbs="crumbs" class="mb-4" />
                
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded mr-3" as="button" :href="'/breedings/'">Back</Link>
            </div>
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 ">
               
                <div class="bg-white  shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex">

                        <div class="flex-1 ml-4 bg-">
                            <div class="flex">
                                <h3 class="text-2xl flex-1 ">Details of Breeding</h3>

                            </div>
                            <hr>
                            <div class="mt-2" ><strong>Sow:</strong>  {{ breeding.sow.sow_no }} </div>
                            <div class="mt-2" ><strong>Boar Breed:</strong>  {{ breeding.boar.breed }} </div>
                            <div class="mt-2"><strong>Date of Breed:</strong> {{ formattedDate(breeding.date_of_breed) }}</div>
                            <div class="mt-2"> <strong>Possible Reheat:</strong> {{ formattedDate(breeding.possible_reheat) }}</div>
                            <div class="mt-2"><strong>Lactating Feeds Date:</strong> {{ formattedDate(breeding.changeFeeds) }}</div>
                            <div class="mt-2"><strong>Expected Date of Farrowing:</strong> {{formattedDate (breeding.exp_date_of_farrowing)}}</div>
                            <div class="mt-2"><strong>Expected Date of Farrowing:</strong> {{breeding.remarks}}</div>
                        </div>
                        <div v-if="breeding.remarks== 'Waiting for results'">
                            <Link class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline" as="button"  :href="'/labors/create/'+ breeding.id" >Labor</Link>
                            <Link
                                as="button" :href="'/breedings/reheat/' + breeding.id" method="post"
                                class="border border-red-500 bg-red-500 text-white rounded-md px-3 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline"
                            >
                            Reheat
                          </Link>
                            <Link
                                as="button" :href="'/breedings/abort/' + breeding.id" method="post"
                                class="border border-blue-500 bg-blue-500 text-white rounded-md px-3 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-600 focus:outline-none focus:shadow-outline"
                            >
                            Abort
                          </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </SideBarLayout>
</template>

<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import moment from 'moment'
// import { ref } from 'vue';
import {Head, Link, useForm} from '@inertiajs/vue3'
import Breadcrumb from '@/Components/Breadcrumbs.vue';

const props = defineProps({
    breeding: Object,
    sow:Object,
    boar:Object

})

function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
}
const crumbs = [
        {
            name: 'Dashboard',
            url: '/dashboard',
            active: false,
        },
        {
            name: 'List of Breedings',
            url: '/breedings',
            active: false,
        },
        {
            name:  "Breeding no "+ props.breeding.id ,
            url: null,
            active: true,
        },
    ]


</script>
