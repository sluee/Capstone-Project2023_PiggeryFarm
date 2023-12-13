<template>

    <Head title="Feeds" />

    <SideBarLayout>
        <template #header >
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">List of logs</h2>
                <!-- <div style="position:relative">
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-9 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search feeds here" v-model="search">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#444  " width="20px" height="20px" viewBox="0 0 16 16"
                    style="position:absolute; top:10px; right:10px">
                    <path d="M12.027 9.92L16 13.95 14 16l-4.075-3.976A6.465 6.465 0 0 1 6.5 13C2.91 13 0 10.083 0 6.5 0 2.91 2.917 0 6.5 0 10.09 0 13 2.917 13 6.5a6.463 6.463 0 0 1-.973 3.42zM1.997 6.452c0 2.48 2.014 4.5 4.5 4.5 2.48 0 4.5-2.015 4.5-4.5 0-2.48-2.015-4.5-4.5-4.5-2.48 0-4.5 2.014-4.5 4.5z" fill-rule="evenodd"/>
                    </svg>
                </div> -->


                <div v-if="$page.props.flash.success" id="flash-success-message" class="absolute top-20 right-1 p-4 bg-green-300 border border-gray-300 rounded-md shadow-md">
                    {{ $page.props.flash.success }}
                    <div class="progress-bar success"></div>
                </div>

                <div v-if="$page.props.flash.error" id="flash-error-message" class=" absolute top-20 right-1 p-4 bg-red-300 border border-gray-300 rounded-md shadow-md">
                    {{ $page.props.flash.error }}
                    <div class="progress-bar error"></div>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="min-w-full mx-auto sm:px-6 lg:px-7">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- <div class="p-6 text-gray-900">You're logged in!</div> -->
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                TimeStamp
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Log Entry
                            </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light" >
                            <!-- <tr>
                                <td colspan="10" class="text-center text-lg text-gray-400 py-6">No logs record available</td>
                            </tr> -->

                            <tr  class="border-b border-gray-200 hover:bg-gray-100" v-for="logs in logEntries" :key="logs.id">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">

                                        <p class="font-medium">{{ formattedDate(logs.created_at) }}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-5 text-left whitespace-nowrap">
                                    <div class="flex items-center">

                                        <p class="font-medium">{{ logs.log_entry }}</p>
                                    </div>
                                </td>






                            </tr>

                        </tbody>
                    </table>


                </div>
                <!-- <Pagination v-if="feeds.data.length >0" :links="feeds.links" class="mt-6 flex justify-center"/> -->
            </div>
        </div>

    </SideBarLayout>

</template>

<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import moment from'moment'

import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    logEntries:Object
})
function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
}
</script>

<style scoped>

#flash-success-message {
    animation: fadeOut 7s ease-in-out forwards;
}

.progress-bar {
    height: 5px;
    width: 100%;
    background-color: #4CAF50; /* Green color */
    animation: progressBar 3s linear;
}
#flash-error-message {
    animation: fadeOut 7s ease-in-out forwards;
}

.success .progress-bar {

    animation: progressBar 5s linear;
}
.error .progress-bar {
    background-color: #FF5733; /* Red color */
    animation: progressBar 5s linear;
}

@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}

@keyframes progressBar {
    0% {
        width: 100%;
    }
    100% {
        width: 0;
    }
}

</style>
