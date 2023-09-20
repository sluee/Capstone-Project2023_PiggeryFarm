<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, useForm,  } from '@inertiajs/vue3';
    import { ref, computed,watch } from 'vue';

    const props = defineProps({
        breedings:Object,
        labors:Object,
        sow:Object,
        boar:Object,
        breed_id: String,

    });

    // function breed({
    //     if (props.breedings && this.breedings.id) {
    //     return this.breedings.id;
    //   }
    //   return '';
    // });

    const form = useForm({
    breed_id:props.breed_id,
    parity_no:'',
    actual_date_farrowing:'',
    no_pigs_born:'',
    no_pigs_alive:'',
    date_of_weaning: ''
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

    function formatDate(date) {
    return `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')}`;
}

    function submit() {
        form.post('/labors');

    }

</script>

<template>
    <Head title="Create Labor" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">Create Labor</h2>
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded" as="button" href="/labors">Back</Link>
            </div>
        </template>


        <div class="py-6">
            <div class="flex flex-col justify-center items-center">
                <div class="relative flex flex-col items-center rounded-[20px] w-[500px] max-w-[95%] mx-auto bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none p-3">
                    <div class="mt-2 mb-8 w-full">
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
                                     v-model="breed_id "
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
                                        Create Labor
                                    </button>
                                  </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </SideBarLayout>
</template>

