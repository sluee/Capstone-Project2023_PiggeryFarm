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



</script>

<template>
    <Head title="Sales Chart" />

    <SideBarLayout>

        <div class="py-12">
            <div class="">
                <div class="flex justify-center mb-2">
                    <div><img src="/images/logo.png" alt="Logo" class="w-[70px] h-[70px] rounded-full object-cover"></div>
                    <div class=" text-sm">
                        <h3 class="font-bold text-slate-700">RQR Piggery Farm || Saint Agustin Piggery Farm</h3>
                        <h3 class="font-bold text-slate-700 text-center">San Agustin, Sagbayan, Bohol</h3>
                        <h3 class="font-bold text-slate-700 text-center">Canmaya Centro, Sagbayan, Bohol</h3><br>
                        <h3 class="font-bold text-slate-700 text-center">Sales Chart</h3>
                    </div>

                </div>
            </div>
            <div class="w-full px-5 py-4 ">
                <canvas id="monthlySalesChart" width="200" height="80"/>
            </div>
        </div>
        <div class="bg-white p-6 rounded shadow flex justify-center text-justify">

            <p>In a review of our recent sales performance, it is important to note that we experienced a decline in sales this month compared to the previous month. While last month's sales figures stood at an impressive {{ lastMonthTotalSales }}, this month's numbers show a decrease to {{ thisMonthTotalSales  }}. This dip in sales is a clear signal that we need to evaluate our sales strategies and market conditions to identify factors contributing to this decline. It is crucial to address these challenges proactively and make data-driven decisions to ensure we get back on track and maintain our growth trajectory.</p>
        </div>

    </SideBarLayout>
</template>
