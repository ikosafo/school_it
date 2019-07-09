<div id="sidebar" class="sidebar responsive">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>



    <ul class="nav nav-list">


        <li class="<?php echo ($_SERVER['PHP_SELF'] == "/new_student.php" ||
                               $_SERVER['PHP_SELF'] == "/view_student.php"
            ? "active" : "");?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text"> STUDENTS </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/new_student.php"
                    ? "active" : "");?>">
                    <a href="../new_student.php">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Add Student
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/view_student.php"
                    ? "active" : "");?>">
                    <a href="../view_student.php">
                        <i class="menu-icon fa fa-caret-right"></i>
                        View Students
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="<?php echo ($_SERVER['PHP_SELF'] == "/assessment_input.php" ||
        $_SERVER['PHP_SELF'] == "/terminal_report_ind.php" ||
        $_SERVER['PHP_SELF'] == "/general_bill.php" ||
        $_SERVER['PHP_SELF'] == "/terminal_report_class.php"
            ? "active" : "");?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-calculator"></i>
							<span class="menu-text">
								ASSESSMENT
							</span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">

                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/assessment_input.php"
                    ? "active" : "");?>">
                    <a href="../assessment_input.php">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Marks Input
                    </a>

                    <b class="arrow"></b>
                </li>


                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/general_bill.php"
                    ? "active" : "");?>">
                    <a href="../general_bill.php">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Gen. Conduct & Bill
                    </a>

                    <b class="arrow"></b>
                </li>



                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/terminal_report_ind.php" ||
                $_SERVER['PHP_SELF'] == "/terminal_report_class.php"
                    ? "active" : "");?>">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-caret-right"></i>

                        Terminal Report
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">


                        <li class="<?php echo ($_SERVER['PHP_SELF'] == "/terminal_report_ind.php"
                            ? "active" : "");?>">
                            <a href="../terminal_report_ind.php">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Individual
                            </a>

                            <b class="arrow"></b>
                        </li>


                        <li class="<?php echo ($_SERVER['PHP_SELF'] == "/terminal_report_class.php"
                            ? "active" : "");?>">
                            <a href="../terminal_report_class.php">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Class
                            </a>

                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>

            </ul>
        </li>


        <li class="<?php echo ($_SERVER['PHP_SELF'] == "/order_merit.php"
            ? "active" : "");?>">
            <a href="../order_merit.php">
                <i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text">
								ORDER OF MERIT
							</span>

            </a>

        </li>



        <li class="<?php echo ($_SERVER['PHP_SELF'] == "/archive_report_ind.php" ||
        $_SERVER['PHP_SELF'] == "/archive_report_class.php" ||
        $_SERVER['PHP_SELF'] == "/archive_order_merit.php"
            ? "active" : "");?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-archive"></i>
							<span class="menu-text">
								ARCHIVES
							</span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">


                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/archive_report_ind.php" ||
                $_SERVER['PHP_SELF'] == "/archive_report_class.php"
                    ? "active" : "");?>">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-caret-right"></i>

                        Terminal Report
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <ul class="submenu">



                        <li class="<?php echo ($_SERVER['PHP_SELF'] == "/archive_report_ind.php"
                            ? "active" : "");?>">
                            <a href="../archive_report_ind.php">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Individual
                            </a>

                            <b class="arrow"></b>
                        </li>


                        <li class="<?php echo ($_SERVER['PHP_SELF'] == "/archive_report_class.php"
                            ? "active" : "");?>">
                            <a href="../archive_report_class.php">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Class
                            </a>

                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>


                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/archive_order_merit.php"
                    ? "active" : "");?>">
                    <a href="../archive_order_merit.php">
                        Order of Merit
                    </a>
                </li>

            </ul>
        </li>


        <hr/>



        <li class="<?php echo ($_SERVER['PHP_SELF'] == "/contact.php"
            ? "active" : "");?>">
            <a href="../contact.php">
                <i class="menu-icon fa fa-phone-square"></i>
							<span class="menu-text">
								CONTACT US
							</span>

            </a>

        </li>





    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>

    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>