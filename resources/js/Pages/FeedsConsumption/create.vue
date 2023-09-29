<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, useForm  } from '@inertiajs/vue3';

    const form = useForm({
        inventory_id: '',
        qtyConsumed: null,
        date_consumed: null,
    })
    const props = defineProps({
        inventories:Object,
        consumptions:Object
    })
    function submit() {
        form.post('/consumptions/')
    }
</script>

<template>
    <Head title="Add Consumption Item" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">Add Consumption Item</h2>
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded" as="button" href="/consumptions">Back</Link>
            </div>
        </template>


        <div class="py-6">
            <div class="flex flex-col justify-center items-center">
                <div class="relative flex flex-col items-center rounded-[20px] w-[500px] max-w-[95%] mx-auto bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none p-3">
                    <div class="mt-2 mb-8 w-full">
                        <form @submit.prevent="submit" class="flex">
                            <div class="flex-1 pr-4">
                                <h4 class="px-2 text-xl font-bold text-navy-700 flex justify-center items-center">
                                    Item Details
                                </h4>
                                <div class="px-5 py-5 ">
                                    <div>
                                        <label class="font-semibold text-sm text-gray-600 block" for="inventory_id">Feed Name</label>
                                        <select name="" id="inventory_id" v-model="form.inventory_id" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600">
                                        <option value="" disabled>Select Feed</option>
                                        <option v-for="inv in inventories" :value="inv.id" :key="inv.id">{{ inv.feed.name }}</option>
                                        </select>
                                        <div class="text-red-600" v-if="form.errors.inventory_id">{{ form.errors.inventory_id }}</div>
                                    </div>
                                    <div>
                                        <label class="font-semibold text-sm text-gray-600  block" for="qtyConsumed">Quantity Consumed</label>
                                        <input type="number" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.qtyConsumed" />
                                        <div class="text-red-600" v-if="form.errors.qtyConsumed">{{ form.errors.qtyConsumed }}</div>
                                    </div>
                                    <div>
                                        <label class="font-semibold text-sm text-gray-600  block" for="date_consumed">Date Consumed</label>
                                        <input type="date" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.date_consumed" />
                                        <div class="text-red-600" v-if="form.errors.date_consumed">{{ form.errors.date_consumed }}</div>
                                    </div>

                                    <button class="px-2 py-2 mt-2 bg-blue-400 w-full rounded border border-blue-600 shadow hover:bg-blue-500">
                                        Add Inventory Item
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

