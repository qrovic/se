<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');
?>
<body>
    <style>
    .dataTables_filter {
        display: none;
    }
    </style>
    <?php
        $currentpage='sales';
        require_once('../include/sidebarstore.php');
    ?>
    <div class="right">
        <div class="salessuper">
            <p class="salestxt">Sales</p>
        </div>
        
        <div class="superadminsalescanvas">
            <div class="itemperiod">
                <label for="dateFilter">Interval:</label>
                <select id="dateFilter" onchange="updateChart()" class="form-select">
                    <option value="yearly">Yearly</option>
                    <option value="monthly">Monthly</option>
                    <option value="daily">Daily</option>
                </select>
            </div>
            <canvas id="salesChart" width="300" height="100"></canvas>
            <p class="chart-label">Day</p>
        </div>
        
    </div>
    
    <script>
        var ctx = document.getElementById("salesChart").getContext("2d");
        var salesChart = new Chart(ctx, {
            type: "line", 
            data: {
                labels: [],
                datasets: [
                    {
                        label: "Total Sales",
                        backgroundColor: "#007F41",
                        borderColor: "#007F41",
                        borderWidth: 1,
                        data: [],
                        yAxisID: 'sales-y-axis'
                    }
                ],
            },
            options: {
                scales: {
                    yAxes: [
                        {
                            id: 'sales-y-axis',
                            type: 'linear',
                            position: 'left',
                            ticks: {
                                beginAtZero: true,
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Sales'
                            }
                        }
                    ]
                },
                legend: {
                    position: 'right'
                },
            },
        });

        function updateChart() {
            var dateFilter = document.getElementById("dateFilter").value;
            var salesData = [];

            switch (dateFilter) {
                case "daily":
                    $(".chart-label").text('Day');
                    salesData = <?php echo json_encode($storesalesdaily); ?>;
                    break;
                case "monthly":
                    $(".chart-label").text('Month');
                    salesData = <?php echo json_encode($storesalesmonthly); ?>;
                    break;
                case "yearly":
                    $(".chart-label").text('Year');
                salesData = <?php echo json_encode($storesalesyearly); ?>;
                break;
                
            }

            salesChart.data.labels = salesData.map(function(item) {
                return item.day; 
            });

            salesChart.data.datasets[0].data = salesData.map(function(item) {
                return item.total_sales;
            });

            salesChart.update();
        }

        
        updateChart();

    </script>
</body>
</html>
