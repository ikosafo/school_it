<?php include('../dbcon.php');

$date = date("Y-m-d");

$sess = $mysqli->query("select * from `academic_session` where date_from <= '$date' AND date_to >= '$date'");
$res_ses = $sess->fetch_assoc();
$academic_year = $res_ses['year'];
$term = $res_ses['term'];
$term_begins = $res_ses['term_begins'];

?>
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="alert alert-block alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>

            <i class="ace-icon fa fa-check green"></i>

            Welcome to
            <strong class="green">

                <small> TESHIE ST. JOHN SCHOOLS - School Management System</small>

            </strong>

        </div>

        <div class="row">
            <div class="space-6"></div>

            <div class="col-sm-7 infobox-container">
                <div class="infobox infobox-green">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-male"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                            <?php $get = $mysqli->query("select * from student where gender = 'Male' and status is null");
                            echo $count_male = mysqli_num_rows($get);?>
                        </span>
                        <div class="infobox-content">Males</div>
                    </div>


                </div>

                <div class="infobox infobox-blue">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-female"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                            <?php $get = $mysqli->query("select * from student where gender = 'Female' and status is null");
                            echo $count_male = mysqli_num_rows($get);?>
                        </span>
                        <div class="infobox-content">Females</div>
                    </div>

                </div>

                <div class="infobox infobox-pink">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-bank"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                             <?php $get = $mysqli->query("select * from department");
                             echo $count_dept = mysqli_num_rows($get);?>
                        </span>
                        <div class="infobox-content">Departments</div>
                    </div>
                </div>

                <div class="infobox infobox-red">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-building-o"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                             <?php $get = $mysqli->query("select * from class");
                             echo $count_class = mysqli_num_rows($get);?>
                        </span>
                        <div class="infobox-content">Classes</div>
                    </div>
                </div>

                <div class="infobox infobox-orange2">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-pencil-square-o"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                             <?php $get = $mysqli->query("select distinct(course) from course_class");
                             echo $count_course = mysqli_num_rows($get);?>
                        </span>
                        <div class="infobox-content">Courses</div>
                    </div>

                </div>

                <div class="infobox infobox-blue2">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-book"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                             <?php
                             echo $academic_year?>
                        </span>
                        <div class="infobox-content"><?php echo $term; ?></div>
                    </div>
                </div>

                <div class="space-6"></div>

            </div>

            <div class="vspace-12-sm"></div>

            <div class="col-sm-5">
                <div class="widget-box">
                    <div class="widget-header widget-header-flat widget-header-small">
                        <h5 class="widget-title">
                            <i class="ace-icon fa fa-link"></i>
                            Quick Links
                        </h5>

                        <div class="widget-toolbar no-border">
                            <div class="inline dropdown-hover">
                                <button class="btn btn-minier btn-primary">
                                    Click Here
                                    <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                    <li class="active">
                                        <a href="../new_student.php" class="blue">
                                            <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                            Add Students
                                        </a>
                                    </li>

                                    <li>
                                        <a href="../view_student.php">
                                            <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                            View Students
                                        </a>
                                    </li>

                                    <li>
                                        <a href="../assessment_input.php">
                                            <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                            Marks Input
                                        </a>
                                    </li>

                                    <li>
                                        <a href="../general_bill.php">
                                            <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                            General Conduct and Billing
                                        </a>
                                    </li>

                                    <li>
                                        <a href="../terminal_report_ind.php">
                                            <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                            Terminal Report (Individual)
                                        </a>
                                    </li>

                                    <li>
                                        <a href="../terminal_report_class.php">
                                            <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                            Terminal Report (Class)
                                        </a>
                                    </li>

                                    <li>
                                        <a href="../order_merit.php">
                                            <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                            Order of Merit
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                </div><!-- /.widget-box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="hr hr32 hr-dotted"></div>


        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->