<script setup>
import {Head, useForm } from "@inertiajs/vue3";
import SideBarLayout from "@/Layouts/SideBarLayout.vue";
const form = useForm({
    cust_id: '',
    salesItems: [{
          pen_no: '',
          pig_weight: '',
          rate: ''
        }]
});

function addSaleItem() {
    form.salesItems.push({
        pen_no: '',
        pig_weight: '',
        rate: ''
    });
};

function removeSaleItem(index){
      form.salesItems.splice(index, 1);
};

const props = defineProps({
    salesItems:Array,
    customers:Object,
    sale:Object,
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

                      </form>
                </div>
            <div class="w-full px-2">
                <div class="h-12">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                       
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <!-- <th class="py-3 px-6 text-center">Customer</th> -->
                                    <th class="py-3 px-6 text-center">Customer Name</th>
                                    <th class="py-3 px-6 text-center">Pen No</th>
                                    <th class="py-3 px-6 text-center">Weight</th>
                                    <th class="py-3 px-6 text-center">Rate</th>
                                    <th class="py-3 px-6 text-center">Total</th>
                                    <th class="py-3 px-6 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light" v-for="items in salesItems" :key="items.id">

                                <tr  class="border-b border-gray-200 hover:bg-gray-100" >

                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium"> {{items.sale.customers.name}}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{items.pig.pen_no}}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{items.pig_weight}}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{items.rate}}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{items.total}}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">

                                            <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                <a href="#" class="btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="w-4  ml-2 mr-2 transform hover:text-red-500 hover:scale-110">
                                                <a href="#" class="btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            </div>
        </div>

   </SideBarLayout>
</template>