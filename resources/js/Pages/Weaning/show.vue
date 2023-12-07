<template>
    <Head title="View Weaning" />

    <SideBarLayout>
        <template #header>

            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">View Weaning Details</h2>
                    <Breadcrumb :crumbs="crumbs"  />
                </div>
                <div class="flex">
                    <Link class="button1 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded" as="button" :href="'/weaning/'">Back</Link>
                </div>
            </div>

        </template>
        <div class="py-12 px-4">
            <div class="flex items-center justify-center">
                <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-lg">
                    <div class="flex justify-center ">
                        <div><img src="/images/logo.png" alt="Logo" class="w-[70px] h-[70px] rounded-full object-cover"></div>
                        <div class=" ">
                            <h3 class="font-bold text-sm text-slate-700">RQR Piggery Farm || Saint Agustin Piggery Farm</h3>
                            <h3 class="font-bold text-sm text-slate-700 text-center">San Agustin, Sagbayan, Bohol</h3>
                            <h3 class="font-bold text-sm text-slate-700 text-center">Canmaya Centro, Sagbayan, Bohol</h3><br>

                        </div>

                    </div>
                  <h1 class="text-xl font-semibold text-center text-slate-700 mb-2">Details of Weaning</h1>
                  <p class="text-sm text-slate-700 text-left mt-3 "><strong>Sow:</strong> {{ weaning.labors.breeding.sow.sow_no }} </p>
                  <p class="text-sm text-slate-700 text-left"><strong>Boar Breed:</strong> {{ weaning.labors.breeding.boar.breed }} </p>
                  <p class="text-sm text-slate-700 text-left"><strong>Date of Breed:</strong> {{ formattedDate(weaning.labors.breeding.date_of_breed) }} </p>
                  <p class="text-sm text-slate-700 text-left"><strong>Expected Date of Farrowing:</strong> {{formattedDate (weaning.labors.breeding.exp_date_of_farrowing)}} </p>
                  <p class="text-sm text-slate-700 text-left"><strong>Actual Date of Farrowing: </strong> {{ formattedDate(weaning.labors.actual_date_farrowing) }} </p>
                  <p class="text-sm text-slate-700 text-left"><strong>No of Pigs Born:</strong> {{ weaning.labors.no_pigs_born }} piglets </p>
                  <p class="text-sm text-slate-700 text-left"><strong>No of Pigs Alive:</strong> {{ weaning.labors.no_pigs_alive }} piglets </p>
                  <p class="text-sm text-slate-700 text-left"><strong>No of Pigs Weaned:</strong> {{ weaning.no_of_pigs_weaned }} piglets </p>
                  <p class="text-sm text-slate-700 text-left"><strong>Actual Date of Farrowing: </strong> {{ formattedDate(weaning.labors.date_of_weaning) }} </p>
                  <p class="text-sm text-slate-700 text-left"><strong>Remarks: </strong> {{ weaning.remarks }}</p>
                </div>
              </div>
        </div>

    </SideBarLayout>
</template>

<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs.vue'
import moment from 'moment'
import { Link, Head } from '@inertiajs/vue3';
const props = defineProps({
    weaning:Object
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
            name: 'List of Weanings',
            url: '/weaning',
            active: false,
        },
        {
            name:  "Weaning no "+ props.weaning.id ,
            url: null,
            active: true,
        },
    ]

</script>
