<template>
    <Head title="View Employee" />

    <SideBarLayout>
        <template #header>
            <div class="flex justify-between">
                <!-- <Breadcrumb :crumbs="crumbs" class="mb-4" /> -->
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-between">
                <div class="bg-white p-4 rounded shadow mr-5">
                    <h4 class="text-2xl font-semibold">Employee Info</h4>
                    <hr>
                    <div>
                        <div class="w-80 m-auto lg:mt-2 max-w-sm">
                        <img src="https://images.unsplash.com/photo-1511367461989-f85a21fda167?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80" alt="" class="rounded-sm shadow-xl lg:w-full 2xl:w-full 2xl:h-44 object-cover"/>
                            <h2 class="text-center text-gray-800 text-2xl font-bold pt-6">s </h2>
                            <div class="w-5/6 m-auto">
                            <p class="text-center text-gray-500 pt-5">
                                <span class="font-bold text-gray-900">
                                Address:
                                </span> 
                            </p>
                            <p class="text-center text-gray-500 pt-5">
                                <span class="font-bold text-gray-900">
                                    Phone No:
                                </span>  </p>
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
                                <!-- <DangerButton @click="remove(customer)" class="mr-2">
                                    Delete Customer
                                </DangerButton>
                                <PrimaryButton @click="edit()">Edit Customer</PrimaryButton> -->
                            </div>

                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded shadow ">
                    <h4 class="text-2xl mb-3">Transaction Log</h4>
                    <table class="w-full text-sm text-left text-black-500 dark:text-gray-400">
                        <thead class=" text-white  text-center bg-gray-50 dark:bg-blue-500 dark:text-white-400" >
                            <tr>
                                <th class="px-6 py-3">
                                    PayId
                                </th>
                                <th  class="px-6 py-3">
                                    Date
                                </th>
                                <th  class="px-6 py-3">
                                    Payment
                                </th>
                                <th  class="px-6 py-3">
                                    Balance
                                </th>
                                <!-- <th scope="col" class="px-6 py-3">
                                    Remarks
                                </th> -->
                            </tr>
                        </thead>
                        <tbody>

                            <tr class="bg-blue-200 hover:bg-blue-300 text-center font-medium text-black  whitespace-nowrap ">

                                <!-- <td class="px-3 py-4 text-center">
                                    <Link :href="'/sales/'+sale.id" style="text-decoration: underline; color: blue;">
                                        00{{ sale.id }}
                                    </Link>
                                </td>
                                <td class="px-3 py-4">
                                    {{ formattedDate(sale.created_at)}}
                                </td>
                                <td class="px-3 py-4">
                                     {{ sale.payment }}
                                </td>
                                <td class="px-3 py-4">
                                    {{ sale.totalPig }}
                                </td>
                                <td class="px-3 py-4">
                                     {{ sale.total }} kgs.
                                </td>
                                <td class="px-3 py-4">
                                    ₱ {{ sale.total_amount }}
                                </td>

                                <td class="px-3 py-4">
                                    ₱ {{ sale.is_credit }}
                                </td>
                                <td class="px-3 py-4">
                                    ₱ {{ sale.balance }}
                                </td>
                                 -->
                            </tr>
                        </tbody>

                    </table>
                    
                </div>
                <!-- <Pagination :links="customer.sales.links" class="mt-6 flex justify-center"/> -->
            </div>
        </div>
    </SideBarLayout>
</template>

<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue'; 
import {Link, Head} from '@inertiajs/vue3';

</script>