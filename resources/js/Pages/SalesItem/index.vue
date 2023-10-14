<script setup>
import {Head, useForm } from "@inertiajs/vue3";
import SideBarLayout from "@/Layouts/SideBarLayout.vue";
import { computed, ref } from "vue";
const form = useForm({
  cust_id: '',
  payment:'',
  is_credit:0,
  balance:'',   
  salesItems:
  [{
    pen_no: '',
    pig_weight: '',
    rate: '',
    total:''
  
  }]

});

function addSaleItem() {
  form.salesItems.push
  ({
    pen_no: '',
    pig_weight: '',
    rate: '',
   
  });
};

function removeSaleItem(index)
{
  form.salesItems.splice(index, 1);
};

    const calculateTotal = (item) => 
    {
        const pigWeight = parseFloat(item.pig_weight);
        const rate = parseFloat(item.rate);

        if (!isNaN(pigWeight) && !isNaN(rate)) {
        return (pigWeight * rate).toFixed(2); // Ensure two decimal places
        } else {
        return '';
        }
    };

    //this is to compute all the total amount in the array(inputted)
    const totalOfAllItems = computed(() => {
      let total = 0;
      form.salesItems.forEach((item) => {
        const itemTotal = parseFloat(calculateTotal(item));
        if (!isNaN(itemTotal)) {
          total += itemTotal;
        }
      });
      return total.toFixed(2); // Ensure two decimal places
    });

    //to compute the totalofallitems minus the amount inputted (pilay gibayad)
    const balance = computed(() => {
      const total = parseFloat(totalOfAllItems.value);
      const amount = parseFloat(form.is_credit);
      if (!isNaN(total) && !isNaN(amount)) {
        return (total - amount).toFixed(2); // Ensure two decimal places
      }
      return '';
    });

const props = defineProps({
  salesItems:Array,
  customers:Object,
  sale:Object,
  total:Number,
  totalAmount:Number
});

function submit() {
  form.post('/sales/');
  form.cust_id=""
//   form.salesItems=[];

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

                      <div class="container mx-auto mt-2">
                        <div class="flex justify-between">
                            <h1 class="text-3xl font-medium text-gray-700 "></h1>
                            <button @click="addSaleItem" class="bg-blue-500 flex justify-center items-center w-full text-dark px-3 py-2 rounded-md focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                            Add item
                            </button>
                        </div>
                        
                        <table class="min-w-full">
                            
                          <thead>
                            <tr>
                              <th class="px-6 py-3 bg-gray-100 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">Pen No</th>
                              <th class="px-6 py-3 bg-gray-100 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">Pig Weight</th>
                              <th class="px-6 py-3 bg-gray-100 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">Rate</th>
                              <th class="px-6 py-3 bg-gray-100 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">Total</th>
                              <th class="px-6 py-3 bg-gray-100 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr  v-for="(item, index) in form.salesItems" :key="index">
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <input type="text" class="w-full border rounded-md p-2" placeholder="Pen No" v-model="item.pen_no">
                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <input type="number" class="w-full border rounded-md p-2" placeholder="Pig Weight" v-model="item.pig_weight">
                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <input type="number" class="w-full border rounded-md p-2" placeholder="Rate" v-model="item.rate">
                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <!-- <input type="number" class="w-full border rounded-md p-2" placeholder="Total" v-model="item.total" readonly> -->
                                <input type="number" class="w-full border rounded-md p-2" placeholder="Total" :value="calculateTotal(item)" readonly>
                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <button @click="removeSaleItem(index)" class="bg-red-500 flex justify-center items-center w-full text-dark px-3 py-2 rounded-md focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Remove
                                  </button>
                              </td>
                            </tr>
                            <tr >
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                
                                <td colspan="2" class="mt-6 mr-2">
                                    <div class="flex justify-between">
                                        <label class="leading-loose mr-3 mt-3">Total:</label>
                                        <input type="number" class=" px-3 py-2 mt-3 mb-3 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Total" :value="totalOfAllItems" readonly>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <label class="leading-loose mr-3">Payment</label>
                                        <select
                                        id="cust_id"
                                        name="cust_id"
                                        v-model="form.payment"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                        >
                                        <option value="" disabled hidden>Select Payment</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        </select>
                                        <div class="text-sm text-red-500 italic" v-if="form.errors.payment">{{ form.errors.payment }}</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <label class="leading-loose mr-3 mt-3 ">Amount</label>
                                        <input type="number" class="px-4 py-2 mt-3 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="amount" v-model="form.is_credit">
                                    </div>
                                    <div class="flex justify-between">
                                        <label class="leading-loose mr-3 mt-3 ">Balance:</label>
                                        <input type="number" class="px-4 py-2 mt-3 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Total" :value="balance" readonly>
                                        
                                        <!-- <input type="number" class="px-4 py-2 mt-3 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Balance" v-model="form.balance"> -->
                                    </div>
                                    <div class="flex justify-between">
                                        <label class="leading-loose mr-3 mt-3 ">Remarks</label>
                                        <input type="text" class="px-4 py-2 mt-3 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 mb-2" placeholder="Remarks" v-model="form.remarks">
                                    </div>
                                </td>

                            </tr>
                          </tbody>
                        </table>
                      </div>

                      <!-- <div v-for="(item, index) in form.salesItems" :key="index">
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
                          <div>
                            <label class="leading-loose">Total</label>
                            <input
                              type="number"
                              :v-model="total" readonly
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
                        <button @click="addSaleItem()" class="bg-blue-500 flex justify-center items-center w-full text-dark px-3 py-2 rounded-md focus:outline-none">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                          </svg>
                          Add to list
                        </button>


                        <br>

                      </div> -->
                    
                        <button class="bg-blue-500 flex justify-center items-center w-full text-dark px-5 py-2 rounded-md focus:outline-none p" type="submit">Create </button>
                    
                      


                    </form>


              </div>


          </div>
      </div>

  </SideBarLayout>
</template>
