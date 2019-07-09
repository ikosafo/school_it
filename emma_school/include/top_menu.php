<?php

session_start();

$username = $_SESSION['username'];
$user_type = $_SESSION['user_type'];
?>


    <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse">
        <ul class="nav nav-list">
            <li class="<?php echo ($_SERVER['PHP_SELF'] == "/index_ad.php"
                ? "active" : "");?> hover">
                <a href="../index_ad.php">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>

                <b class="arrow"></b>
            </li>

            <li class="<?php echo ($_SERVER['PHP_SELF'] == "/institution_details.php" ||
            $_SERVER['PHP_SELF'] == "/academic_session.php" ||
            $_SERVER['PHP_SELF'] == "/departments.php" ||
            $_SERVER['PHP_SELF'] == "/class.php" ||
            $_SERVER['PHP_SELF'] == "/course.php" ||
            $_SERVER['PHP_SELF'] == "/tuition_fees.php" ||
            $_SERVER['PHP_SELF'] == "/assessment_config.php" ||
            $_SERVER['PHP_SELF'] == "/grading.php" ||
            $_SERVER['PHP_SELF'] == "/course.php"
                ? "active" : "");?> hover">
                <a class="dropdown-toggle" href="#">
                    <i class="menu-icon fa fa-gears"></i>
                    <span class="menu-text"> Configuration </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php echo ($_SERVER['PHP_SELF'] == "/institution_details.php"
                        ? "active" : "");?> hover">
                        <a href="../institution_details.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Institution Details
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php echo ($_SERVER['PHP_SELF'] == "/academic_session.php"
                        ? "active" : "");?> hover">
                        <a href="../academic_session.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Academic Session
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php echo ($_SERVER['PHP_SELF'] == "/tuition_fees.php"
                        ? "active" : "");?> hover">
                        <a href="../tuition_fees.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Fees and Attendance
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php echo ($_SERVER['PHP_SELF'] == "/departments.php"
                        ? "active" : "");?> hover">
                        <a href="../departments.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Department
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php echo ($_SERVER['PHP_SELF'] == "/class.php"
                        ? "active" : "");?> hover">
                        <a href="../class.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Class
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php echo ($_SERVER['PHP_SELF'] == "/program.php"
                        ? "active" : "");?> hover">
                        <a href="../program.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Program
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php echo ($_SERVER['PHP_SELF'] == "/course.php"
                        ? "active" : "");?> hover">
                        <a href="../course.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Course
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="hover">
                        <a href="#">
                            <i class="menu-icon fa fa-caret-rightt"></i>
                            <span class="menu-text"> Academics </span>

                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="<?php echo ($_SERVER['PHP_SELF'] == "/assessment_config.php"
                                ? "active" : "");?> hover">
                                <a href="../assessment_config.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Assessment Config.
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="<?php echo ($_SERVER['PHP_SELF'] == "/grading.php"
                                ? "active" : "");?> hover">
                                <a href="../grading.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Grading
                                </a>

                                <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>


                </ul>
            </li>


          <?php  if ($username == "admin" || $user_type == 'Admin'){ ?>



            <li class="<?php echo ($_SERVER['PHP_SELF'] == "/users.php" ||
            $_SERVER['PHP_SELF'] == "/change_password.php"
                ? "active" : "");?> hover">

                <a class="dropdown-toggle" href="#">
                    <i class="menu-icon fa fa-users"></i>
                    <span class="menu-text"> User Accounts </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php echo ($_SERVER['PHP_SELF'] == "/users.php"
                        ? "active" : "");?> hover">
                        <a href="../users.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Users
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php echo ($_SERVER['PHP_SELF'] == "/change_password.php"
                        ? "active" : "");?> hover">
                        <a href="../change_password.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Change Password
                        </a>

                        <b class="arrow"></b>
                    </li>

                </ul>

            </li>


        </ul><!-- /.nav-list -->
    </div><!-- .sidebar -->


<?php }

else {
    echo "";
}

