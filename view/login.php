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
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            <h5>
                                <?php
                                echo $msg;
                                ?>
                            </h5>
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
                    <form method="post" action="../controller/logincontroller.php?status=login" id="loginform">
                        <div class="panel panel-default" style="height:370px">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md- col-sm-10 col-xs-10">
                                        <h4><b>Login</b></h4>
                                        <p>Enter your username and Password</p>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <h1 class="h1"><i class="fa fa-sign-in" ></i></h1>
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
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Username" name="username" id="username" required="required"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <i class="fa fa-key" ></i>
                                <label>Password</label>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="password" class="form-control" name="password" placeholder="Password" id="password" required="required"/>
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
                            <div class="panel-footer">
                                <div class="row">
                                 <div class="col-md-12 col-xs-12 col-sm-12">
                                     <a href="account_recovery.php">Forgot your password ?</a> <br/>Click here to reset.
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                        </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">&nbsp;</div>
            </div>
        </div>
    </body>
    <?php
    include '../includes/bootstrap_script_includes.php';
    ?>
    <script src="../js/login_validation.js"></script>
</html>
