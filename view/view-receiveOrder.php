<html>
<head>
    <title>Dicksons</title>
    <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
    <?php
    include '../includes/bootstrap_includes_css.php';
    include '../model/purchase_model.php';
    $purchaseObj = new Purchase();
    $purchaseResult = $purchaseObj->getAllReceive();
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
            <center> <h2 class="page-header"><b>View Receiving</b></h2></center>
        </div>
        <div class="col-md-1">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-10">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">Purchase</li>
                <li class="breadcrumb-item active">View Receiving</li>
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
                <!--table-->
                <div class="table-responsive center-block">
                    <table class="table table-bordered table-striped dataTable no-footer" id="example" role="grid" style="float:left;">
                        <!--table heading-->
                        <thead>
                        <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px">
                            <th>&nbsp;</th>
                            <th  rowspan="1" colspan="1">
                                Date
                            </th>
                            <th  rowspan="1" colspan="1">
                                Ref No.
                            </th>
                            <th   rowspan="1" colspan="1">
                                Supplier
                            </th>
                            <th   rowspan="1" colspan="1" >
                                Total
                            </th>
                            <th   rowspan="1" colspan="1" >
                                Pay Status
                            </th>
                            <th   rowspan="1" colspan="1" >
                                Pay Due
                            </th>
                            <th rowspan="1" colspan="1" >
                                Status
                            </th>
                            <th rowspan="1" colspan="1" >
                                Action
                            </th>
                        </tr>
                        </thead>
                        <?php
                        while ($recrow=$purchaseResult->fetch_assoc()) {
                            $id = $recrow["id"];
                            $id = base64_encode($id);
                            ?>
                            <tr>
                                <td><?php echo $recrow["id"]; ?></td>
                                <td><?php echo date("M d, Y", strtotime($recrow['stock_date'])) ?></td>
                                <td><?php echo $recrow["reference_no"]; ?></td>
                                <td><?php echo $recrow["business_name"]; ?></td>
                                <td>Rs.<?php echo $recrow["total"] ;?></td>
                                <td><?php  if($recrow["pay_status"]=="Due") {
                                        ?>
                                        <center><a href="../view/payment.php?id=<?php echo $id;?>" class="btn btn-sm btn-warning"><b>Due</b></a></center>
                                        <?php
                                    }else{
                                        ?>
                                        <center><a href="../view/payment.php?id=<?php echo $id;?>" class="btn btn-sm btn-success"><b>Paid</b></a></center>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td><b>purchase:</b> Rs.<?php echo $recrow["rdue"] ;?></td>
                                <td>
                                    <?php
                                    if ($recrow["rstatus"] == "1") {
                                        echo "Activate";
                                    } else {
                                        echo "Deactivate";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <!--Active button-->
                                    <?php
                                    if($recrow["rstatus"]==0)
                                    {
                                        ?>
                                        <a href="../controller/purchasecontroller.php?status=activateRecieve&id=<?php  echo $id;?>" class="btn btn-sm btn-success">
                                            <span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Activate</b>
                                        </a>
                                        &nbsp;
                                        <?php
                                    }
                                    ?>

                                    <!--Deactivate button-->
                                    <?php
                                    if($recrow["rstatus"]=="1")
                                    {
                                        ?>
                                        <a href="../controller/purchasecontroller.php?status=deactivateRecieve&id=<?php echo $id;  ?>" class="btn btn-sm btn-danger">
                                            <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Deactivate</b>
                                        </a>
                                        &nbsp;
                                        <?php
                                    }
                                    ?>
                                    <!-- view button-->
                                    <a href="../view/view-receiving.php?id=<?php echo $id;  ?>"  class="btn btn-sm btn-info">
                                        <span class="glyphicon glyphicon-eye-open"></span>&nbsp;<b>View</b>
                                    </a>
                                    &nbsp;
                                </td>

                                &nbsp;
                            </tr>
                            <?php
                        }
                        ?>

                       <!-- tfoot start-->
                        <tr>
                        <!--get total purchase price-->
                        <td colspan="1" rowspan="2" style="border-right: none;"></td>
                        <td colspan="1" rowspan="2" style="border-right: none;"></td>
                        <td colspan="1" rowspan="2" style="border-right: none;"><center><b>Total:</b></center></td>
                        <td colspan="1" rowspan="2"></td>
                        <td rowspan="2">
                            Rs.
                            <?php
                            echo $purchaseObj->getTotal();
                            ?>
                        </td>
                        <td rowspan="2">
                            <!--get total count of paid-->
                            Paid:
                            <?php
                            echo $purchaseObj->getPaypstatus();
                            ?>
                            <br>
                            <!--get total count of due-->
                            Due:
                            <?php
                            echo $purchaseObj->getPaydstatus();
                            ?>
                        </td>
                        <!--get total due payments-->
                        <td rowspan="2">Due: Rs.
                            <?php
                            echo $purchaseObj->getDueSum();
                            ?></td>
                        <td rowspan="2"></td>
                        <td rowspan="2"></td>
                        </tr>
                         <!--tfoot finish-->
                    </table>
                </div>
            </div>
        </div>
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
                        columns: [ 0,1, 2,3,4, 5 ]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [ 0,1, 2,3,4, 5 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2,3,4, 5 ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0,1, 2,3,4, 5 ]
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


