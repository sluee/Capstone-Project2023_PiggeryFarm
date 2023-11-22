<script setup>
import {Head, Link, router, useForm} from '@inertiajs/vue3'
import SideBarLayout from "@/Layouts/SideBarLayout.vue";
import moment from 'moment'
import Pagination from '@/Components/Pagination.vue';
import {ref, watch, onMounted} from 'vue'


    const props = defineProps({
        sales:Object,
        totalAmountAllSales: Number,
        filters:Object,
        flash:Object
    });

    function formattedDate(date){
        return moment(date).format('MMMM   D, YYYY');
    }

    let search = ref(props.filters.search);
    watch(search, (value) => {
        router.get(
            "/histories",
            { search: value },
            {
                preserveState: true,
                replace: true,
            }
        );
    });
    onMounted(() => {
    // Set a timeout to hide the success flash message after 3 seconds
        const successFlashMessage = document.getElementById('flash-success-message');
            if (successFlashMessage) {
                setTimeout(() => {
                successFlashMessage.style.display = 'none';
                }, 3000);
        }

        // Set a timeout to hide the error flash message after 3 seconds
        const errorFlashMessage = document.getElementById('flash-error-message');
            if (errorFlashMessage) {
                setTimeout(() => {
                errorFlashMessage.style.display = 'none';
            }, 3000);
        }
    });

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


<template>
    <Head title="Sales History" />

    <SideBarLayout>
        <template #header >
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sales History</h2>
                <div style="position:relative">
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-9 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search sales here"  v-model="search">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#444  " width="20px" height="20px" viewBox="0 0 16 16"
                    style="position:absolute; top:10px; right:10px">
                    <path d="M12.027 9.92L16 13.95 14 16l-4.075-3.976A6.465 6.465 0 0 1 6.5 13C2.91 13 0 10.083 0 6.5 0 2.91 2.917 0 6.5 0 10.09 0 13 2.917 13 6.5a6.463 6.463 0 0 1-.973 3.42zM1.997 6.452c0 2.48 2.014 4.5 4.5 4.5 2.48 0 4.5-2.015 4.5-4.5 0-2.48-2.015-4.5-4.5-4.5-2.48 0-4.5 2.014-4.5 4.5z" fill-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div v-if="$page.props.flash.success" id="flash-success-message" class="absolute top-20 right-1 p-4 bg-green-300 border border-gray-300 rounded-md shadow-md">
                {{ $page.props.flash.success }}
                <div class="progress-bar success"></div>
            </div>

            <div v-if="$page.props.flash.error" id="flash-error-message" class=" absolute top-20 right-1 p-4 bg-red-300 border border-gray-300 rounded-md shadow-md">
                {{ $page.props.flash.error }}
                <div class="progress-bar error"></div>
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
                            <tbody class="text-gray-600 text-sm font-light">
                                <tr v-if="sales.data.length === 0">
                                    <td colspan="10" class="text-center text-lg  text-gray-400 py-6">No sales record available</td>
                                </tr>
                                <tr  class="border-b border-gray-200 hover:bg-gray-100"  v-for="sale in sales.data" :key="sale.id">
                                    <td class="px-3 py-4 text-center">
                                        <Link :href="'/sales/'+sale.id" style="text-decoration: underline; color: blue; ">
                                            Inv00{{ sale.id }}
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
                            </tbody>

                    </table>   
                </div>
                <Pagination :links="sales.links" class="mt-6 flex justify-center"/>
            </div>
        </div>
   </SideBarLayout>
</template>
