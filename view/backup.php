<html>
<head>
    <title>Dicksons</title>
    <style>
        .tit{
            background-color: #0f0f0f;
            color: #ffffff;
        }
    </style>
    <?php
    include '../includes/bootstrap_includes_css.php';
    include '../model/backup_model.php';
    $backupObj = new backup();
    $backupResult=$backupObj->getAllBackupDetails();
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
            <center> <h2 class="page-header"><b>View Backup</b></h2></center>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="dashboard.php">Backup</a></li>
        <li class="breadcrumb-item active">View Backup</li>
    </ol>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>

    <!--  alert message-->
    <div class="row">
        <?php
        if (isset($_REQUEST["msg"]) || (isset($_REQUEST["error"]))) {
            ?>
            <div class="col-md-12">
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
        <div class="col-md-12">
            <div id="alertDiv"></div>
        </div>
    </div>
    <!--alert finish-->


    <div class="row">
        <div class="col-md-12"> &nbsp;
            <div class="page-body">

                <a href="../controller/backupcontroller.php?status=makeBackup" class="btn" style="float:right; width:150px; height:35px; background-color:#61ABEB; color:#ffffff">
                    <i class="fa fa-hdd-o"></i> <b>  Make Backup</b>
                </a>

                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <!--table-->
                <div class="table-responsive center-block">
                    <table class="table table-bordered table-striped" id="example" role="grid"  style="float:left;">
                        <!--table heading-->
                        <thead>
                        <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:50px">
                            <th style="width:10px">&nbsp;</th>
                            <th   rowspan="1" colspan="1">
                                Date
                            </th>
                            <th  rowspan="1" colspan="1">
                                Time
                            </th>
                            <th  rowspan="1" colspan="1">
                                Backup name
                            </th>
                            <th rowspan="1" colspan="1">
                                Reference
                            </th>
                            <th  rowspan="1" colspan="1">
                                Status
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($bRow=$backupResult->fetch_assoc()) {
                        $id = $bRow["backup_id"];
                        $id = base64_encode($id);
                        ?>
                        <tr style="font-size: 14px">
                            <td><?php echo $bRow["backup_id"]; ?></td>
                            <td><?php echo date("Y, m, d", strtotime($bRow["backup_date"])) ?></td>
                            <td><?php echo ($bRow["backup_time"]) ?></td>
                            <td><?php echo $bRow["backup_name"] ;?></td>
                            <td><a><?php echo $bRow["reference"] ;?></a></td>
                            <td>
                                <?php
                                if ($bRow["backup_status"] == "1") {
                                    echo "Success";
                                } else {
                                    echo "Not Success";
                                }
                                ?>
                            </td>
                            &nbsp;
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
include '../includes/bootstrap_script_includes.php';
include '../includes/datatable_script_include.php';
include_once 'footer.php';?>
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
                        columns: [ 0,1, 2,3,4,5]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [ 0,1, 2,3,4,5]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2,3,4,5]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0,1, 2,3,4,5]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0,1, 2,3,4,5 ]
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

    $(function() {
        $("#error").show();
        setTimeout(function () {$("#error").slideUp(500, function () {$("#error").hide();});}, 8000);
    });
</script>
</html>
