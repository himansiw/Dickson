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
                    <div class="alert alert-success">
                        <h4><?php
                        echo $msg;
                        ?>
                        </h4>
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
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">
                    <form method="post" action="../controller/logincontroller.php?status=login" id="loginform">
                                <div class="row">
                                    <div class="col-md-1">&nbsp;</div>
                                    <div class="col-md-10">
                                    <div class=" alert alert-success">
                                        <h3>&nbsp;&nbsp;&nbsp;&nbsp;An Email has been sent successfully !!! </h3>
                                    </div>
                                    </div>
                                    <div class="col-md-1">&nbsp;</div>
                                </div>
                    </form>
                </div>
                <div class="col-md-3">&nbsp;</div>
            </div>
        </div>
        
        
    </body>
   <?php
 include '../includes/bootstrap_script_includes.php';
   
   ?>
    <script src="../js/login_validation.js"></script>
</html>
