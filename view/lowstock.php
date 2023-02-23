<html>
<head>
    <title>Dicksons</title>
    <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
    <?php
    include '../includes/bootstrap_includes_css.php';
    include '../model/stock_model.php';
    $stockObj= new Stock();
    $stockResult=$stockObj->getAllLowStock();
    ?>
</head>
<body>
<?php
include_once'header.php';
?>
<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-lg-10">
            <center> <h2 class="page-header"><b>Low stock Products</b></h2></center>
        </div>
        <div class="col-md-1">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-10">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">Inventory & Stock</li>
                <li class="breadcrumb-item active">Low stock Products</li>
            </ol>
        </div>
        <div class="col-md-1">&nbsp;</div>
    </div>
    <!-- alert message-->
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <?php
        if (isset($_REQUEST["msg"]) || (isset($_REQUEST["error"]))) {
            ?>
            <div class="col-md-10">
                <?php
                if (isset($_REQUEST["msg"])) {
                    ?>
                    <div class="alert alert-success" id="msg">
                        <?php echo base64_decode($_REQUEST["msg"]); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo base64_decode($_REQUEST["error"]); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
        <div class="col-md-10">
            <div id="alertDiv"></div>
        </div>
        <div class="col-md-1">&nbsp;</div>
    </div>

    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-1"> &nbsp;</div>
        <div class="col-md-10">
            <div class="page-body">
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <!--table-->
                <div class="table-responsive center-block">
                    <table class="table table-bordered table-striped" id="example" role="grid"  style="float:left;">
                        <!--table heading-->
                        <thead>
                        <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px">
                            <th>&nbsp;</th>
                            <th  rowspan="1" colspan="1">
                                Date Encoded
                            </th>
                            <th   rowspan="1" colspan="1">
                                Product Name
                            </th>
                            <th  rowspan="1" colspan="1">
                                SKU
                            </th>
                            <th  rowspan="1" colspan="1">
                               Current qty
                            </th>
                            <th  rowspan="1" colspan="1">
                                 Minimum Qty
                            </th>
                            <th rowspan="1" colspan="1">
                                Status
                            </th>
                        </tr>
                        </thead>
                        <?php
                        while ($lsrow = $stockResult->fetch_assoc()) {
                            $lowId = $lsrow["low_id"];
                            $lowId = base64_encode($lowId);
                            ?>
                            <tr>
                                <td><?php echo $lsrow["low_id"]; ?></td>
                                <td><?php echo date("M d, Y",strtotime($lsrow['date_created'])) ?></td>
                                <td><?php echo $lsrow["product_name"]; ?></td>
                                <td><?php echo $lsrow["pcode"]; ?></td>
                                <td><?php echo $lsrow["lqty"]; ?></td>
                                <td><?php echo $lsrow["mqty"]; ?></td>
                                <td>
                                    <?php
                                    if ($lsrow["l_status"] == "1") {
                                        echo "Confirmed";
                                    } else {
                                        echo "Not Confirmed";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>

            </div>
        </div>
        <div class="col-md-1"> &nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
</div>

<?php
include_once 'footer.php';
include '../includes/bootstrap_script_includes.php';
include '../includes/datatable_script_include.php';
?>
</body>
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            order :[],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [1, 2,3,4,5,6]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [1, 2,3,4,5,6]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2,3,4,5,6]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [1, 2,3,4,5,6]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [1, 2,3,4, 5,6]
                    }
                },
                'colvis'
            ],
            dom:
                "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu:[
                [5,10,25,50,100,-1],
                [5,10,25,50,100,"All"]
            ]
        } );
        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-5:eq(0)' );
        var url = window.location.href;//old url.
        var spliturl = url.split('?')[0];// Divide the old url on the question mark.
        var newSpliturl = spliturl.split('localhost')[1];//Divide the new url on the localhost mark
        window.history.pushState({},document.title,""+ newSpliturl);
    } );
</script>
<script>
    $(function() {
        $("#msg").show();
        setTimeout(function () {$("#msg").slideUp(500, function () {$("#msg").hide();});}, 8000);
    });
</script>
<script>
    $(function() {
        $("#error").show();
        setTimeout(function () {$("#error").slideUp(500, function () {$("#error").hide();});}, 8000);
    });
</script>
</html>
