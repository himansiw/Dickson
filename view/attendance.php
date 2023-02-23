<html>
<head>
    <title>Dicksons</title>
    <?php
    include '../includes/bootstrap_includes_css.php';
    include '../model/attendance_model.php';
    $attendanceObj = new Attendance();
    $attendanceResult = $attendanceObj->getAllAttendance();

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
            <center> <h2 class="page-header"><b>Add Attendance</b></h2></center>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="dashboard.php">Employee</a></li>
        <li class="breadcrumb-item active"><a href="view-product.php">Add Attendance</a></li>
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

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 60px">
                        Employee Attendance List
<!--                        <a href="javascript:void(0);" class="btn btn-primary" onclick="exportTableToCSV('members.csv')" style="margin-left: 10px;"><i class="exp"></i> Export</a>-->
                        <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');" style="float: right"><i class="fa fa-plus"></i> Import</a>
                    </div>
                    <div class="panel-body">
                        <form action="../controller/attendancecontroller.php?status=add_attendance" method="post" enctype="multipart/form-data" id="importFrm" style="border-width: 2px;border-style: dashed;height: 80px">
                            <div class="row">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="row">
                            <div class="col-md-4">&nbsp;</div>
                            <div class="col-md-3"><input type="file" name="file"></div>
                            <div class="col-md-2"><input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT"></div>
                            <div class="col-md-3">&nbsp;</div>
                            </div>
                        </form>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Emp No</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>In time</th>
                                <th>Out time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($attendanceResult->num_rows > 0){
                            while($attRow=$attendanceResult->fetch_assoc())
                            {
                            $attendanceId=$attRow["att_id"];
                            $attendanceId=  base64_encode( $attendanceId);
                            ?>
                            <tr>
                                <td><?php echo $attRow["emp_no"];?></td>
                                <td><?php echo $attRow["emp_name"];?></td>
                                <td><?php echo $attRow["att_date"];?></td>
                                <td><?php echo $attRow["att_intime"];?></td>
                                <td><?php echo $attRow["att_outtime"];?></td>
                                <?php } }else{ ?>
                            <tr><td colspan="5">No employee(s) found.....</td></tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
include '../includes/bootstrap_script_includes.php';
include_once 'footer.php';
?>
    <script>
        function formToggle(ID){
            var element = document.getElementById(ID);
            if(element.style.display === "none"){
                element.style.display = "block";
            }else{
                element.style.display = "none";
            }
        }
    </script>
<script>
    $(function() {
        $("#msg").show();
        setTimeout(function () {$("#msg").slideUp(500, function () {$("#msg").hide();});}, 6000);
    });
</script>
<script>
    $(function() {
        $("#error").show();
        setTimeout(function () {$("#error").slideUp(500, function () {$("#error").hide();});}, 6000);
    });
</script>

</body>
</html>