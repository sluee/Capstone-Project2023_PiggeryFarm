<script setup>
import {Head, useForm } from "@inertiajs/vue3";
import SideBarLayout from "@/Layouts/SideBarLayout.vue";
const form = useForm({
    cust_id: '',
    salesItems: [{
          pen_no: '',
          pig_weight: '',
          rate: '',
    }]

});



function addSaleItem() {
    form.salesItems.push({
        pen_no: '',
        pig_weight: '',
        rate: '',

    });
};

function removeSaleItem(index){
      form.salesItems.splice(index, 1);
};

const props = defineProps({
    salesItems:Array,
    customers:Object,
    sale:Object,
    total:Number,
    totalAmount:Number
});



function submit() {
    form.post('/sales/');

}
</script>

<template>
    <Head title="Invoice" />

    <SideBarLayout>
        <template #header >
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sale Invoice</h2>

            </div>
        </template>

        <div class="px-2 mt-5">
            <div class="p-4 mx-2">
                <div class="flex justify-start">
                    <form @submit.prevent="submit">
                        <div>
                          <label class="leading-loose">Customer</label>
                          <select
                            id="cust_id"
                            name="cust_id"
                            v-model="form.cust_id"
                            class="pr-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                          >
                            <option value="" disabled>Select Customer</option>
                            <option v-for="cust in customers" :value="cust.id" :key="cust.id">{{ cust.name }}</option>
                          </select>
                          <div class="text-sm text-red-500 italic" v-if="form.errors.cust_id">{{ form.errors.cust_id }}</div>
                        </div>
                        <div v-for="(item, index) in form.salesItems" :key="index">
                          <div class="grid gap-6 mb-6 md:grid-cols-4 px-2">
                            <div>
                              <label class="leading-loose">Pen_no</label>
                              <input
                                type="number"
                                v-model="item.pen_no"
                                class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                              />
                              <div class="text-sm text-red-500 italic" v-if="form.errors.pen_no">{{ form.errors.pen_no }}</div>
                            </div>
                            <div>
                              <label class="leading-loose">Pig Weight</label>
                              <input
                                type="number"
                                v-model="item.pig_weight"
                                class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"

                              />
                              <div class="text-sm text-red-500 italic" v-if="form.errors.pig_weight">{{ form.errors.pig_weight }}</div>
                            </div>
                            <div>
                              <label class="leading-loose">Rate</label>
                              <input
                                type="number"
                                v-model="item.rate"
                                class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"

                              />
                              <div class="text-sm text-red-500 italic" v-if="form.errors.rate">{{ form.errors.rate }}</div>
                            </div>
                            <!-- <div>
                              <label class="leading-loose">Total</label>
                              <input
                                type="number"
                                :value="props.item.total" readonly
                                class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"

                              />
                              <div class="text-sm text-red-500 italic" v-if="form.errors.rate">{{ form.errors.rate }}</div>
                            </div> -->


                            <div class="mt-7">
                              <button @click="removeSaleItem(index)" class="bg-red-500 flex justify-center items-center w-full text-dark px-3 py-2 rounded-md focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Remove
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class=" grid gap-2 mb-6 md:grid-cols-2 px-2 py-2" >
                          <button @click="addSaleItem" class="bg-blue-500 flex justify-center items-center w-full text-dark px-3 py-2 rounded-md focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                            Add to list
                          </button>


                          <br>
                          <button class="bg-blue-500 flex justify-center items-center w-full text-dark px-10 py-2 rounded-md focus:outline-none p" type="submit">Create </button>
                        </div>
                        <!-- <div class="flex justify-start">


                              <div>
                                <label class="leading-loose">Total Amount</label>
                                <input
                                  type="number"
                                  v-model="form.totalAmount"
                                  class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                />
                              </div>
                              <div>
                                <label class="leading-loose">Payment</label>
                                <input
                                  type="number"
                                  v-model="form.payment"
                                  class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                />
                              </div>
                        </div> -->


                      </form>


                </div>


            </div>
        </div>

   </SideBarLayout>
</template>
