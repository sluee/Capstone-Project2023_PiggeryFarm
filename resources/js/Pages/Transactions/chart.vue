<template>

    <Head title="Financial Liquidation Charts" />

    <SideBarLayout>
        <div class="py-5">

            <div class="flex justify-end items-center">
                <label for="chartType" class="mr-2 font-bold text-slate-700">Select Chart Type:</label>
                <select v-model="selectedChartType" id="chartType" class="rounded-full">
                    <option value="monthly">Current Year</option>
                    <option value="yearly">All Year</option>
                </select>
            </div>
            <div class="flex justify-center mb-2">
                <div>
                    <img src="/images/logo.png" alt="Logo" class="w-[70px] h-[70px] rounded-full object-cover">
                </div>
                <div class="text-sm">
                    <h3 class="font-bold text-slate-700">RQR Piggery Farm || Saint Agustin Piggery Farm</h3>
                    <h3 class="font-bold text-slate-700 text-center">San Agustin, Sagbayan, Bohol</h3>
                    <h3 class="font-bold text-slate-700 text-center">Canmaya Centro, Sagbayan, Bohol</h3>
                    <br>

                </div>
            </div>
            <div v-show="selectedChartType === 'monthly'">
                <h3 class="font-bold text-slate-700 text-center">Financial Chart for {{ currentYear }}</h3>
                <div v-if="monthlyFinancial && monthlyFinancial.length > 0">
                    <canvas ref="chartRef" width="200" height="80"></canvas>

                </div>
                <div class=" bg-white p-6 rounded shadow flex justify-center text-justify" v-else>
                    <p class="text-center text-lg font-bold text-gray-900 py-6">Financial Chart information is unavailable for now</p>
                </div>
            </div>
            <div v-show="selectedChartType === 'yearly'">
                <div v-if="yearlyFinancial && yearlyFinancial.length > 0">
                    <h3 class="font-bold text-slate-700 text-center"> Yearly Financial Chart</h3>
                    <div class="w-full px-5 py-4">
                        <!-- Include the canvas directly in the component -->
                        <canvas id="yearlyFinancialChart" width="200" height="80"></canvas>
                    </div>
                </div>
                <div class="bg-white p-6 rounded shadow flex justify-center text-justify" v-else>
                    <p class="text-center text-lg font-bold text-gray-900 py-6">Financial Chart information for the entire year is unavailable for now</p>
                    </div>

            </div>


        </div>



    </SideBarLayout>

</template>

<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import moment from 'moment'
import { onMounted, ref, watch, } from 'vue';
import Chart from 'chart.js/auto';

function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
}
 const props = defineProps({
    monthlyFinancial:Object,
    currentYear:Number,
    yearlyFinancial:Object
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
                        // Format the date using the month and current year
                        const formattedDate = new Date(`${entry.month}-01 ${new Date().getFullYear()}`).toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
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

    const yearlyFinancialChart = ref(null);

    // Watch for changes in the monthlySales prop
    watch(() => props.yearlyFinancial, () => {
        if (yearlyFinancialChart.value) {
            yearlyFinancialChart.value.destroy(); // Destroy the existing chart if it exists
        }

        // Create and update the chart when the data changes
        createYearlyChart();
    });

    function createYearlyChart() {
        if (!props.yearlyFinancial || props.yearlyFinancial.length === 0) {
        // You can handle this case by displaying a message or taking any other action
        return;
    }
    const ctx = document.getElementById('yearlyFinancialChart').getContext('2d');

    // const ctx = document.getElementById('yearlyFinancialChart').getContext('2d');
    const { yearlyFinancial } = props;



    yearlyFinancialChart.value = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: yearlyFinancial.map(({ year }) => `${year}`),

            datasets: [
                {
                    label: 'Yearly Financial Total Cash balance',
                    data: yearlyFinancial.map(({ totalCashBalance }) => totalCashBalance),
                    backgroundColor: 'rgba(39,150,248,0.68)',
                    borderColor: 'rgba(23, 68, 88, 1)',
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Year',
                    },
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Cash Balance',

                    },
                },
            },
        },
    });
    }

    onMounted(() => {
    createYearlyChart();
    });
    const selectedChartType = ref('monthly');

</script>
