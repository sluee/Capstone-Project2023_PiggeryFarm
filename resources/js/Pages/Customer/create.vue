<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, useForm  } from '@inertiajs/vue3';
    const form = useForm({
        name: null,
        address: null,
        phone: null,


    })
    const props = defineProps({
        customers:Object
    })
    function submit() {
        form.post('/customers/')
    }
</script>

<template>
    <Head title="Create Customer" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">Create Customer</h2>
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded" as="button" href="/customers">Back</Link>
            </div>
        </template>


        <div class="py-6">
            <div class="flex flex-col justify-center items-center">
                <div class="relative flex flex-col items-center rounded-[20px] w-[500px] max-w-[95%] mx-auto bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none p-3">
                    <div class="mt-2 mb-8 w-full">
                        <form @submit.prevent="submit" class="flex">
                            <div class="flex-1 pr-4">
                                <h4 class="px-2 text-xl font-bold text-navy-700 dark:text-black">
                                    Customer Details
                                </h4>
                                <div class="px-5 py-5">
                                    <label class="font-semibold text-sm text-gray-600  block" for="name">Name</label>
                                    <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.name"/>
                                    <div class="text-red-600" v-if="form.errors.name">{{ form.errors.name }}</div>

                                    <label class="font-semibold text-sm text-gray-600  block" for="address">Address</label>
                                    <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.address"/>
                                    <div class="text-red-600" v-if="form.errors.address">{{ form.errors.address }}</div>

                                    <label class="font-semibold text-sm text-gray-600  block" for="phone">Phone</label>
                                    <input type="number" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.phone" />
                                    <div class="text-red-600" v-if="form.errors.phone">{{ form.errors.phone }}</div>

                                    <button class="px-4 py-2 mt-2 bg-blue-400 w-full rounded border border-blue-600 shadow hover:bg-blue-500">
                                        Create Customer
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

