<html>
<head>
    <title>Dicksons</title>
    <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
    <style>
        .modal .modal-body {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
    <?php
    include '../includes/bootstrap_includes_css.php';
    include '../model/customer_model.php';
    $customerObj = new Customer();
    $customerResult = $customerObj->getAllCustomer();
    $cardno = $customerObj->getCardNo();
    if (mysqli_num_rows($cardno) > 0) {
        if ($cardrow= mysqli_fetch_assoc($cardno)) {
            $lastid = $cardrow['card_no'];
            $lastid = substr($lastid, 3, 8);//separating numeric part
            $lastid = $lastid + 1;//Incrementing numeric part
            $lastid = "DFC" . sprintf('%04s', $lastid);//concatenating incremented value
            $cardNo = $lastid;
        }
    }
    else {
        $lastid = "DFC0001";
        $cardNo = $lastid;
    }
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
            <center> <h2 class="page-header"><b>View Customer</b></h2></center>
        </div>
        <div class="col-md-1">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-10">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">Customer & Loyalty</li>
                <li class="breadcrumb-item active">View Customer</li>
            </ol>
        </div>
        <div class="col-md-1">&nbsp;</div>
    </div>
    <!-- alert message-->
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <?php
        if (isset($_GET["msg"])) {
            ?>
            <div class="col-md-10">
                <div class="alert alert-success" id="msg">
                    <?php

                    $msg = $_REQUEST["msg"];
                    $msg = base64_decode($msg);
                    echo $msg;
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="col-md-10">
            <div id="alertDiv1"></div>
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
                <button type="button" class="btn btn-primary" style="float:right; width:120px; height:35px;" data-toggle="modal" data-target="#mycustomer">
                    <i class="fa fa-plus"></i>
                    <b>Add New</b>
                </button>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <!--table-->
                <div class="table-responsive center-block">
                    <table class="table table-bordered table-striped dataTable no-footer" id="example" role="grid" style="float:left;">
                        <!--table heading-->
                        <thead>
                        <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px">
                            <th style="width: 10px">&nbsp;</th>
                            <th  rowspan="1" colspan="1" style="width:80px;">
                                First name
                            </th>
                            <th   rowspan="1" colspan="1" style="width:100px;">
                                Last name
                            </th>
                            <th  rowspan="1" colspan="1" style="width:60px;">
                                Mobile No.
                            </th>
                            <th  rowspan="1" colspan="1" style="width:90px;">
                                Email
                            </th>
                            <th  rowspan="1" colspan="1" style="width:50px;">
                                Points
                            </th>
                            <th rowspan="1" colspan="1" style="width: 80px;">
                                Status
                            </th>
                            <th rowspan="1" colspan="1" style="width: 120px;">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <?php
                        while ($cusrow = $customerResult->fetch_assoc()) {
                            $customerId = $cusrow["cus_id"];
                            $customerId = base64_encode($customerId);
                            ?>
                            <tr>
                                <td><?php echo $cusrow["cus_id"]; ?></td>
                                <td><?php echo $cusrow["cus_fname"]; ?></td>
                                <td><?php echo $cusrow["cus_lname"]; ?></td>
                                <td><?php echo $cusrow["cus_mob"]; ?></td>
                                <td><?php echo $cusrow["cus_email"]; ?></td>
                                <td><?php echo $cusrow["loyalty_point"]; ?></td>
                                <td>
                                    <?php
                                    if ($cusrow["cus_status"] == "1") {
                                        echo "Activate";
                                    } else {
                                        echo "Deactivate";
                                    }
                                    ?>
                                </td>
                                <td>
                                    &nbsp;
                                    <!--Active button-->
                                    <?php
                                    if ($cusrow["cus_status"] == "0") {
                                        ?>
                                        <a href="../controller/customercontroller.php?status=activateCustomer&cus_id=<?php echo $customerId; ?>" class="btn btn-md btn-success">
                                            <span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Activate</b>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                    <!--Deactivate button-->
                                    <?php
                                    if ($cusrow["cus_status"] == "1") {
                                        ?>
                                        <a href="../controller/customercontroller.php?status=deactivateCustomer&cus_id=<?php echo $customerId; ?>" class="btn btn-md btn-danger">
                                            <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Deactivate</b>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                    &nbsp;
                                    <!--Edit button-->
                                    <button class="btn btn-md btn-primary" onclick="loadData(<?php echo $cusrow["cus_id"] ?>);" data-toggle="modal" data-target="#editCustomer" >
                                        <i class="fa fa-edit"></i> <b>Edit</b></button>
                                    &nbsp;
                                    <!--View button-->
                                    <button class="btn btn-md btn-info" onclick="loadView(<?php echo $cusrow["cus_id"] ?>);" data-toggle="modal" data-target="#viewCustomer" >
                                        <i class="fa fa-eye"></i> <b>View</b></button>
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

<!--Add Customer Modal -->
<div class="modal fade" id="mycustomer" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="addCustomers" action="../controller/customercontroller.php?status=add_customer" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"><b>Add Customer</b></h3><br>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php
                        if (isset($_GET["msg1"])) {
                            ?>
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <?php

                                    $msg1 = $_REQUEST["msg1"];
                                    $msg1 = base64_decode($msg1);
                                    echo $msg;
                                    ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="col-md-12">
                            <div  id="alertDiv"></div>
                        </div>
                    </div>
                    <!--personal details-->
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Personal Details -:</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <label class="control-label">Card No.</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="card_no" name="card_no" class="form-control" value="<?php echo $cardNo ?>" readonly="readonly" style="background-color: white"/>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">First Name:</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="cus_fname" name="cus_fname" placeholder="Customer first name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Last Name:</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="cus_lname" name="cus_lname" placeholder="Customer last name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Mobile No: </label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="cus_mob" name="cus_mob"  placeholder="Enter mobile number...." class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Email:</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="cus_email" name="cus_email" class="form-control" placeholder="Email" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">NIC:</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="cus_nic" name="cus_nic" class="form-control" placeholder="NIC" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <h4>Address Details -:</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label"> House No:</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="cus_house_no" name="cus_house_no" placeholder="Houseno." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label"> Street:</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="cus_street" name="cus_street" placeholder="Street" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label"> City:</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="cus_city" name="cus_city" placeholder="City" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary" value="save"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--Edit Customer-->
<div class="modal fade" id="editCustomer" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="edit_Customers" action="../controller/customercontroller.php?status=update_customer" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"><b>Edit Customer</b></h3><br>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php
                        if (isset($_GET["msg2"])) {
                            ?>
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <?php

                                    $msg1 = $_REQUEST["msg2"];
                                    $msg1 = base64_decode($msg2);
                                    echo $msg;
                                    ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="col-md-12">
                            <div  id="alertDiv2"></div>
                        </div>
                    </div>
                    <div id="customerCont">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary" value="save"><i class="fa fa-edit"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--View Customer modal-->
<div class="modal fade" id="viewCustomer" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="../controller/customercontroller.php?status=view_customer" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"><b>View Customer</b></h3><br>
                </div>
                <div class="modal-body">
                    <div id="viewcustomer">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include_once 'footer.php';
include '../includes/bootstrap_script_includes.php';
?>
</body>
<script src="../js/datatable/jquery-3.5.1.js"></script>
<script src="../js/datatable/jquery.dataTables.min.js"></script>
<script src="../js/datatable/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
        var url = window.location.href;//old url.
        var spliturl = url.split('?')[0];// Divide the old url on the question mark.
        var newSpliturl = spliturl.split('localhost')[1];//Divide the new url on the localhost mark
        window.history.pushState({},document.title,""+ newSpliturl);
    });
</script>
<script type="text/javascript" src="../js/customer.js"></script>
<script type="text/javascript" src="../js/edit_customer.js"></script>
<script>
    $(function() {
        $("#msg").show();
        setTimeout(function () {$("#msg").slideUp(500, function () {$("#msg").hide();});}, 8000);
    });

    function loadData(x)
    {
        var url = "../controller/customercontroller.php?status=edit_customer";
        $.post(url, {cus_id: x}, function (data) {
            $("#customerCont").html(data).show();
        });
    }

    function loadView(x)
    {
        var url = "../controller/customercontroller.php?status=view_customer";
        $.post(url, {cus_id: x}, function (data) {
            $("#viewcustomer").html(data).show();
        });
    }
</script>

</html>