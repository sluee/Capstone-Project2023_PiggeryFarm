<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue'
    import { Head, Link, router, useForm } from '@inertiajs/vue3';
    import moment from'moment'
    import { ref, computed, watch, onMounted, reactive } from 'vue';


    const props = defineProps({
        employees : Object,
        payroll:Array,
        cashAdvances:Object

    })
    const form = useForm({
        payrollPeriodFrom:'',
        payrollPeriodTo:'',
        noOfDaysWorked:'',
        total_gross_amount:'',
        total_deductions_amount:'',
        total_net_amount:'',
        payrolls: reactive(props.employees.map(employee => ({
            emp_id: employee.id,
            daysWorked: '',
            totalBasicPay:0,
            overtimeHours: 0,
            overtimeAmount: 0,
            grossAmount:0,
            personalDeduction:0,
            totalDeductions: 0,
            cashAdvance: getCashAdvanceTotal(employee.id),
            netAmount: 0,
        })))
    });

    function getCashAdvanceTotal(emp_id) {
    // Assuming cashAdvances is an array with emp_id and totalCashAdvance properties
    const cashAdvanceEntry = props.cashAdvances.find(entry => entry.emp_id === emp_id);

    // Return 0 if there's no corresponding entry, otherwise return the value of totalCashAdvance
    return cashAdvanceEntry ? cashAdvanceEntry.totalCashAdvance : 0;
}

     // Watch for changes in form.payrolls
    watch(() => form.payrolls, (newPayrolls) => {
      newPayrolls.forEach((payroll, index) => {
        const rate = props.employees[index].position.rate;
        const daysWorked = payroll.daysWorked;
        if (rate && daysWorked !== '') {
          payroll.totalBasicPay = rate * parseFloat(daysWorked);
        } else {
          payroll.totalBasicPay = 0;
        }
      });
    }, { deep: true });

    // If needed, you can initialize the initial totalBasicPay values here
    onMounted(() => {
      form.payrolls.forEach((payroll, index) => {
        const rate = props.employees[index].position.rate;
        const daysWorked = payroll.daysWorked;
        if (rate && daysWorked !== '') {
          payroll.totalBasicPay = rate * parseFloat(daysWorked);
        }
      });
    });

    //This is to get the overtimeAmount
    watch(form.payrolls, (newPayrolls) => {
        newPayrolls.forEach((payroll, index) => {
            const rate = props.employees[index].position.rate;
            const overtimeHours = payroll.overtimeHours;
            if (rate && overtimeHours !== '') {
                // Calculate overtimeAmount and format it with two decimal points
                const rawOvertimeAmount = (rate / 8) * overtimeHours * 1.25;
                payroll.overtimeAmount = parseFloat(rawOvertimeAmount.toFixed(2));
            } else {
                payroll.overtimeAmount = 0;
            }
        });
    }, { deep: true });

   ;

    watch(form.payrolls, (newPayrolls) => {
        newPayrolls.forEach((payroll, index) => {
            const totalBasicPay = payroll.totalBasicPay;
            const overtimeAmount = payroll.overtimeAmount;

            if (totalBasicPay && overtimeAmount !== '') {
                // Calculate overtimeAmount and format it with two decimal points
                const rawGrossAmount = totalBasicPay + overtimeAmount;
                payroll.grossAmount = parseFloat(rawGrossAmount.toFixed(2));
            } else {
                payroll.grossAmount = 0;
            }
        });

        // Recalculate total gross amount and update form.total_gross_amount
        const totalGrossAmount = newPayrolls.reduce((sum, payroll) => {
            return sum + payroll.grossAmount;
        }, 0);

        // Assuming form.total_gross_amount is reactive, update it
        form.total_gross_amount = totalGrossAmount;
    }, { deep: true });


//Cash Advancee
    watch(form.payrolls, (newPayrolls) => {
        newPayrolls.forEach((payroll, index) => {
            const cashAdvance = props.cashAdvances[index]?.totalCashAdvance || 0; // Use optional chaining
            const personalDeduction = payroll.personalDeduction;

            if (cashAdvance !== null && personalDeduction !== null && personalDeduction !== '') {
                const rawTotalDeduction = cashAdvance - parseFloat(personalDeduction);
                payroll.totalDeductions = parseFloat(rawTotalDeduction);
            } else {
                payroll.totalDeductions = 0;
            }
        });

        const totalDeductionsAmount = newPayrolls.reduce((sum, payroll) => {
            return  payroll.totalDeductions+sum ;
        }, 0);

        form.total_deductions_amount = totalDeductionsAmount;
    }, { deep: true });


   //To get the  net Amountt

   watch(form.payrolls, (newPayrolls) => {
        newPayrolls.forEach((payroll, index) => {
            const grossAmount = payroll.grossAmount;
            const personalDeduction = payroll.personalDeduction;

            if (grossAmount && personalDeduction !== '') {
                // Calculate overtimeAmount and format it with two decimal points
                const rawNetAmount = grossAmount - personalDeduction;
                payroll.netAmount = parseFloat(rawNetAmount.toFixed(2));
            } else {
                payroll.netAmount = 0;
            }
        });

        // Recalculate total gross amount and update form.total_gross_amount
        const totalNetAmount = newPayrolls.reduce((sum, payroll) => {
            return payroll.netAmount + sum;
        }, 0);

        // Assuming form.total_gross_amount is reactive, update it
        form.total_net_amount = totalNetAmount;
    }, { deep: true });

    // function submit() {
    //     form.post('/payroll');

    // }
    // watch([form.payrollPeriodFrom, form.payrollPeriodTo], () => {
    //   calculateDays();
    // });

    // Calculate the number of days
    const calculateDays = () => {
      const from = new Date(form.payrollPeriodFrom);
      const to = new Date(form.payrollPeriodTo);

      // Check if both dates are valid
      if (!isNaN(from.getTime()) && !isNaN(to.getTime())) {
        const timeDiff = Math.abs(to.getTime() - from.getTime());
        const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

        // Update the noOfDaysWorked
        form.noOfDaysWorked = diffDays;
      } else {
        // Handle invalid dates if needed
       form.noOfDaysWorked = 0;
      }
    };

const submit = async () => {
    // isLoading.value = true;
    form.post('/payroll');
    // setTimeout(() => {
    //     isLoading.value = false;
    // }, 5000);
};

</script>

<template>
    <Head title="Payroll" />

    <SideBarLayout>
        <template #header >
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl  leading-tight">Create Payroll</h2>
                <!-- <div style="position:relative">
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-9 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Payroll here" @keydown.enter="search($event)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#444  " width="20px" height="20px" viewBox="0 0 16 16"
                    style="position:absolute; top:10px; right:10px">
                    <path d="M12.027 9.92L16 13.95 14 16l-4.075-3.976A6.465 6.465 0 0 1 6.5 13C2.91 13 0 10.083 0 6.5 0 2.91 2.917 0 6.5 0 10.09 0 13 2.917 13 6.5a6.463 6.463 0 0 1-.973 3.42zM1.997 6.452c0 2.48 2.014 4.5 4.5 4.5 2.48 0 4.5-2.015 4.5-4.5 0-2.48-2.015-4.5-4.5-4.5-2.48 0-4.5 2.014-4.5 4.5z" fill-rule="evenodd"/>
                    </svg>
                </div>
                <div class="flex">
                    <Link class="button1 mb-2 py-2 px-3 bg-blue-300 shadow border-gray-300 border hover:bg-blue-400 rounded mr-3" as="button" href="/payroll/create">Create Payroll</Link>
                    <a href="/sows/pdf" class="flex  mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded mr-3 " target="blank">
                        <svg viewBox="0 0 512 512" version="1.1" height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#6666"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>pdf-document</title> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="add" fill="#000000" transform="translate(85.333333, 42.666667)"> <path d="M75.9466667,285.653333 C63.8764997,278.292415 49.6246897,275.351565 35.6266667,277.333333 L1.42108547e-14,277.333333 L1.42108547e-14,405.333333 L28.3733333,405.333333 L28.3733333,356.48 L40.5333333,356.48 C53.1304778,357.774244 65.7885986,354.68506 76.3733333,347.733333 C85.3576891,340.027178 90.3112817,328.626053 89.8133333,316.8 C90.4784904,304.790173 85.3164923,293.195531 75.9466667,285.653333 L75.9466667,285.653333 Z M53.12,332.373333 C47.7608867,334.732281 41.8687051,335.616108 36.0533333,334.933333 L27.7333333,334.933333 L27.7333333,298.666667 L36.0533333,298.666667 C42.094796,298.02451 48.1897668,299.213772 53.5466667,302.08 C58.5355805,305.554646 61.3626692,311.370371 61.0133333,317.44 C61.6596233,323.558965 58.5400493,329.460862 53.12,332.373333 L53.12,332.373333 Z M150.826667,277.333333 L115.413333,277.333333 L115.413333,405.333333 L149.333333,405.333333 C166.620091,407.02483 184.027709,403.691457 199.466667,395.733333 C216.454713,383.072462 225.530463,362.408923 223.36,341.333333 C224.631644,323.277677 218.198313,305.527884 205.653333,292.48 C190.157107,280.265923 170.395302,274.806436 150.826667,277.333333 L150.826667,277.333333 Z M178.986667,376.32 C170.098963,381.315719 159.922142,383.54422 149.76,382.72 L144.213333,382.72 L144.213333,299.946667 L149.333333,299.946667 C167.253333,299.946667 174.293333,301.653333 181.333333,308.053333 C189.877212,316.948755 194.28973,329.025119 193.493333,341.333333 C194.590843,354.653818 189.18793,367.684372 178.986667,376.32 L178.986667,376.32 Z M254.506667,405.333333 L283.306667,405.333333 L283.306667,351.786667 L341.333333,351.786667 L341.333333,329.173333 L283.306667,329.173333 L283.306667,299.946667 L341.333333,299.946667 L341.333333,277.333333 L254.506667,277.333333 L254.506667,405.333333 L254.506667,405.333333 Z M234.666667,7.10542736e-15 L9.52127266e-13,7.10542736e-15 L9.52127266e-13,234.666667 L42.6666667,234.666667 L42.6666667,192 L42.6666667,169.6 L42.6666667,42.6666667 L216.96,42.6666667 L298.666667,124.373333 L298.666667,169.6 L298.666667,192 L298.666667,234.666667 L341.333333,234.666667 L341.333333,106.666667 L234.666667,7.10542736e-15 L234.666667,7.10542736e-15 Z" id="document-pdf"> </path> </g> </g> </g></svg>
                            Export
                    </a>
                </div> -->
            </div>
        </template>
        <div class="">
            <div class="mt-5">
                <div class="container mx-auto mt-2">
                    <div class="mb-7">
                        <div class="flex justify-center mb-2">
                            <div><img src="/images/logo.png" alt="Logo" class="w-[70px] h-[70px] rounded-full object-cover"></div>
                            <div class=" text-sm">
                                <h3 class="font-semibold text-md ">RQR Piggery Farm || Saint Agustin Piggery Farm</h3>
                                <h3 class="font-semibold text-md  text-center">San Agustin, Sagbayan, Bohol</h3>
                                <h3 class="font-semibold text-md  text-center">Canmaya Centro, Sagbayan, Bohol</h3>
                            </div>

                        </div>
                    </div>
                    <form @submit.prevent="submit">
                        <div class="flex mb-2">
                            <label class="leading-loose px-3">Date Covered From: </label>
                            <input type="date" class="border rounded-lg h-8 w-100 mr-2 px-3 py-2   text-sm  text-gray-600" v-model="form.payrollPeriodFrom" @change="calculateDays"/>
                            <label class="leading-loose px-3">Date Covered To: </label>
                            <input type="date" class="border rounded-lg px-3 py-2  text-sm h-8 w-100  text-gray-600" v-model="form.payrollPeriodTo"  @change="calculateDays"/>

                          </div>
                        <div class="mb-2">
                            <label class="leading-loose px-3">No. of Working Days: </label>
                            <input type="number" class="border rounded-lg px-3 py-2  text-sm h-8 w-100  text-gray-600" v-model="form.noOfDaysWorked" readonly />
                        </div>
                        <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg px-3">

                          <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal ">
                                    <!-- <th>Id</th> -->
                                    <th>Employee</th>
                                    <th>Rate</th>
                                    <th>Days Worked</th>
                                    <th>Total Basic Pay</th>
                                    <th colspan="2">Overtime</th>
                                    <th >Gross Amount</th>
                                    <th>Cash Advance</th>
                                    <th>Personal Deductions</th>
                                    <th>Cash Advance Balance</th>
                                    <th>Net Amount</th>
                                  </tr>
                                  <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th colspan="4"></th> <!-- Placeholder for empty cells -->
                                    <th>Overtime Hours</th>
                                    <th>Overtime Amount</th>
                                    <th colspan="5"></th> <!-- Placeholder for empty cells -->
                                  </tr>

                            </thead>
                            <tbody>
                              <tr  v-for="(employee, index) in employees" :key="employee.id">

                                <td class="py-2 px-1 text-left whitespace-nowrap">
                                  <span>{{ employee.user.firstName }} {{ employee.user.lastName }}</span>
                                </td>
                                <td class="py-2 px-1">{{ employee.position.rate }}</td>

                                <td class="py-2 px-1">
                                  <input v-model="form.payrolls[index].daysWorked"  type="number" step="0.01" />
                                </td>
                                <td class="py-2 px-1">
                                  <input v-model="form.payrolls[index].totalBasicPay" type="number" step="0.01" readonly />
                                </td>
                                <td class="py-2 px-1">
                                  <input v-model="form.payrolls[index].overtimeHours"  type="number" step="0.01"/>
                                </td>
                                <td class="py-2 px-1">
                                  <input v-model="form.payrolls[index].overtimeAmount" type="number" step="0.01" readonly/>
                                </td>
                                <td class="py-2 px-1">
                                  <input v-model="form.payrolls[index].grossAmount" type="number" step="0.01" readonly/>
                                </td>
                                <td class="py-2 px-1">
                                  <input v-model="form.payrolls[index].cashAdvance" type="number" step="0.01" readonly/>
                                </td>


                                <td class="py-2 px-1">
                                  <input v-model="form.payrolls[index].personalDeduction" type="number" step="0.01"/>
                                </td>
                                <td class="py-2 px-1">
                                  <input v-model="form.payrolls[index].totalDeductions" type="number" step="0.01"/>
                                </td>
                                <td class="py-2 px-1">
                                  <input v-model="form.payrolls[index].netAmount" type="number" step="0.01" />
                                </td>
                              </tr>
                              <tr >
                                <td colspan="6" class="px-7">Total</td>
                                <td colspan="3" class="px-1">
                                    <input v-model="form.total_gross_amount" type="number" step="0.01" readonly/>
                                </td>
                                <td colspan="1" class="px-1">
                                    <input v-model="form.total_deductions_amount" type="number" step="0.01" readonly/>
                                </td>
                                <td  class="px-1">
                                    <input v-model="form.total_net_amount" type="number" step="0.01" readonly/>
                                </td>
                            </tr>
                            </tbody>

                          </table>
                        </div>
                        <div class="flex justify-between mt-3">
                          <h1 class="text-3xl font-medium text-gray-700"></h1>
                          <button class="bg-blue-500 flex justify-center hover:bg-blue-700 w-[180px] items-center text-dark px-5 py-2 rounded-md focus:outline-none" type="submit">Save</button>
                        </div>
                      </form>

                </div>
                <!-- <div v-if="isLoading" class="absolute inset-0 flex items-center justify-center">
                    <div class="spinner">
                      <div class="dot1"></div>
                      <div class="dot2"></div>
                      <div class="dot3"></div>
                    </div>
                </div> -->
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
