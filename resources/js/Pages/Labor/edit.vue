<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, useForm,  } from '@inertiajs/vue3';
    import { ref,watch } from 'vue';
    import moment from 'moment'

    const props = defineProps({
        breedings:Object,
        labors:Object,
        sow:Object,
        boar:Object,
        //  breed_id: String,

    });

    const form = useForm({
    breed_id:props.labors.breed_id,
    parity_no:props.labors.parity_no,
    actual_date_farrowing:props.labors.actual_date_farrowing,
    no_pigs_born:props.labors.no_pigs_born,
    no_pigs_alive:props.labors.no_pigs_alive,
    date_of_weaning: props.labors.date_of_weaning
    });


    const actual_date_farrowing = ref(form.actual_date_farrowing); // Create a reactive reference

// Watch for changes to form.actual_date_farrowing and update computed properties accordingly
    watch(() => form.actual_date_farrowing, (newDateOfBreed) => {
        if (newDateOfBreed) {
            const dateWeaned = new Date(newDateOfBreed);
            dateWeaned.setDate(dateWeaned.getDate() + 30);
            form.date_of_weaning = formatDate(dateWeaned);


        } else {
            // Handle the case where actual_date_farrowing is empty
            form.date_of_weaning = '';
        }
    });

    function formatDate(date){
    return `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')}`;
}
    function formattedDate(date){
        return moment(date).format('MMMM   D, YYYY');
    }

    // function submit() {
    //     form.put('/labors/' +props.labors.id);

    // }

    const isLoading = ref(false);

    const submit = async () => {
        isLoading.value = true;
        form.put('/labors/' +props.labors.id);
        setTimeout(() => {
            isLoading.value = false;
        }, 5000);
    };

</script>

<template>
    <Head title="Update Labor" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">Update Labor</h2>
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded" as="button" href="/labors">Back</Link>
            </div>
        </template>
        <div class="py-6">
            <div class="flex">
                <div class="w-1/3 mt-3 px-3 ml-12">
                    <div class=" pr-5">
                        <h4 class="text-center text-xl font-bold text-navy-700 dark:text-black">
                            Breeding's Details
                        </h4>
                        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 mt-5">
                            <div class="bg-blue-300  shadow-lg sm:rounded-lg">
                                <div class="p-6 text-gray-900 flex" >

                                    <div class="flex-1 ml-4 bg-" >
                                        <label class="font-semibold text-sm text-gray-600 block" for="">Sow</label>
                                            <p class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600">{{ labors.breeding.sow.sow_no }}</p>
                                        <label class="font-semibold text-sm text-gray-600 block" for="">Boar</label>
                                        <p class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600">{{ labors.breeding.boar.breed }}</p>

                                        <label class="font-semibold text-sm text-gray-600 block" for="">Date of Breed</label>
                                        <p class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600">{{ formattedDate(labors.breeding.date_of_breed) }}</p>

                                        <label class="font-semibold text-sm text-gray-600 block" for="">Date of Changing Feeds</label>
                                        <p class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600">{{ formattedDate(labors.breeding.changeFeeds) }}</p>

                                        <label class="font-semibold text-sm text-gray-600 block" for="">Date of Breed</label>
                                        <p class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600">{{ formattedDate(labors.breeding.exp_date_of_farrowing) }}</p>
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
                                        Labor Details
                                    </h4>
                                    <div class="px-5 py-5">

                                        <label class="font-semibold text-sm text-gray-600 block" for="">Breed No.</label>
                                        <input
                                            type="text"
                                            class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600"
                                            v-model="form.breed_id "
                                            readonly
                                        />

                                        <label class="font-semibold text-sm text-gray-600  block" for="parity_no">Parity No</label>
                                        <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.parity_no" />
                                        <div class="text-red-600" v-if="form.errors.parity_no">{{ form.errors.parity_no }}</div>

                                        <label class="font-semibold text-sm text-gray-600 block" for="actual_date_farrowing">Actual Date of Farrowing</label>
                                        <input type="date" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600" v-model="form.actual_date_farrowing" @input="actual_date_farrowing = $event.target.value" />
                                        <div class="text-red-600" v-if="form.errors.actual_date_farrowing">{{ form.errors.actual_date_farrowing }}</div>

                                        <label class="font-semibold text-sm text-gray-600 block" for="no_pigs_born">No of Pigs Born</label>
                                        <input type="number" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600" v-model="form.no_pigs_born" />
                                        <div class="text-red-600" v-if="form.errors.no_pigs_born">{{ form.errors.no_pigs_born }}</div>

                                        <label class="font-semibold text-sm text-gray-600 block" for="no_pigs_alive">No of Pigs Alive</label>
                                        <input type="number" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600" v-model="form.no_pigs_alive"  />
                                        <div class="text-red-600" v-if="form.errors.no_pigs_alive">{{ form.errors.no_pigs_alive }}</div>

                                        <label class="font-semibold text-sm text-gray-600 block" for="date_of_weaning">Date of Weaning</label>
                                        <input type="date" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600" v-model="form.date_of_weaning"  readonly/>
                                        <div class="text-red-600" v-if="form.errors.date_of_weaning">{{ form.errors.date_of_weaning }}</div>

                                        <button class="px-4 py-2 mt-2 bg-blue-400 w-full rounded border border-blue-600 shadow hover:bg-blue-500">
                                            Update Labor
                                        </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div v-if="isLoading" class="absolute inset-0 flex items-center justify-center">
                                <div class="spinner">
                                  <div class="dot1"></div>
                                  <div class="dot2"></div>
                                  <div class="dot3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </SideBarLayout>
</template>


<style scoped>
.spinner {
    flex-direction: row;
    display: flex;
    align-items: center;
    justify-content: center;
   }
   
   .dot1, .dot2, .dot3 {
    width: 15px;
    height: 15px;
    border: double;
    border-color: white;
    border-radius: 50%;
    margin: 10px;
   }
   
   .dot1 {
    animation: jump765 1.6s -0.32s linear infinite;
    background: #2495ff;
   }
   
   .dot2 {
    animation: jump765 1.6s -0.16s linear infinite;
    background: #2495ff;
   }
   
   .dot3 {
    animation: jump765 1.6s linear infinite;
    background: #2495ff;
   }
   
   @keyframes jump765 {
    0%, 80%, 100% {
     -webkit-transform: scale(0);
     transform: scale(0);
    }
   
    40% {
     -webkit-transform: scale(2.0);
     transform: scale(2.0);
    }
   }
   
   
</style>