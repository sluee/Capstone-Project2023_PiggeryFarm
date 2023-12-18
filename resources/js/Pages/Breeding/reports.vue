<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue'
import { Head, Link, useForm,  } from '@inertiajs/vue3';
import moment from 'moment';
import Pagination from '@/Components/Pagination.vue';


const props = defineProps({
    weaning:Object,
    totalPigsWeaned:Number,
    currentMonthAndYear:String,
    countReheat:Number,
    countAbort:Number
})

function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
}
</script>
<template>
    <Head title="Breeding Reports" />

    <SideBarLayout>
        <div class="py-6">
            <div class="flex justify-center mb-2">
                <div>
                    <img src="/images/logo.png" alt="Logo" class="w-[70px] h-[70px] rounded-full object-cover">
                </div>
                <div class="text-sm">
                    <h3 class="font-bold text-slate-700">RQR Piggery Farm || Saint Agustin Piggery Farm</h3>
                    <h3 class="font-bold text-slate-700 text-center">San Agustin, Sagbayan, Bohol</h3>
                    <h3 class="font-bold text-slate-700 text-center">Canmaya Centro, Sagbayan, Bohol</h3>
                    <br>
                    <h3 class="font-bold text-slate-700 text-center text-lg">Pigs Breeding Reports</h3>
                    <br>
                </div>

            </div>
            <div class="py-5">
                <div  v-if="weaning.data.length > 0">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <p class='text-justify mb-2'>
                            In this month's report on our pig breeding, we're excited to share good news about our piglets.
                            Throughout <strong>{{ currentMonthAndYear }}</strong>, we successfully weaned a total of
                            <strong>{{ totalPigsWeaned }} piglets</strong>. This achievement showcases the hard work
                            of our breeding and labor teams and indicates the well-being of our pig population.
                            Weaning is an important step in our breeding plan, ensuring the healthy growth of our pig herd.

                            Now, let's take a closer look at the list of piglets weaned this month. This detailed
                            information not only helps us celebrate individual successes but also provides valuable
                            insights into the health and development of each piglet in our care.

                            Additionally, this month we had:
                            <ul>
                                <li> <strong>Number of sows with 'Abort': {{ countAbort }}</strong></li>
                                <li> <strong>Number of sows with 'Reheat': {{ countReheat }}</strong></li>
                            </ul>

                           Here is the list of the completed Breeding process:

                        </p>

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Sow</th>
                                    <th class="py-3 px-6 text-left">Boar</th>
                                    <th class="py-3 px-6 text-center">Date of Breed</th>
                                    <th class="py-3 px-6 text-center">Actual Date of Farrowing</th>
                                    <th class="py-3 px-6 text-center">No of Pigs Weaned</th>

                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light" >

                                <tr  class="border-b border-gray-200 hover:bg-gray-100" v-for="wean in weaning.data" :key="wean.id">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">

                                            <p class="font-medium">{{ wean.labors.breeding.sow.sow_no }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <p class="font-medium">{{wean.labors.breeding.boar.boar_no }} | {{wean.labors.breeding.boar.breed }} </p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{formattedDate(wean.labors.breeding.date_of_breed) }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ formattedDate(wean.labors.actual_date_farrowing) }} </p>
                                        </div>

                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium"> {{ wean.no_of_pigs_weaned }} piglets</p>
                                        </div>

                                    </td>

                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="text-end mt-5">
                        <p class="font-bold">Total Piglets weaned: {{ totalPigsWeaned }} piglets</p>

                    </div>
                    <Pagination v-if="weaning.data.length >0" :links="weaning.links" class="mt-6 flex justify-center"/>
                </div>

                </div>
                <div v-else class="bg-white p-6 rounded shadow flex justify-center text-justify" >
                    <p>No weaning data available for the current month and year.</p>
                </div>



            </div>

        </div>
    </SideBarLayout>
</template>
