<html>
<head>
    <title>Dicksons</title>
    <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
    <?php
    include '../includes/bootstrap_includes_css.php';
    include '../model/purchase_model.php';
    $purchaseObj = new Purchase();

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
            <center> <h2 class="page-header"><b>View Purchase Orders</b></h2></center>
        </div>
        <div class="col-md-1">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-10">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">Purchase</li>
                <li class="breadcrumb-item active">View Purchase Orders</li>
            </ol>
        </div>
        <div class="col-md-1">&nbsp;</div>
    </div>
    <!--  alert message-->
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
                    <div class="alert alert-danger" id="error">
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
    <!--alert finish-->
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-10">
            <div class="page-body">
                <a href="purchase-order.php" class="btn btn-primary" style="float:right; width:150px; height:35px;">
                    <i class="fa fa-plus"></i>
                    <b>New Order</b>
                </a>

                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>

                <!--table-->
                <div class="table-responsive center-block">
                    <table class="table table-bordered table-striped dataTable no-footer" id="example" role="grid" style="float:left;">
                        <!--table heading-->
                        <thead>
                        <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px">
                            <th  rowspan="1" colspan="1">
                                Ref No.
                            </th>
                            <th  rowspan="1" colspan="1">
                                Date
                            </th>
                            <th   rowspan="1" colspan="1">
                                Supplier
                            </th>
                            <th   rowspan="1" colspan="1">
                                Supplier email
                            </th>
                            <th rowspan="1" colspan="1" >
                                Purchase order status
                            </th>
                            <th rowspan="1" colspan="1" >
                                Action
                            </th>
                        </tr>
                        </thead>
                        <?php
                        $pResult = $purchaseObj->getAllPurchaseDetails();
                        while ($purrow=$pResult->fetch_assoc()) {
                            $id = $purrow["purchase_id"];
                            $id = base64_encode($id);
                            ?>
                            <tr>
                                <td><?php echo $purrow["purchaseref_no"]; ?></td>
                                <td><?php echo date("M d, Y", strtotime($purrow["purchase_date"])) ?></td>
                                <td><?php echo $purrow["pusup_id"]; ?></td>
                                <td><?php echo $purrow["supplier_email"] ;?></td>
                                <td>
                                    <?php
                                    if ($purrow["purchase_status"] == "1") {
                                        echo "Pending order";
                                    } else {
                                        echo "Received order";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <!--Active button-->
                                    <?php
                                    if($purrow["purchase_status"]==0)
                                    {
                                        ?>
                                        <button  class="btn btn-sm btn-success" onclick="loadData(<?php echo $purrow["purchase_id"] ?>);" data-toggle="modal" data-target="#myrecieve">
                                            <i class="fa fa-check"></i>&nbsp;<b>Received</b>
                                        </button>
                                        &nbsp;
                                        <?php
                                    }
                                    ?>

                                    <!--Deactivate button-->
                                    <?php
                                    if($purrow["purchase_status"]=="1")
                                    {
                                        ?>
                                        <a href="../controller/purchasecontroller.php?status=deactivatePurchase&purchase_id=<?php echo $id;  ?>" class="btn btn-sm btn-warning">
                                            <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Pending</b>
                                        </a>
                                        &nbsp;
                                        &nbsp;
                                        <?php
                                    }
                                    ?>
                                    <!-- view button-->
                                    <a href="../view/view-purchase.php?purchase_id=<?php echo $id;  ?>"  class="btn btn-sm btn-info">
                                        <span class="glyphicon glyphicon-eye-open"></span>&nbsp;<b>View</b>
                                    </a>
                                    &nbsp;
                                    &nbsp;
<!--                                     cancel button-->
                                    <a href="../controller/purchasecontroller.php?status=cancelPurchase&purchase_id=<?php echo $id;  ?>"  class="btn btn-sm btn-danger">
                                        <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Cancel Order</b>
                                    </a>
                                    &nbsp;
                                </td>

                                &nbsp;
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
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

<!-- Modal -->
<div class="modal fade" id="myrecieve" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
        <form action="#" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"><b>Recieved Order</b></h3><br>
                </div>
                <div class="modal-body">
                    <!--personal details-->
                    <div id="purchaseCont"></div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-primary" value="save"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
        </form>
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
                        columns: [ 0,1, 2,3,4]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [ 0,1, 2,3,4 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2,3,4 ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0,1, 2,3,4]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0,1, 2,3,4, 5 ]
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
<script>
    function loadData(x)
    {
        var url = "../controller/purchasecontroller.php?status=view_status";
        $.post(url, {purchase_id: x}, function (data) {
            $("#purchaseCont").html(data).show();
        });
    }

</script>

</html>

