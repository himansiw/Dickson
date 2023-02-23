<html>
<head>
    <title>Dicksons</title>
    <?php
    include '../includes/bootstrap_includes_css.php';
    include '../model/user_model.php';

    // Create user object
    $userObj = new User();
    $roleResult = $userObj->getUserRoles();
    include '../model/module_model.php';

    //Create module object.
    $moduleObj = new Module();
    $moduleResult = $moduleObj->getAllModules();
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
            <center><h2 class="page-header"><b>Add User</b></h2></center>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active">User</li>
        <li class="breadcrumb-item active">Add User</li>
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

    <!--form-->
    <form id="addUser" enctype="multipart/form-data" method="post"
          action="../controller/usercontroller.php?status=add_user">

        <!--form_row-1-->
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">First Name</label>
            </div>
            <div class="col-md-3">
                <input type="text" name="fname" class="form-control" autocomplete="off" id="fname"/>
            </div>

            <div class="col-md-3">
                <label class="control-label">Last Name</label>
            </div>
            <div class="col-md-3">
                <input type="text" name="lname" class="form-control" autocomplete="off" id="lname"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>

        <!--form_row-2-->
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">User Email</label>
            </div>
            <div class="col-md-3">
                <input type="text" name="user_email" class="form-control" autocomplete="off" id="user_email"/>
            </div>

            <div class="col-md-3">
                <label class="control-label">User Gender</label>
            </div>
            <div class="col-md-3">
                <input type="radio" name="gender" value="0" checked="checked"/>&nbsp;<label
                        class="control-label">Male</label>
                &nbsp;
                <input type="radio" name="gender" value="1"/>&nbsp;<label class="control-label">FeMale</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <!--form_row-3-->
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">USER DOB</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input type="date" name="dob" class="form-control" id="dob"/>
                    <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                </div>
            </div>

            <div class="col-md-3">
                <label class="control-label">USER NIC</label>
            </div>
            <div class="col-md-3">
                <input type="text" name="nic" autocomplete="off" class="form-control" id="nic"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <!--form_row-4-->
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Contact Number 1 (Land)</label>
            </div>
            <div class="col-md-3">
                <input type="text" name="cno1" autocomplete="off" class="form-control" id="ucno1"/>
            </div>

            <div class="col-md-3">
                <label class="control-label">Contact Number 2 (Mobile)</label>
            </div>
            <div class="col-md-3">
                <input type="text" name="cno2" autocomplete="off" class="form-control" id="ucno2"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <!--form_row-5-->
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">User Role</label>
            </div>
            <div class="col-md-3">
                <select name="user_role" class="form-control" id="user_role">
                    <option value="">---</option>
                    <?php
                    while ($role_row = $roleResult->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $role_row["role_id"]; ?>">
                            <?php echo $role_row["role_name"]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-3">
                <label class="control-label">User Image</label>
            </div>
            <div class="col-md-3">
                <input type="file" name="user_img" id="user_img" onchange="readURL(this)" class="form-control"/>
                <br/>
                <img id="prev_img"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="container" id="myfunctions">
        </div>

        <div class="row">
            <div class="col-md-5">
                &nbsp;
            </div>
            <!--button-->
            <div class="col-md-5">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i>&nbsp; Save
                </button>
                <button type="reset" class="btn btn-danger">
                    <i class="fa fa-refresh"></i>&nbsp; Reset
                </button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
</div>
<?php
include '../includes/bootstrap_script_includes.php';
include_once 'footer.php';
?>
</body>
<script type="text/javascript" src="../js/user_validation.js"></script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $( '#prev_img' )
                    .attr( 'src', e.target.result )
                    .height( 70 )
                    .width( 80 );
            };
            reader.readAsDataURL( input.files[0] );
        }
    }
</script>
<script>
    $( document ).ready( function () {
        var url = window.location.href;//old url.
        var spliturl = url.split( '?' )[0];// Divide the old url on the question mark.
        var newSpliturl = spliturl.split( 'localhost' )[1];//Divide the new url on the localhost mark
        window.history.pushState( {}, document.title, "" + newSpliturl );
    } );
</script>
<script>
    $( function () {
        $( "#msg" ).show();
        setTimeout( function () {
            $( "#msg" ).slideUp( 500, function () {
                $( "#msg" ).hide();
            } );
        }, 8000 );
    } );
</script>
<script>
    $( function () {
        $( "#error" ).show();
        setTimeout( function () {
            $( "#error" ).slideUp( 500, function () {
                $( "#error" ).hide();
            } );
        }, 8000 );
    } );
</script>
</html>
