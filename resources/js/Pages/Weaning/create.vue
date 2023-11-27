<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, useForm,  } from '@inertiajs/vue3';
    import moment from 'moment';
    import Breadcrumb from '@/Components/Breadcrumbs.vue';
    const props = defineProps({
        labor:Object,
        weaning:Object,
        labor_id: String,
        sow:Object,
        boar:Object,
        breeding:Object,
    });

    // function breed({
    //     if (props.breedings && this.breedings.id) {
    //     return this.breedings.id;
    //   }
    //   return '';
    // });

    const form = useForm({
    labor_id:props.labor_id,
    no_of_pigs_weaned:'',
    remarks:''
    });

    function formattedDate(date){
        return moment(date).format('MMMM   D, YYYY');
    }

    function submit() {
        form.post('/weaning/');

    }

</script>

<template>
    <Head title="Create Weaning" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">Create Weaning</h2>
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded" as="button" :href="'/labors/' + props.labor_id">Back</Link>
            </div>
        </template>

        <div class="py-6">
            <div class="flex">
                <div class="w-full md:w-1/2 lg:w-1/3 px-4">
                    <div
                       class="
                       bg-white
                       rounded-xl
                       relative
                       z-10
                       overflow-hidden
                       border border-primary border-opacity-20
                       shadow-pricing
                       py-10
                       px-8
                       sm:p-12
                       lg:py-10 lg:px-6
                       xl:p-12
                       mb-10
                       "
                       >
                       <span class="text-primary font-semibold text-xl block mb-4">
                       Labor Details
                       </span>
                       <p class="text-body-color  text-base ">
                          Sow:<strong>{{ labor.sow.sow_no }}</strong>
                          
                       </p>
                       <p
                          class="
                          text-base text-body-color"
                          >
                         Boar: <strong>{{labor.boar.boar_no}} | {{ labor.boar.breed }}</strong>
                       </p>
                       <div class="">
                          <p class="text-base  ">
                            Parity no: <strong>{{ labor.parity_no}}</strong>
                          </p>
                          <p class="text-base  ">
                            Expected Date of Farrowing: <strong>{{ formattedDate(labor.exp_date_of_farrowing) }}</strong>
                          </p>
                          <p class="text-base  ">
                            Actual Date of Farrowing: <strong>{{ formattedDate(labor.actual_date_farrowing) }}</strong>
                          </p>
                          <p class="text-base  ">
                            No of Pigs Born: <strong>{{ labor.no_pigs_born}}</strong>
                          </p>
                          <p class="text-base  ">
                            No of Pigs Alive: <strong>{{ labor.no_pigs_born}}</strong>
                          </p>
                          <p class="text-base  ">
                            Date of Weaning: <strong>{{ formattedDate(labor.date_of_weaning) }}</strong>
                          </p>
                       </div>     
                    </div>
                 </div>
                <div >
                
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
                                              class="border rounded-lg px-3 py-2 mt-1 text-sm w-full text-gray-600"
                                             v-model="labor_id "
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
                                                Create Weaning
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

