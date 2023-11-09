<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import {Head, Link, router, useForm} from '@inertiajs/vue3'
    import moment from 'moment'
    const props =defineProps({
        // saleItem:Object,
        sale:Object,
        customers:Object,
        totalPigs: Number, // Assuming you have a totalPigs prop
        totalWeight: Number,
    })

    function formattedDate(date){
            return moment(date).format('MMMM   D, YYYY');
    }

</script>

<template>
    <Head title="View Invoice" />

    <SideBarLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">View Sales Invoice</h2>
                <div class="flex">



                    <a href="/sales/pdf" class="flex  mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded mr-3 " target="blank">
                        <svg viewBox="0 0 512 512" version="1.1" height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#6666"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>pdf-document</title> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="add" fill="#000000" transform="translate(85.333333, 42.666667)"> <path d="M75.9466667,285.653333 C63.8764997,278.292415 49.6246897,275.351565 35.6266667,277.333333 L1.42108547e-14,277.333333 L1.42108547e-14,405.333333 L28.3733333,405.333333 L28.3733333,356.48 L40.5333333,356.48 C53.1304778,357.774244 65.7885986,354.68506 76.3733333,347.733333 C85.3576891,340.027178 90.3112817,328.626053 89.8133333,316.8 C90.4784904,304.790173 85.3164923,293.195531 75.9466667,285.653333 L75.9466667,285.653333 Z M53.12,332.373333 C47.7608867,334.732281 41.8687051,335.616108 36.0533333,334.933333 L27.7333333,334.933333 L27.7333333,298.666667 L36.0533333,298.666667 C42.094796,298.02451 48.1897668,299.213772 53.5466667,302.08 C58.5355805,305.554646 61.3626692,311.370371 61.0133333,317.44 C61.6596233,323.558965 58.5400493,329.460862 53.12,332.373333 L53.12,332.373333 Z M150.826667,277.333333 L115.413333,277.333333 L115.413333,405.333333 L149.333333,405.333333 C166.620091,407.02483 184.027709,403.691457 199.466667,395.733333 C216.454713,383.072462 225.530463,362.408923 223.36,341.333333 C224.631644,323.277677 218.198313,305.527884 205.653333,292.48 C190.157107,280.265923 170.395302,274.806436 150.826667,277.333333 L150.826667,277.333333 Z M178.986667,376.32 C170.098963,381.315719 159.922142,383.54422 149.76,382.72 L144.213333,382.72 L144.213333,299.946667 L149.333333,299.946667 C167.253333,299.946667 174.293333,301.653333 181.333333,308.053333 C189.877212,316.948755 194.28973,329.025119 193.493333,341.333333 C194.590843,354.653818 189.18793,367.684372 178.986667,376.32 L178.986667,376.32 Z M254.506667,405.333333 L283.306667,405.333333 L283.306667,351.786667 L341.333333,351.786667 L341.333333,329.173333 L283.306667,329.173333 L283.306667,299.946667 L341.333333,299.946667 L341.333333,277.333333 L254.506667,277.333333 L254.506667,405.333333 L254.506667,405.333333 Z M234.666667,7.10542736e-15 L9.52127266e-13,7.10542736e-15 L9.52127266e-13,234.666667 L42.6666667,234.666667 L42.6666667,192 L42.6666667,169.6 L42.6666667,42.6666667 L216.96,42.6666667 L298.666667,124.373333 L298.666667,169.6 L298.666667,192 L298.666667,234.666667 L341.333333,234.666667 L341.333333,106.666667 L234.666667,7.10542736e-15 L234.666667,7.10542736e-15 Z" id="document-pdf"> </path> </g> </g> </g></svg>
                            Export Invoice
                    </a>
                </div>
            </div>

        </template>
        <div class="py-10 ">
            <div class="max-w-3xl mx-auto  ">
                <div class="bg-[white] rounded-b-md">
                    <div class=" mt-3 mb-3">
                        <div class="flex justify-center mb-2">
                            <div><img src="/images/logo.jpeg" alt="Logo" class="w-[70px] h-[70px] rounded-full object-cover"></div>
                            <div class=" text-sm">
                                <h3 class="font-bold text-slate-700">RQR Piggery Farm || Saint Agustin Piggery Farm</h3>
                                <h3 class="font-bold text-slate-700 text-center">San Agustin, Sagbayan, Bohol</h3>
                                <h3 class="font-bold text-slate-700 text-center">Canmaya Centro, Sagbayan, Bohol</h3>
                            </div>

                        </div>
                        <div class="flex justify-between mt-9">

                            <div class="text-sm font-light text-slate-500">
                                <p class="text-sm font-normal text-slate-700">
                                    Invoice Detail: <strong>  0000{{ sale.id }}</strong>
                                </p>
                                <p class="text-sm font-normal text-slate-700">
                                    Customer: <strong>{{ sale.customers.name }}</strong>
                                </p>
                                <p class="text-sm font-normal text-slate-700">
                                    Date: <strong>{{ formattedDate(sale.created_at) }}</strong>
                                </p>

                            </div>
                            <div class="justify-right">
                                <p class="text-sm font-normal ">
                                    Mode of Payment : <strong>{{ sale.payment }}</strong>
                                </p>
                                <p class="text-sm font-normal ">
                                    Quantity of Pigs : <strong>{{ totalPigs }} pc/pcs.</strong>
                                </p>
                                <p class="text-sm font-normal ">
                                    Remarks : <strong>{{ sale.remarks }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col mx-0 ">
                    <table class="min-w-full divide-y divide-slate-500">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3  text-sm text-center font-normal text-slate-700 sm:pl-6 md:pl-0">
                                    Pig Weight
                                </th>
                                <th scope="col" class="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell">
                                    Rate
                                </th>
                                <th scope="col" class="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell">
                                    Total
                                </th>
    
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-slate-200" v-for="saleItem in sale.sales_items" :key="saleItem.id">
                                <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                                    <div class="font-medium text-slate-700 text-center">{{ saleItem.pig_weight }} kgs.</div>
                                </td>
                                <td class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                                    ₱ {{ saleItem.rate }}
                                </td>
                                <td class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                                    ₱ {{ saleItem.total }}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                        
                            <tr>
                                <th scope="row" colspan="3" class="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                    Total Weight
                                </th>
                                <!-- <th scope="row" class="pt-6 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden">
                                    Total Amount
                                </th> -->
                                <td class="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                    <strong>{{ totalWeight }} kgs.</strong>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="3" class="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                    Total Amount
                                </th>
                                <!-- <th scope="row" class="pt-6 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden">
                                    Total Amount
                                </th> -->
                                <td class="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                    ₱ <strong>{{ sale.total_amount }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="3" class="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                    Cash Amount
                                </th>

                                <td class="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                    ₱ <strong>{{ sale.is_credit }}</strong>
                                </td>
                            </tr>
                            <tr>

                                <th scope="row" colspan="3" class="hidden pt-4 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                    Balance
                                </th>
                                <td class="pt-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                    ₱ <strong>{{ sale.balance }}</strong>
                                </td>
                            </tr>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </SideBarLayout>
</template>
