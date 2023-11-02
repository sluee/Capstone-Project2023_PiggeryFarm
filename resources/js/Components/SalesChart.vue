
  <template>
    <div>
      <canvas id="monthlySalesChart"></canvas>
    </div>
  </template>

  <script>
  import { ref, onMounted } from 'vue';
  import Chart from 'chart.js/auto';


      const monthlySales = ref([]);
      let monthlySalesChart = null;

      onMounted(() => {
        // Retrieve and format monthly sales data here
        // ...

        const ctx = document.getElementById('monthlySalesChart').getContext('2d');
        monthlySalesChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: monthlySales.value.map(item => `${item.month}-${item.year}`),
            datasets: [
              {
                label: 'Total Sales',
                data: monthlySales.value.map(item => item.total_sales),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
              },
            ],
          },
        });
      });

      // Fetch and format the monthly sales data here




  </script>

