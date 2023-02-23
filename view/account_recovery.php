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
            if (isset($_GET["msg"])) {
                $msg = base64_decode($_GET["msg"]);
                ?>
                <div class="row">
                    <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="alert alert-danger">
                            <h6>
                                <?php
                                echo $msg;
                                ?>
                            </h6>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
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
            <div class="row">
                <div class="col-md-4">&nbsp;</div>
                <div class="col-md-4">
                    <form method="post" action="../controller/logincontroller.php?status=verify_account" id="loginform">
                        <div class="panel panel-default" style="height:280px">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md- col-sm-10 col-xs-10">
                                        <h4><b>Forgot Password</b></h4>
                                        <p>Please type username to send verification code</p>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <h1 class="h1"><i class="fa fa-envelope-square" ></i></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <i class="fa fa-user-circle-o" ></i>
                                <label>Username</label>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Username" name="username" id="username" required="required"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="form-action">
                                    <a class="btn btn-success pull-left login_link" href="login.php">
                                        <i class="fa fa-chevron-left"></i> Back</a>
                                    <button type="submit" class="btn btn-primary pull-right">
                                        Submit &nbsp;&nbsp; <i class="fa fa-envelope"></i>
                                    </button>
                                </div>
                            </div> 
                </div>
                    </form>
                <div class="col-md-4">&nbsp;</div>
            </div>
        </div>
        </div>
    </body>
    <?php
    include '../includes/bootstrap_script_includes.php';
    ?>
    <script src="../js/login_validation.js"></script>
</html>
