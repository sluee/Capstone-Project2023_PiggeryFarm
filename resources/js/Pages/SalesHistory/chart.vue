<script setup>
// import {Head, useForm } from "@inertiajs/vue3";
import {Head, Link, useForm} from '@inertiajs/vue3'
import SideBarLayout from "@/Layouts/SideBarLayout.vue";
import moment from 'moment'
import { ref, watch, computed, onMounted } from 'vue';
import Chart from 'chart.js/auto';


    const props = defineProps({

        monthlySales:Array
        // totalPigs: Number, // Assuming you have a totalPigs prop
        // totalWeight: Number,
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
        if (!props.monthlySales) {
            return;
        }

        const ctx = document.getElementById('monthlySalesChart').getContext('2d');
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
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
            },
            ],
        },
        });

    }

    onMounted(() => {
        createChart();
    });

    
</script>

<template>
    <Head title="Sales Chart" />

    <SideBarLayout>
        <template #header >
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sales Chart</h2>

            </div>
        </template>
        <div class="py-12">
            <div class="w-full px-5 py-4 ">
                <canvas id="monthlySalesChart"/>
            </div>
        </div>
        <div class="bg-white p-6 rounded shadow flex justify-center text-justify">

            <p>In a review of our recent sales performance, it is important to note that we experienced a decline in sales this month compared to the previous month. While last month's sales figures stood at an impressive {{ lastMonthTotalSales }}, this month's numbers show a decrease to {{ thisMonthTotalSales  }}. This dip in sales is a clear signal that we need to evaluate our sales strategies and market conditions to identify factors contributing to this decline. It is crucial to address these challenges proactively and make data-driven decisions to ensure we get back on track and maintain our growth trajectory.</p>
        </div>

    </SideBarLayout>
</template>
