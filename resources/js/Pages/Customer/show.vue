<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import moment from 'moment'
    import {Head, Link, router, useForm} from '@inertiajs/vue3'
    import { ref,watch } from 'vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import Breadcrumb from '@/Components/Breadcrumbs.vue';
    import Pagination from '@/Components/Pagination.vue'


    let deleteForm = useForm({ })
    const props = defineProps({
        customer: Object,
        sales:Object,
        filters:Object,

    })


    function formattedDate(date){
        return moment(date).format('MMMM   D, YYYY');
    }

    let search = ref(props.filters.search);
    watch(search, (value) => {
        router.get(
            "/customers/{customer}",
            { search: value },
            {
                preserveState: true,
                replace: true,
            }
        );
    });

    function remove(customer) {
        deleteForm.delete('/customers/' + props.customer.id)

        // console.log(props.errors)
    }

    function edit(){
        router.visit('/customers/edit/' + props.customer.id)
    }

    const crumbs = [
    {
        name: 'Dashboard',
        url: '/dashboard',
        active: false,
    },
    {
        name: 'List of Customers',
        url: '/customers',
        active: false,
    },
    {
        name:  "Showing customer #"+ props.customer.id ,
        url: null,
        active: true,
    },
    ]

</script>
<template>
    <Head title="View Customer" {{ customer.name }}/>

    <SideBarLayout>
        <template #header>
            <div class="flex justify-between">
                <Breadcrumb :crumbs="crumbs" class="mb-4" />
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-between">
                <div class="bg-white p-4 rounded shadow mr-5">
                    <h4 class="text-2xl">Client Info</h4>
                    <hr>
                    <div>
                        <div class="w-80 m-auto lg:mt-2 max-w-sm">
                        <img src="https://images.unsplash.com/photo-1511367461989-f85a21fda167?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80" alt="" class="rounded-sm shadow-xl lg:w-full 2xl:w-full 2xl:h-44 object-cover"/>
                            <h2 class="text-center text-gray-800 text-2xl font-bold pt-6">{{ customer.name }} </h2>
                            <div class="w-5/6 m-auto">
                            <p class="text-center text-gray-500 pt-5">
                                <span class="font-bold text-gray-900">
                                Address:
                                </span> {{ customer.address }}
                            </p>
                            <p class="text-center text-gray-500 pt-5">
                                <span class="font-bold text-gray-900">
                                    Phone No:
                                </span> {{ customer.phone }} </p>
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
                            <div class="flex justify-center items-center mt-3 ml-2 mr-4">
                                <!-- <DangerButton @click="remove(customer)" class="mr-2">
                                    Delete Customer
                                </DangerButton> -->
                                <PrimaryButton @click="edit()" >Edit Customer</PrimaryButton>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded shadow ">
                    <h4 class="text-2xl mb-3">Transaction Log</h4>
                    <table class="w-full text-sm text-left text-black-500 dark:text-gray-400">
                        <thead class="text-s text-white  text-center bg-gray-50 dark:bg-blue-500 dark:text-white-400" >
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Invoice Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                   Details
                                </th>
                                <th scope="col" class="px-6 py-3">
                                   No of Pigs
                                </th>
                                <th scope="col" class="px-6 py-3">
                                   Total Weight
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total Amount
                                </th>
                                <!-- <th scope="col" class="px-6 py-3">
                                    Payment
                                </th> -->
                                <th scope="col" class="px-6 py-3">
                                    Balance
                                </th>
                                <!-- <th scope="col" class="px-6 py-3">
                                    Remarks
                                </th> -->
                            </tr>
                        </thead>
                        <tbody >
                            <tr v-if="sales.data.length === 0">
                                <td colspan="7" class="text-center text-lg  text-gray-400 py-6">No transaction record available</td>
                            </tr>
                            <tr class="bg-blue-200 hover:bg-blue-300 text-center font-medium text-black  whitespace-nowrap " v-for="sale in sales.data" :key="sale.id">

                                <td class="px-3 py-4 text-center">
                                    <Link :href="'/sales/'+sale.id" style="text-decoration: underline; color: blue;">
                                        00{{ sale.id }}
                                    </Link>
                                </td>
                                <td class="px-3 py-4">
                                    {{ formattedDate(sale.created_at)}}
                                </td>
                                <!-- <td class="px-3 py-4">
                                     {{ sale.payment }}
                                </td> -->
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

                            </tr>
                        </tbody>

                    </table>
                    <div class="px-5 py-5 border-t flex flex-col xs:flex-row items-center xs:justify-between">

                        <Pagination v-if="sales.data.length >0" :links="sales.links" class="mt-2"/>
                    </div>
                    <!-- <Pagination :links="sales.links" class="mt-6 flex justify-center" /> -->
                </div>


            </div>
        </div>

    </SideBarLayout>
</template>


