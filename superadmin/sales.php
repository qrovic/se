
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
        require_once('../include/sidebar.php');
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
        </div>
        
    </div>
    
    <script>
        var superadminsales = <?php echo json_encode($superadminsales); ?>;
        var storeNames = superadminsales.map(function(item) {
            return item.storename;
        });
        var salesData = superadminsales.map(function(item) {
            return item.total_sales;
        });
        var quantityData = superadminsales.map(function(item) {
            return item.total_quantity;
        });

        var ctx = document.getElementById("salesChart").getContext("2d");
        var salesChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: storeNames,
                datasets: [
                    {
                        label: "Total Sales",
                        backgroundColor: "#007F41", 
                        borderColor: "#007F41",
                        borderWidth: 1,
                        data: salesData,
                        yAxisID: 'sales-y-axis'
                    },
                    {
                        label: "Total Quantity",
                        backgroundColor: "#FF914D",
                        borderColor: "#FF914D",
                        borderWidth: 1,
                        data: quantityData,
                        yAxisID: 'quantity-y-axis'
                    },
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
                        },
                        {
                            id: 'quantity-y-axis',
                            type: 'linear',
                            position: 'right',
                            ticks: {
                                beginAtZero: true,
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Quantity'
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
            var superadminsales = [];

            switch (dateFilter) {
                case "yearly":
                    superadminsales = <?php echo json_encode($superadminsalesyearly); ?>;
                    break;
                case "monthly":
                    superadminsales = <?php echo json_encode($superadminsalesmonthly); ?>;
                    break;
                case "daily":
                    superadminsales = <?php echo json_encode($superadminsalesdaily); ?>;
                    break;
            }

            var storeNames = superadminsales.map(function(item) {
                return item.storename;
            });

            var salesData = superadminsales.map(function(item) {
                return item.total_sales;
            });

            var quantityData = superadminsales.map(function(item) {
                return item.total_quantity;
            });

            salesChart.data.labels = storeNames;
            salesChart.data.datasets[0].data = salesData;
            salesChart.data.datasets[1].data = quantityData;
            salesChart.update();
        }

    </script>
    <script>
    $(document).ready(function() {
       

        var dataTable = $('#dataTable').DataTable({
           
            lengthChange: false,
            pageLength: 5, 
            paging: false,
            language: {
            info: ''
        }
        });

        $('#category').on('change', function() {
            var category = $('#category').val();


            dataTable.columns(2).search(category).draw();
        });

        $('#store').on('change', function() {
           
            var store = $('#store').val();

            dataTable.columns(3).search(store).draw();
        });
    });
</script>


    

</body>
</html>