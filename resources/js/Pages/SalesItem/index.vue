<script setup>
import {Head, useForm } from "@inertiajs/vue3";
import SideBarLayout from "@/Layouts/SideBarLayout.vue";
import { computed, ref , watch} from "vue";
    const form = useForm({
        cust_id: '',
        total_amount:'',
        payment:'',
        is_credit:0,
        balance:'',
        remarks:'',
        salesItems:
        [{
            pig_weight: '',
            rate: '',
            total:''

        }]

    });

    function addSaleItem() {
        form.salesItems.push
        ({
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
    watch(() => form.salesItems, (newSalesItems) => {
        newSalesItems.forEach((item) => {
            item.total = calculateTotal(item);
        });
    }, { deep: true });


    //this is to compute all the total amount in the array(inputted)
    const totalOfAllItems = computed(() => {
        let total = 0;
        form.salesItems.forEach((item) => {
            const itemTotal = parseFloat(calculateTotal(item));
            if (!isNaN(itemTotal)) {
            total += itemTotal;
            }
        });

        form.total_amount = total.toFixed(2);
        return total.toFixed(2); // Ensure two decimal places
    });


    watch([totalOfAllItems, () => form.is_credit], ([total, isCredit]) => {
        const totalAmount = parseFloat(total);
        const creditAmount = parseFloat(isCredit);
        if (!isNaN(totalAmount) && !isNaN(creditAmount)) {
            form.balance = (totalAmount - creditAmount).toFixed(2);
        } else {
            form.balance = '';
        }
    });


    watch(() => form.salesItems, (newSalesItems) => {
  // Calculate the total amount from the newSalesItems array
        const totalAmount = newSalesItems.reduce((total, item) => {
            // Assuming that 'pig_weight' and 'rate' are numeric values
            return total + (item.pig_weight * item.rate);
        }, 0);

        // Update the form's total_amount property with the calculated total
        form.total_amount = totalAmount;
    });

    watch(() => [form.total_amount, form.is_credit], ([newTotalAmount, newIsCredit]) => {
        if (newTotalAmount !== undefined && newIsCredit !== undefined) {
            const balanceAmount = newTotalAmount - newIsCredit;
            form.balance = balanceAmount;
        } else {
            // Handle the case where either total_amount or is_credit is not defined
            form.balance = null; // You can set this to an appropriate default value or handle it differently
        }
    });



    const props = defineProps({
    salesItems:Array,
    customers:Object,
    sale:Object,
    total:Number,
    totalAmount:Number
    });

    function submit() {
        form.post('/sales');
    }
</script>

<template>
    <Head title="Create Invoice" />

  <SideBarLayout>
      <template #header >
          <div class="flex justify-between">
              <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Sale Invoice</h2>

          </div>
      </template>

      <div class="px-8 py-12">
          <div class=" w-full h-screen ">
            <div class="flex justify-center mb-5 ">
                <div><img src="/images/logo.png" alt="Logo" class="w-[70px] h-[70px] rounded-full object-cover"></div>
                <div class=" ">
                    <h3 class="font-bold text-sm text-slate-700">RQR Piggery Farm || Saint Agustin Piggery Farm</h3>
                    <h3 class="font-bold text-sm text-slate-700 text-center">San Agustin, Sagbayan, Bohol</h3>
                    <h3 class="font-bold text-sm text-slate-700 text-center">Canmaya Centro, Sagbayan, Bohol</h3><br>
                    <h2 class="font-bold text-m text-slate-700 text-center">Sales Invoice</h2>
                </div>

            </div>
              <div class="flex justify-start ">

                  <form @submit.prevent="submit">
                      <div>
                        <label class="leading-loose">Customer: </label>
                        <select
                          id="cust_id"
                          name="cust_id"
                          v-model="form.cust_id"
                          class="pr-4 py-2 w-[180px]  border focus:ring-gray-500 focus:border-gray-900  sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                        >
                          <option value="" disabled>Select Customer</option>
                          <option v-for="cust in customers" :value="cust.id" :key="cust.id">{{ cust.name }}</option>
                        </select>
                        <div class="text-sm text-red-500 italic" v-if="form.errors.cust_id">{{ form.errors.cust_id }}</div>
                      </div>

                      <div class="container mx-auto mt-2">
                        <div class="flex justify-between">
                            <h1 class="text-3xl font-medium text-gray-700 "></h1>
                            <button @click="addSaleItem" class="bg-blue-500 hover:bg-blue-600 flex justify-center items-center w-[180px] mb-5 text-dark px-3 py-2 rounded-md focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                            Add item
                            </button>
                        </div>

                        <table class="w-fullborder-gray-300">

                          <thead >
                            <tr class="bg-blue-300">
                              <th class="px-6 py-3  border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">Pig Weight</th>
                              <th class="px-6 py-3  border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">Rate</th>
                              <th class="px-6 py-3  border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">Total</th>
                              <th class="px-6 py-3  border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr  v-for="(item, index) in form.salesItems" :key="index">

                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <input type="number" class="w-full border rounded-md p-2" placeholder="Pig Weight" v-model="item.pig_weight">
                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <input type="number" class="w-full border rounded-md p-2" placeholder="Rate" v-model="item.rate">
                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <!-- <input type="number" class="w-full border rounded-md p-2" placeholder="Total" v-model="item.total" readonly> -->
                                <input type="number" class="w-full border rounded-md p-2" placeholder="Total" v-model="item.total" readonly>
                              </td>

                              <td class="py-3 px-6 text-center">

                                    <button @click="removeSaleItem(index)" class="bg-red-500 flex hover:bg-red-600 justify-center items-center w-full text-dark px-1 py-2 rounded-md focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
                                        <input v-model="form.total_amount"  name="total_amount"  class=" px-3 py-2 mt-3 mb-3 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Total"  readonly>
                                    </div>

                                    <div class="flex justify-between">
                                        <label class="leading-loose mr-3">Payment</label>
                                        <select
                                        id="payment"
                                        name="payment"
                                        v-model="form.payment"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                        >
                                        <option value="" disabled hidden>Select Payment</option>
                                        <option value="Cash">Full Payment</option>
                                        <option value="Bank Transfer">Partial Payment</option>
                                        </select>
                                        <div class="text-sm text-red-500 italic" v-if="form.errors.payment">{{ form.errors.payment }}</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <label class="leading-loose mr-3 mt-3 ">Amount</label>
                                        <input id="is_credit" type="number" class="px-4 py-2 mt-3 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="amount" v-model="form.is_credit">
                                    </div>
                                    <div class="flex justify-between">
                                        <label class="leading-loose mr-3 mt-3 ">Balance:</label>

                                        <input id="balance" type="number" class="px-4 py-2 mt-3 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Total"  v-model="form.balance"  name="balance" readonly>

                                        <!-- <input type="number" class="px-4 py-2 mt-3 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Balance" v-model="form.balance"> -->
                                    </div>
                                    <div class="flex justify-between">
                                        <label class="leading-loose mr-3 mt-3 ">Remarks</label>
                                        <input id="remarks" type="text" class="px-4 py-2 mt-3 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 mb-2" placeholder="Remarks" v-model="form.remarks">
                                    </div>
                                </td>

                            </tr>
                          </tbody>
                        </table>

                      </div>

                        <div class="flex justify-between">
                            <h1 class="text-3xl font-medium text-gray-700 "></h1>

                            <button class=" bg-blue-600 flex justify-center hover:bg-blue-700 w-[180px] items-center text-dark px-5 py-2 rounded-md focus:outline-none p" type="submit">Save </button>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </SideBarLayout>
</template>
