<template>

    <Head title="Financial Liquidation Charts" />

    <SideBarLayout>

        <div class="w-full px-5 py-4">
            <div class="h-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="  mb-7">
                        <div class="flex justify-center mb-2">
                            <div><img src="/images/logo.png" alt="Logo" class="w-[70px] h-[70px] rounded-full object-cover"></div>
                            <div class=" text-sm">
                                <h3 class="font-bold text-slate-700">RQR Piggery Farm || Saint Agustin Piggery Farm</h3>
                                <h3 class="font-bold text-slate-700 text-center">San Agustin, Sagbayan, Bohol</h3>
                                <h3 class="font-bold text-slate-700 text-center">Canmaya Centro, Sagbayan, Bohol</h3><br>
                                <h3 class="font-bold text-slate-700 text-center">Financial Liquidation Chart</h3>
                            </div>

                        </div>
                    </div>
                    <div v-if="monthlyFinancial">
                        <canvas ref="chartRef" width="200" height="80"></canvas>


                      </div>
                      <div v-else>
                        Loading...
                      </div>

                    <!-- <Pagination :links="transactions.links" class="mt-6 flex justify-center"/> -->
                </div>
            </div>


        </div>

    </SideBarLayout>

</template>

<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import moment from 'moment'
import { onMounted, ref } from 'vue';
import Chart from 'chart.js/auto';

function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
}
 const props = defineProps({
    monthlyFinancial:Object
 })

    const chartRef = ref(null);

    onMounted(() => {
  if (chartRef.value) {
    const ctx = chartRef.value.getContext('2d');

    if (!props.monthlyFinancial || !Array.isArray(props.monthlyFinancial)) {
      console.error('Invalid monthlyFinancial data format');
      return;
    }

    const chartData = props.monthlyFinancial;

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: chartData.map(entry => {
          // Format the date
          const formattedDate = new Date(entry.date).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long', // You can use 'short' or 'numeric' depending on your preference
          });

          return formattedDate;
        }),
        datasets: [{
          label: 'Total Cash Balance',
          data: chartData.map(entry => entry.totalCashBalance),
          backgroundColor: 'rgba(39,150,248,0.68)',
          borderColor: 'rgba(23, 68, 88, 1)',
          borderWidth: 1,
        }],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Money on Bank', // Your desired label for the y-axis
            },
          },
        },
      },
    });
  }
});



</script>
