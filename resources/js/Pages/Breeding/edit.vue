<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, useForm,  } from '@inertiajs/vue3';
    import { ref, watch } from 'vue';
    const props = defineProps({
        breeding: Object,
        sows:Object,
        boars:Object
    });
    const form = useForm({
        sow_id: props.breeding.sow_id,
        boar_id: props.breeding.boar_id,
        date_of_breed: props.breeding.date_of_breed,
        possible_reheat: props.breeding.possible_reheat,
        changeFeeds: props.breeding.changeFeeds,
        exp_date_of_farrowing: props.breeding.exp_date_of_farrowing
    });

    const date_of_breed = ref(form.date_of_breed); // Create a reactive reference

// Watch for changes to form.date_of_breed and update computed properties accordingly
    watch(() => form.date_of_breed, (newDateOfBreed) => {
        if (newDateOfBreed) {
            const dateBreed = new Date(newDateOfBreed);
            dateBreed.setDate(dateBreed.getDate() + 21);
            form.possible_reheat = formatDate(dateBreed);

            dateBreed.setDate(dateBreed.getDate() + 79); // Change 100 to 79 for changeFeeds
            form.changeFeeds = formatDate(dateBreed);

            dateBreed.setDate(dateBreed.getDate() + 35);
            form.exp_date_of_farrowing = formatDate(dateBreed);
        } else {
            // Handle the case where date_of_breed is empty
            form.possible_reheat = '';
            form.changeFeeds = '';
            form.exp_date_of_farrowing = '';
        }
    });

// Helper function to format the date as "yyyy-MM-dd"
    function formatDate(date){
        return `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')}`;
    }

  

    function submit() {
        form.put('/breedings/'+props.breeding.id);
      
    }



</script>

<template>
    <Head title="Update Breeding" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">Update Breeding</h2>
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded" as="button" href="/breedings">Back</Link>
            </div>
        </template>


        <div class="py-6">
            <div class="flex flex-col justify-center items-center">
                <div class="relative flex flex-col items-center rounded-[20px] w-[500px] max-w-[95%] mx-auto bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none p-3">
                    <div class="mt-2 mb-8 w-full">
                        <form @submit.prevent="submit" class="flex">
                            <div class="flex-1 pr-4">
                                <h4 class="px-2 text-xl font-bold text-navy-700 dark:text-black">
                                    Breeding Details
                                </h4>
                                <div class="px-5 py-5">
                                    <label class="font-semibold text-sm text-gray-600  block" for="sow_id">Sow Name</label>
                                    <select name="" id="sow_id" v-model="form.sow_id"  class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " disabled>
                                        <option value="" disabled>Select a Sow</option>
                                        <option v-for="sow in sows" :value="sow.id" :key="sow.id" readonly>{{ sow.sow_no }}</option>
                                    </select>
                                    <div class="text-red-600" v-if="form.errors.sow_id">{{ form.errors.sow_id }}</div>

                                    <label class="font-semibold text-sm text-gray-600  block" for="sow_id">Boar's Breed</label>
                                    <select name="" id="boar_id" v-model="form.boar_id" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " disabled>
                                        <option value="" disabled>Select a Boar</option>
                                        <option v-for="boar in boars" :value="boar.id" :key="boar.id" >{{ boar.breed }}</option>
                                    </select>
                                    <div class="text-red-600" v-if="form.errors.boar_id">{{ form.errors.boar_id }}</div>

                                    <label class="font-semibold text-sm text-gray-600  block" for="date_of_breed">Date of Breed</label>
                                    <input type="date" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.date_of_breed" @input="date_of_breed = $event.target.value" />
                                    <div class="text-red-600" v-if="form.errors.date_of_breed">{{ form.errors.date_of_breed }}</div>

                                    <label class="font-semibold text-sm text-gray-600 block" for="possible_reheat">Possible Reheat</label>
                                    <input type="date" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600"
                                      v-model="form.possible_reheat" readonly />
                                    <div class="text-red-600" v-if="form.errors.possible_reheat">{{ form.errors.possible_reheat }}</div>

                                    <label class="font-semibold text-sm text-gray-600 block" for="changeFeeds">Change Date For Lactating</label>
                                    <input type="date" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600"
                                      v-model="form.changeFeeds" readonly  />
                                    <div class="text-red-600" v-if="form.errors.changeFeeds">{{ form.errors.changeFeeds }}</div>

                                    <label class="font-semibold text-sm text-gray-600 block" for="exp_date_of_farrowing">Expected Date of Farrowing</label>
                                    <input type="date" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600"
                                      v-model="form.exp_date_of_farrowing" />
                                    <div class="text-red-600" v-if="form.errors.exp_date_of_farrowing">{{ form.errors.exp_date_of_farrowing }}</div>



                                    <button class="px-4 py-2 mt-2 bg-blue-400 w-full rounded border border-blue-600 shadow hover:bg-blue-500">
                                        Update Breeding
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

