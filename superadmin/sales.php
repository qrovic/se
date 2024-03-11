
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
            <div class="saleshead">
                <div class="itemperiod">
                    <label for="dateFilter">Interval:</label>
                    <select id="dateFilter" onchange="updateChart()" class="form-select">
                        <option value="yearly">Yearly</option>
                        <option value="monthly">Monthly</option>
                        <option value="daily">Daily</option>
                    </select>
                </div>
                <div class="pdfsave">
                    <button class="btn btn-primary printpdf" style="background-color: white; color: black; border-color: gray;" onclick="saveAllChartsToPDF()"><i class='bx bxs-file-pdf'></i> Save as PDF</button>
                    <button class="btn btn-primary printpdf" style="background-color: white; color: black; border-color: gray;" onclick="printAllChartsToPDF()"><i class='bx bxs-printer'></i> Print</button>
                </div>
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
        function saveChartToPDF(interval, chartData) {
            var doc = new jspdf.jsPDF();
            doc.addImage(chartData, 'PNG', 10, 10, 180, 90);
            doc.save(`chart_${interval}.pdf`);
        }

        function mimicIntervalSelection(interval) {
            return new Promise((resolve) => {
                document.getElementById("dateFilter").value = interval;
                updateChart();
                setTimeout(() => {
                    resolve();
                }, 500);
            });
        }

        function saveChartToPDF(chartData, filename) {
            var doc = new jspdf.jsPDF();
            doc.addImage(chartData, 'PNG', 10, 10, 180, 90);
            doc.save(filename);
        }

        async function saveAllChartsToPDF() {
            var intervals = ["yearly", "monthly", "daily"];
            var chartData = {};

            for (let interval of intervals) {
                await mimicIntervalSelection(interval);
                chartData[interval] = salesChart.toBase64Image();
            }

            var doc = new jspdf.jsPDF({
                orientation: 'landscape',
                unit: 'mm',
                format: [330.2, 215.9] 
            });

            var yPosition = 30;
            var chartHeight = 130;
            var spacing = 15; 
            var pageHeight = doc.internal.pageSize.height;

            for (let interval of intervals) {
                doc.addPage(); 
                let text = interval.charAt(0).toUpperCase() + interval.slice(1) + ' Sales';
                let textWidth = doc.getStringUnitWidth(text) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                let xPosition = (doc.internal.pageSize.width - textWidth) / 2;

                doc.setFont('helvetica', 'bold'); 
                doc.setFontSize(16); 
                doc.setTextColor(0, 127, 79);
                doc.text(xPosition, yPosition - 5, text);
                doc.setFont('helvetica', 'normal'); 
                doc.addImage(chartData[interval], 'PNG', 10, yPosition, 310, chartHeight);
            }
            doc.save('charts.pdf');


        }

        async function printAllChartsToPDF() {
            var intervals = ["yearly", "monthly", "daily"];
            var chartData = {};

            for (let interval of intervals) {
                await mimicIntervalSelection(interval);
                chartData[interval] = salesChart.toBase64Image();
            }

            var doc = new jspdf.jsPDF({
                orientation: 'landscape',
                unit: 'mm',
                format: [330.2, 215.9] 
            });

            var yPosition = 30;
            var chartHeight = 130;
            var spacing = 15; 
            var pageHeight = doc.internal.pageSize.height;

            for (let interval of intervals) {
                doc.addPage(); 
                let text = interval.charAt(0).toUpperCase() + interval.slice(1) + ' Sales';
                let textWidth = doc.getStringUnitWidth(text) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                let xPosition = (doc.internal.pageSize.width - textWidth) / 2;

                doc.setFont('helvetica', 'bold'); 
                doc.setFontSize(16); 
                doc.setTextColor(0, 127, 79);
                doc.text(xPosition, yPosition - 5, text);
                doc.setFont('helvetica', 'normal'); 
                doc.addImage(chartData[interval], 'PNG', 10, yPosition, 310, chartHeight);
            }

            doc.autoPrint();
            window.open(doc.output('bloburl'), '_blank');
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