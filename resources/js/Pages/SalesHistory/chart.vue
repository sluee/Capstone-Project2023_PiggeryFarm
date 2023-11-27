<script setup>
// import {Head, useForm } from "@inertiajs/vue3";
import {Head, Link, useForm} from '@inertiajs/vue3'
import SideBarLayout from "@/Layouts/SideBarLayout.vue";
import moment from 'moment'
import { ref, watch, computed, onMounted } from 'vue';
import Chart from 'chart.js/auto';


    const props = defineProps({

        monthlySales:Array,
        yearlySales:Array,
        currentYear:Number
    });

    function formattedDate(date){
        return moment(date).format('MMMM   D, YYYY');
    }

    const monthlySalesChart = ref(null);

        // Watch for changes in the monthlySales prop
        watch(() => props.monthlySales, () => {
            if (monthlySalesChart.value) {
                monthlySalesChart.value.destroy(); // Destroy the existing chart if it exists
            }

            // Create and update the chart when the data changes
            createChart();
        });

        function createChart() {
            if (!props.monthlySales || props.monthlySales.length === 0) {
            // You can handle this case by displaying a message or taking any other action
            return;
        }
        const ctx = document.getElementById('monthlySalesChart').getContext('2d');

        // const ctx = document.getElementById('monthlySalesChart').getContext('2d');
        const { monthlySales } = props;

        // Array of month names
        const monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        monthlySalesChart.value = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthlySales.map(({ month, year }) => `${monthNames[month - 1]}-${year}`),
                datasets: [
                    {
                        label: 'Monthly Total Sales',
                        data: monthlySales.map(({ total_sales }) => total_sales),
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
                            text: 'Month and Year',
                        },
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Sales',

                        },
                    },
                },
            },
        });
    }

    onMounted(() => {
        createChart();
    });


    const yearlySalesChart = ref(null);

    // Watch for changes in the monthlySales prop
    watch(() => props.yearlySales, () => {
        if (yearlySalesChart.value) {
            yearlySalesChart.value.destroy(); // Destroy the existing chart if it exists
        }

        // Create and update the chart when the data changes
        createYearlyChart();
    });

    function createYearlyChart() {
        if (!props.yearlySales || props.yearlySales.length === 0) {
        // You can handle this case by displaying a message or taking any other action
        return;
    }
    const ctx = document.getElementById('yearlySalesChart').getContext('2d');

    // const ctx = document.getElementById('yearlySalesChart').getContext('2d');
    const { yearlySales } = props;



    yearlySalesChart.value = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: yearlySales.map(({ year }) => `${year}`),

            datasets: [
                {
                    label: 'Yearly Total Sales',
                    data: yearlySales.map(({ total_sales }) => total_sales),
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
                        text: 'Sales',

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

<template>
    <Head title="Sales Chart" />

    <SideBarLayout>
        <!-- <template #header >
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sales Chart</h2>

            </div>
        </template> -->
        <div class="py-5">
            <div class=" flex justify-end items-center">
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
                <div v-if="monthlySales && monthlySales.length > 0">

                    <h3 class="font-bold text-slate-700 text-center">Sales Chart for {{ currentYear }}</h3>
                    <div class="w-full px-5 py-4">

                        <canvas id="monthlySalesChart" width="200" height="80"></canvas>
                    </div>
                </div>
                <div class=" bg-white p-6 rounded shadow flex justify-center text-justify" v-else>
                    <p class="text-center text-lg font-bold text-gray-900 py-6">Sales Chart information is unavailable for now</p>
                </div>
            </div>
            <div v-show="selectedChartType === 'yearly'">
                <div v-if="yearlySales && yearlySales.length > 0">
                    <h3 class="font-bold text-slate-700 text-center"> Yearly Sales Chart</h3>
                    <div class="w-full px-5 py-4">
                        <!-- Include the canvas directly in the component -->
                        <canvas id="yearlySalesChart" width="200" height="80"></canvas>
                    </div>
                </div>
                <div class="bg-white p-6 rounded shadow flex justify-center text-justify" v-else>
                    <p class="text-center text-lg font-bold text-gray-900 py-6">Sales Chart information for the entire year is unavailable for now</p>
                    </div>
                
            </div>
        </div>
    </SideBarLayout>
</template>
