<html>
<head>
    <title>Dicksons</title>
    <style>
        .tit{
            background-color: #0f0f0f;
            color: #ffffff;
        }

    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <?php
    include '../includes/bootstrap_includes_css.php';
    include '../model/purchase_model.php';
    $purchaseObj = new Purchase();
//    include '../model/report_model.php';
//    $reportObj = new Report();
//    $id = $_REQUEST["purchase_id"];
//    $id = base64_decode($id);
//    //Get the specific purchase order information.
//    $purchaseResult =$reportObj->getAllPurchase($id);
    ?>


</head>
<body>
<div class="container">
    <!--header_1-->
    <?php
    include_once 'header.php';
    ?>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <!--page header-->
    <div class="row">
        <div class="col-lg-12">
            <center> <h2 class="page-header"><b>View Report</b></h2></center>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="dashboard.php">Report Management</a></li>
        <li class="breadcrumb-item active"><a href="view-product.php">P</a></li>
    </ol>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>

    <!-- alert message-->
    <div class="row">
        <?php
        if (isset($_REQUEST["msg"]) || (isset($_REQUEST["error"]))) {
            ?>
            <div class="col-md-12">
                <?php
                if (isset($_REQUEST["msg"])) {
                    ?>
                    <div class="alert alert-success">
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
        <div class="col-md-12">
            <div id="alertDiv"></div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="page-body">



                <div class="row">
                    <div class="col-md-8">
                        Use the grid below to get reports for items
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                        <form>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="startDate" name="from" placeholder="Start Date" readonly style="background-color: white"/>
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-2">&nbsp;</div>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" id="endDate" placeholder="End Date" name="end" readonly style="background-color: white"/>
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">&nbsp;</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" id="showSaleReport" class="btn">Show Report</button>
                                    <button type="reset" id="saleFilterClear" class="btn">Clear</button>
                                </div>
                                <div class="col-md-6">&nbsp;</div>
                            </div>
                        </form>
                        <br><br>






                <!--  table-->
                <div class="table-responsive center-block">
                    <table class="table table-bordered table-striped" id="example" role="grid"  style="float:left;">
                    <!-- table heading-->
                        <thead>
                        <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px">
                            <th  rowspan="1" colspan="1">
                                Date
                            </th>
                            <th  rowspan="1" colspan="1">
                                Ref No.
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
                        </tr>
                        </thead>
                        <tbody id="show">
                        <?php
                        $pResult = $purchaseObj->getAllPurchaseDetails();
                        while ($purRow=$pResult->fetch_assoc()) {
                            $id = $purRow["purchase_id"];
                            $id = base64_encode($id);
                            ?>
                        <tr>
                            <td><?php echo $purRow["purchaseref_no"]; ?></td>
                            <td><?php echo date("M d, Y", strtotime($purRow["purchase_date"])) ?></td>
                            <td><?php echo $purRow["pusup_id"]; ?></td>
                            <td><?php echo $purRow["supplier_email"] ;?></td>
                            <td>
                                <?php
                                if ($purRow["purchase_status"] == "1") {
                                    echo "Pending order";
                                } else {
                                    echo "Received order";
                                }
                                ?>
                            </td>
                        </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
    </div>

            </div>
        </div>
</div>



<?php
include_once 'footer.php';
include '../includes/bootstrap_script_includes.php';
include '../includes/datatable_script_include.php'
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
    $(function(){
        $.datepicker.setDefaults({
                    dateFormat: 'yy-mm-dd'
                });
        $( "#startDate" ).datepicker({
            //defaultDate: "+1w",
            onSelect: function( selectedDate ) {
                $( "#endDate" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#endDate" ).datepicker({
            //defaultDate: "+1w",
            onSelect: function( selectedDate ) {
                $( "#startDate" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
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
<script>
    $("#showSaleReport").click(function () {
        var start=$('#startDate').val();
        var end =$('#endDate').val();
        console.log('f')
        console.log(start)
        console.log(end)
          $.ajax({
              url: "../controller/reportcontroller.php?status=filter_date",
              method: 'POST',
              dataType: 'text',
              data:{start:start,end:end},
              success: function (res){
                  console.log(res);
                  $('#show').html(res).show();
              },
          })
    });
</script>

</html>
