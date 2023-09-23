<script setup>
import { useForm } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const props = defineProps({
    customerId: Number,
    customers: Object,
});

const  form  = useForm({
    // sale_id:props.customerId.value;
    cust_id: '',
    pen_no: '',
    pig_weight: '',
    rate: '',
});

const saleItems = ref([]);

const addItem = () => {
    saleItems.value.push({
        pen_no: form.pen_no,
        pig_weight: form.pig_weight,
        rate: form.rate,
    });

    // Clear form fields
    form.pen_no = '';
    form.pig_weight = '';
    form.rate = '';
};

const cus = computed(() => {
    const selectedCustomer = form.customerId;
    const foundCustomer = props.customers.find(customer => customer.id === selectedCustomer);
    return foundCustomer ? foundCustomer.name : 'unknown';
});

function submit() {
    form.post('/sales/');
}
</script>

<template>
    <div>
        <form @submit.prevent="submit" >
            <div class="px-4 py-5">

                <label class="font-semibold text-sm text-gray-600  block" for="pen_no">Pen no</label>
                <input type="number" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 "  v-model="form.pen_no"/>
                <div class="text-red-600" v-if="form.errors.pen_no">{{ form.errors.pen_no }}</div>

                <label class="font-semibold text-sm text-gray-600  block" for="pig_weight">Pig's Weight</label>
                <input type="number" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 "  v-model="form.pig_weight"/>
                <div class="text-red-600" v-if="form.errors.pig_weight">{{ form.errors.pig_weight }}</div>

                <label class="font-semibold text-sm text-gray-600  block" for="rate" >Rate</label>
                <input type="number" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.rate" />
                <div class="text-red-600" v-if="form.errors.rate">{{ form.errors.rate }}</div>

                <button  type="submit" class="px-4 py-2 mt-2 bg-blue-400 w-full rounded border border-blue-600 shadow hover:bg-blue-500">
                    Add
                </button>
            </div>
        </form>
    </div>
</template>
