<html>
    <head>
        <title>Dicksons</title>
        <?php
        include '../includes/bootstrap_includes_css.php';
        ?>

    </head>
    <body >
        <div class="container-fluid" style="background-color:#cccccc;height:100%">
            <div class="row">
                <div class="col-md-4">&nbsp;</div>
                <div class="col-md-4">
                    <h1 align="center" style="color:#1d2124"><b>Dicksons Food City</b></h1>
                    <h4 style="color: #1d2124;" align="center"><b>We appreciate your trust ...!</b></h4>
                </div>
                <div class="col-md-4">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <?php
            if(isset($_GET["msg"]))
            {
                $msg=  base64_decode($_GET["msg"]);
            ?>
          
            <div class="row">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">
                    <div class="alert alert-danger">
                        <h6><?php
                        echo $msg;
                        ?>
                        </h6>
                    </div>
                </div>
                <div class="col-md-3">&nbsp;</div>
            </div>
            <?php
            }
            ?>
            <div class="row">
                     <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">
                        <div id="alertmsg">

                         </div>
                </div>
                       <div class="col-md-3">&nbsp;</div>
            </div>  
            <?php
            if((isset($_GET["status"]))&&($_GET["status"]=="recovery"))
            {
                $encoded=  base64_decode($_GET["code"]);
                $decoded_array= explode(("="), $encoded);
                $user_id=$decoded_array[1];
                ?>
                 
             <div class="row">
                <div class="col-md-4">&nbsp;</div>
                <div class="col-md-4">
                     <form method="post" action="../controller/logincontroller.php?status=change_password" id="loginform">
                        <input type="hidden" name="user_id" value="<?php echo $user_id;?>"/>
                        <div class="panel panel-default" style="height:370px">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md- col-sm-10 col-xs-10">
                                        <h4><b>Recovery</b></h4>
                                        <p>Enter your New Password</p>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <h1 class="h1"><i class="fa fa-lock" ></i></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <i class="fa fa-key" ></i>
                                <label>New Password</label>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                     <input type="password" class="form-control" name="n_password" placeholder="New password" id="n_password" required="required"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <i class="fa fa-key" ></i>
                                <label>Confirm Password</label>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                  <input type="password" class="form-control" name="c_password" placeholder="Confirm password" id="c_pass" required="required"/>   
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-xs-4 col-sm-4">&nbsp;</div>
                                    <div class="col-md-4 col-xs-4 col-sm-4">
                                        <button type="submit" name="login" class="btn btn-success btn-labeled pull-right">
                                            Sign-In &nbsp;
                                            <span class="btn-label btn-label-right">
                                                <i class="fa fa-check-square"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-4 col-xs-4 col-sm-4">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">&nbsp;</div>
            </div>
            <?php
            }
            ?>
        </div>
        
        
    </body>
   <?php
 include '../includes/bootstrap_script_includes.php';
   
   ?>
    <script src="../js/login_validation.js"></script>
</html>
