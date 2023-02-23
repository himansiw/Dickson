<html>
    <head>
        <title>Dicksons</title>
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        
      <?php
        include '../includes/bootstrap_includes_css.php';
        include '../model/module_model.php';
        include '../model/user_model.php';
        $userObj = new User();  ///  creating the user Object.
        $userResult=$userObj->getAllUsers();
        $moduleObj = new Module(); 
      ?>
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
            <div class="col-lg-12">
                <center> <h2 class="page-header"><b>View Users</b></h2></center>
            </div>
        </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">User</li>
                <li class="breadcrumb-item active">View Users</li>
            </ol>
        <!-- alert message-->
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
   
        <!--page body-->
            <div class="row">
                <div class="col-md-12">        
                <div class="page-body">
        <!--table-->
                <div class="table-responsive">         
                <table class="table table-bordered table-striped" id="example" role="grid" style="width: 1105px;">
                    <!--table heading-->
                <thead>
                    <tr role="row" style="background-color: #476c70;color:#dfe8e9;height:60px" >
                        <th style="width: 40px">&nbsp;</th>
                        <th rowspan="1" colspan="1" style="width:110px;">
                            First Name
                        </th>
                        <th rowspan="1" colspan="1" style="width: 80px;">
                            Last Name
                        </th>
                        <th rowspan="1" colspan="1" style="width: 130px;">
                            Role
                        </th>
                        <th rowspan="1" colspan="1" style="width: 100px;">
                           Email
                        </th>
                        <th rowspan="1" colspan="1" style="width: 90px;">
                           status
                        </th>
                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 370px;">
                            Action
                        </th>
                    </tr>
                </thead>
                
                   <!-- table body-->
                <tbody>
                <?php  
                    while($userRow=$userResult->fetch_assoc())
                    {
                    $userId=$userRow["user_id"];
                    $userId=  base64_encode($userId);
                ?>
                 <tr  user_id="">
                    <td><img src="../images/user_image/<?php echo $userRow["user_image"];  ?>" width="70" height="60" /></td>
                    <td><?php echo $userRow["user_fname"];?></td>
                    <td><?php echo $userRow["user_lname"];?></td>
                    <td><?php echo $userRow["role_name"];?></td>
                    <td><?php echo $userRow["user_email"];?></td>
                    <td>
                        <?php if($userRow["user_status"]=="1"){
                             echo "Active";
                                            
                            }
                            else{
                                echo "Deactive";
                                }
                        ?>
                    </td>
                    <td> 
                        <!--Active button-->
                        <?php
                            if($userRow["user_status"]==0)
                            {
                        ?>
<!--                        <a href="../controller/usercontroller.php?status=activateUser&user_id=--><?php // echo $userId;?><!--" class="btn btn-md btn-success">-->
<!--                            <span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Activate</b>-->
<!--                        </a>-->
                        <button class="btn btn-md btn-success" style="color: #ffffff" data-toggle="tooltip" title="Active the user" id="active" onclick="active(<?php  echo $userRow["user_id"]; ?>)">
                            <span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Activate</b>
                        </button>
                        &nbsp;
                        <?php  
                            }
                        ?>
                        
                        <!--Deactivate button-->
                        <?php  
                            if($userRow["user_status"]=="1")
                            {
                        ?>
<!--                        <a href="../controller/usercontroller.php?status=deactivateUser&user_id=--><?php //echo $userId;  ?><!--" class="btn btn-md btn-danger">-->
<!--                            <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Deactivate</b>-->
<!--                        </a>-->
                                <button class="btn btn-md btn-danger" style="color: #ffffff" data-toggle="tooltip"  title="Deactive the user" onclick="deactive(<?php  echo $userRow["user_id"]; ?>)">
                                    <span class="glyphicon glyphicon-remove"></span>&nbsp;<b>Deactivate</b>
                                </button>
                                &nbsp;
                        <?php 
                            }
                        ?>
                       
                        <!-- view user button-->
                        <a href="../view/display-user.php?user_id=<?php echo $userId;  ?>"  class="btn btn-md btn-info">
                            <span class="glyphicon glyphicon-eye-open"></span>&nbsp;<b>View</b>
                        </a>
                        &nbsp;
                        &nbsp;
                        <!--edit button-->
                        <a href="../view/edit-user.php?user_id=<?php echo $userId; ?>" class="btn btn-md btn-primary">
                            <span class="glyphicon glyphicon-edit"></span>&nbsp;<b>Edit</b></a>
                        &nbsp;
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
    include '../includes/bootstrap_script_includes.php';
    include '../includes/datatable_script_include.php';
    include_once 'footer.php';?>
    </body>
    <script type="text/javascript" src="../js/user_validation.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 1, 2,3,4, 5 ]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [ 1, 2,3,4, 5 ]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 1, 2,3,4, 5 ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 1, 2,3,4, 5 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 1, 2,3,4, 5 ]
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
    <script>
        function active(x) {
            var userId = x;
            swal({
                    title: "Active User?",
                    text: "Are you sure, You want to active user now!!!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "../controller/usercontroller.php?status=activateUser",
                                type: 'POST',
                                data: {userId:userId},
                                success: function (res) {

                                    console.log( res );//when the
                                    location.reload()
                                }

                            })
                        }
                    });
        }
        function deactive(x) {
            var userId = x;
            swal({
                        title: "Deactivate User?",
                        text: "Are you sure, You want to active user now!!!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    url: "../controller/usercontroller.php?status=deactivateUser",
                                    type: 'POST',
                                    data: {userId:userId},
                                    success: function (res) {

                                        console.log( res );//when the
                                        location.reload()
                                    }

                                })
                            }
                        });
        }
    </script>
</html>
