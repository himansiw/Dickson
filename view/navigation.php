<!--Side_navbar-->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-1">&nbsp;</div><div class="col-md-6"> <img src="../images/logo/logo.png" alt="" width="95" height="90"/> </div><div class="col-md-5">&nbsp;</div>
            </div>
        </div>

        <ul class="nav" id="side-menu">
            <?php
            $navArray = $_SESSION['user']['nav'];
            $userRole = $_SESSION['user']['role_id'];
            ?>

            <?php foreach ($navArray as $nav) { ?>
                <?php if (in_array($userRole, $nav['role'])) { ?>
                    <li>
                        <a href="<?php echo $nav['url']; ?>"><i class="fa <?php echo $nav['icon']; ?>"></i> <?php echo $nav['title']; ?><?php (!empty($nav['submenu']) ? print '<i class="fa arrow"></i>' : print '') ?></a>

                        <?php if (!empty($nav['submenu'])) { ?>
                            <ul class="nav nav-second-level">
                                <?php foreach ($nav['submenu'] as $subnav) { ?>
                                    <?php if (in_array($userRole, $subnav['role'])) { ?>
                                        <li>
                                            <a href="<?php echo $subnav['url']; ?>"><i class="fa <?php echo $subnav['icon']; ?>"></i> <?php echo $subnav['title']; ?></a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
            <?php } ?>

        </ul>
    </div>
</div>


