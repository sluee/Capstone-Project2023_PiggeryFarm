<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, useForm  } from '@inertiajs/vue3';

    const props = defineProps({
        inventory:Object,
        feeds:Object
    })

    const form = useForm({
        feed_id: props.inventory.feed_id,
        qty: props.inventory.qty,
        date_received: props.inventory.date_received,
        costPerStocks: props.inventory.costPerStocks,
        discount: props.inventory.discount,
        totalAmountAfterDiscount: props.inventory.totalAmountAfterDiscount,
    })

    function submit() {
        if (
            props.feeds.feed_id === form.feed_id &&
            props.inventory.qty === form.qty &&
            props.inventory.date_received === form.date_received &&
            props.inventory.costPerStocks === form.costPerStocks &&
            props.inventory.discount === form.discount &&
            props.inventory.totalAmountAfterDiscount === form.totalAmountAfterDiscount
        ) {
            alert("You've made no changes!")
        } else {
        form.put('/inventories/' + props.inventory.id)
        }
    }
</script>

<template>
    <Head title="Create Inventory Item" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">Edit Inventory Item</h2>
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded" as="button" href="/inventories">Back</Link>
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
                                        <label class="font-semibold text-sm text-gray-600 block" for="feed_id">Feed Name</label>
                                        <select name="" id="feed_id" v-model="form.feed_id" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600">
                                        <option value="" disabled>Select Feed</option>
                                        <option v-for="feed in feeds" :value="feed.id" :key="feed.id">{{ feed.name }}</option>
                                        </select>
                                        <div class="text-red-600" v-if="form.errors.feed_id">{{ form.errors.feed_id }}</div>
                                    </div>
                                    <div>
                                        <label class="font-semibold text-sm text-gray-600  block" for="qty">Quantity</label>
                                        <input type="number" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.qty"/>
                                        <div class="text-red-600" v-if="form.errors.qty">{{ form.errors.qty }}</div>
                                    </div>
                                    <div>
                                        <label class="font-semibold text-sm text-gray-600  block" for="date_received" >Date of Arrival</label>
                                        <input type="date" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.date_received" />
                                        <div class="text-red-600" v-if="form.errors.date_received">{{ form.errors.date_received }}</div>
                                    </div>
                                    <div>
                                        <label class="font-semibold text-sm text-gray-600  block" for="costPerStocks">Cost Per Stocks</label>
                                        <input type="number" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.costPerStocks" />
                                        <div class="text-red-600" v-if="form.errors.costPerStocks">{{ form.errors.costPerStocks }}</div>
                                    </div>
                                    <div>
                                        <label class="font-semibold text-sm text-gray-600  block" for="discount">Unit Discount</label>
                                        <input type="number" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.discount" />
                                        <div class="text-red-600" v-if="form.errors.discount">{{ form.errors.discount }}</div>
                                    </div>

                                    <button type="submit    " class="px-2 py-2 mt-2 bg-blue-400 w-full rounded border border-blue-600 shadow hover:bg-blue-500">
                                        Save Changes
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

