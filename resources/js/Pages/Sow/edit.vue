<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, useForm  } from '@inertiajs/vue3';
    import { ref } from 'vue'

    const props = defineProps({
        sows:Object
    })
    const form = useForm({
        sow_no: props.sows.sow_no,
        location: props.sows.location,
        date_arrived: props.sows.date_arrived,

    })
    // function submit() {
    //     form.put('/sows/' +props.sows.id)
    
    // }
    const isLoading = ref(false);

    const submit = async () => {
        isLoading.value = true;
        form.put('/sows/' +props.sows.id)
        setTimeout(() => {
            isLoading.value = false;
        }, 5000);
    };
</script>

<template>
    <Head title="Update Sow" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">Update Sow</h2>
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded" as="button" href="/sows">Back</Link>
            </div>
        </template>


        <div class="py-6">
            <div class="flex flex-col justify-center items-center">
                <div class="relative flex flex-col items-center rounded-[20px] w-[500px] max-w-[95%] mx-auto bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none p-3">
                    <div class="mt-2 mb-8 w-full">
                        <form @submit.prevent="submit" class="flex">
                            <div class="flex-1 pr-4">
                                <h4 class="px-2 text-xl font-bold text-navy-700 dark:text-black">
                                    Sow Details
                                </h4>
                                <div class="px-5 py-5">
                                    <label class="font-semibold text-sm text-gray-600  block" for="sow_no">Sow No</label>
                                    <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.sow_no"/>
                                    <div class="text-red-600" v-if="form.errors.sow_no">{{ form.errors.sow_no }}</div>

                                    <label class="font-semibold text-sm text-gray-600  block" for="location">Location</label>
                                    <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.location" />
                                    <div class="text-red-600" v-if="form.errors.location">{{ form.errors.location }}</div>

                                    <label class="font-semibold text-sm text-gray-600  block" for="date_arrived" >Date of Arrival</label>
                                    <input type="date" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.date_arrived" />
                                    <div class="text-red-600" v-if="form.errors.date_arrived">{{ form.errors.date_arrived }}</div>

                                    <button class="px-4 py-2 mt-2 bg-blue-400 w-full rounded border border-blue-600 shadow hover:bg-blue-500">
                                        Update Sow
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

