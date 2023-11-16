<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, useForm,  } from '@inertiajs/vue3';
    import moment from 'moment';
    import Breadcrumb from '@/Components/Breadcrumbs.vue';

    const props = defineProps({
        labor:Object,
        weaning:Object,
        sow:Object,
        boar:Object,
        breeding:Object,
    });

    const crumbs = [
        {
            name: 'Dashboard',
            url: '/dashboard',
            active: false,
        },
        {
            name: 'Breedings',
            url: '/breedings',
            active: false,
        },
        {
            name: 'Labors',
            url: '/labors/' +props.weaning.labors.id,
            active: false,
        },
        {
            name:  "Weaning no "+ props.weaning.id ,
            url: null,
            active: true,
        },
    ]


    const form = useForm({
    labor_id:props.weaning.labor_id,
    no_of_pigs_weaned:props.weaning.no_of_pigs_weaned,
    remarks:props.weaning.remarks
    });

    function formattedDate(date){
        return moment(date).format('MMMM   D, YYYY');
    }

    function submit() {
        form.put('/weaning/' +props.weaning.id);

    }

</script>

<template>
    <Head title="Update Weaning" />

    <SideBarLayout>
        <!-- <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">Update Weaning</h2>
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded" as="button" :href="'/labors/' + props.labor_id">Back</Link>
            </div>
        </template> -->

        <div class="py-6">
            <div class="flex justify-between">
                <Breadcrumb :crumbs="crumbs" class="mb-4" />
                
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded" as="button" :href="'/labors/' + props.labor_id">Back</Link>
            </div>
            <div class="flex">
                <div class="w-1/3 mt-3 px-3 ml-12">
                    <div class=" pr-5">
                        <h4 class="text-center text-xl font-bold text-navy-700 dark:text-black">
                            Labor's Details
                        </h4>
                        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 mt-2">
                            <div class="bg-blue-300  shadow-lg sm:rounded-lg">
                                <div class="p-6 text-gray-900 flex">

                                    <div class="flex-1 ml-4 ">
                                        <label class="font-semibold text-sm text-gray-600 block" for="">Sow</label>
                                        <p class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600">{{ weaning.labors.breeding.sow.sow_no}}</p>

                                        <label class="font-semibold text-sm text-gray-600 block" for="">Boar</label>
                                        <p class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600">{{ weaning.labors.breeding.boar.breed}}</p>

                                        <label class="font-semibold text-sm text-gray-600 block" for="">Parity No</label>
                                            <p class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600">{{ weaning.labors.parity_no}}</p>

                                        <label class="font-semibold text-sm text-gray-600 block" for="">Actual Date of farrowing</label>
                                        <p class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600">{{ formattedDate(weaning.labors.actual_date_farrowing) }}</p>

                                        <label class="font-semibold text-sm text-gray-600 block" for="">No of pigs born</label>
                                        <p class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600">{{ weaning.labors.no_pigs_born}}</p>

                                        <label class="font-semibold text-sm text-gray-600 block" for="">No of pigs alive</label>
                                            <p class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600">{{ weaning.labors.no_pigs_alive}}</p>

                                        <label class="font-semibold text-sm text-gray-600 block" for="">Date of Weaning</label>
                                        <p class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600">{{ formattedDate(weaning.labors.date_of_weaning) }}</p>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div >
                    <div class="flex flex-col justify-center items-center">
                        <div class="relative flex flex-col items-center rounded-[20px] w-[500px] max-w-[95%] mx-auto bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none p-3">
                            <div class="mb-8 w-full">
                                <form @submit.prevent="submit" class="flex">
                                    <div class="flex-1 pr-4">
                                        <h4 class="px-2 text-xl font-bold text-navy-700 dark:text-black">
                                            Weaning Details
                                        </h4>
                                        <div class="px-5 py-5">

                                            <label class="font-semibold text-sm text-gray-600 block" for="">Labor No.</label>
                                            <input
                                              type="text"
                                              class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600"
                                             v-model="form.labor_id "
                                              readonly
                                            />
s
                                            <label class="font-semibold text-sm text-gray-600 block" for="no_of_pigs_weaned">No of Pigs Weaned</label>
                                            <input type="number" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600" v-model="form.no_of_pigs_weaned"  />
                                            <div class="text-red-600" v-if="form.errors.no_of_pigs_weaned">{{ form.errors.no_of_pigs_weaned }}</div>

                                            <label class="font-semibold text-sm text-gray-600 block" for="remarks">Remarks</label>
                                            <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600" v-model="form.remarks" />
                                            <div class="text-red-600" v-if="form.errors.remarks">{{ form.errors.remarks }}</div>

                                            <button class="px-4 py-2 mt-2 bg-blue-400 w-full rounded border border-blue-600 shadow hover:bg-blue-500">
                                                Update Weaning
                                            </button>
                                          </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </SideBarLayout>
</template>

