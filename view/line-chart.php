<html>
<head>
    <title>Dicksons</title>
    <?php
    include '../includes/css_includes_dashboard.php';

    ?>
    <script type="text/javascript" src="../js/googlecharts.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Sales'],
                ['2018',  100000],
                ['2019',  180000],
                ['2020',  160000]
            ]);

            var options = {
                title: 'Sales analysis of previous years',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>
</head>
<body>
<?php
include_once'header.php';
?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id="curve_chart" style="width: 900px; height: 500px"></div>
        </div>
</body>
<?php
include_once'footer.php';
include '../includes/script_includes_dashboard.php';
?>
</html>