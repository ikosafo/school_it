<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="School Management System, IT">
    <meta name="keywords" content="school,management,system,software,IT,billing,assessment,configuration">
    <meta name="author" content="xPanther Solutions">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>ikoLink School Management System</title>

    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Start CSS -->
    <!-- Chartist Chart CSS -->
    <link rel="stylesheet" href="assets/plugins/chartist-js/chartist.min.css">

    <!-- Datepicker CSS -->
    <link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

    <!-- Responsive Datatable CSS -->
    <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

    <!-- Jquery Confirm CSS -->
    <link href="assets/plugins/jquery-confirm/css/jquery-confirm.css" rel="stylesheet" type="text/css">

    <!-- Select2 CSS -->
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css">

    <!-- Tagsinput CSS -->
    <link href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="assets/css/countrySelect.css" rel="stylesheet" type="text/css">
    <link href="assets/uploadify/uploadifive.css" rel="stylesheet" type="text/css">
    <link href="assets/css/selectize.css" rel="stylesheet" type="text/css">
    <!-- End CSS -->

    <style>
        ::placeholder {
            font-weight: lighter !important;
            font-size: small !important;
            color: #bfbfbf !important;
        }

        .form-control {
            background-color: #fbfafa !important;
        }

        label {
            font-size: small !important;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            background-color: #fbfafa !important;
        }

        .select2-container--default .select2-search--inline .select2-search__field {
            background-color: #fbfafa !important;
        }




    </style>

</head>

<body class="xp-horizontal">

<!-- Start XP Container -->
<div id="xp-container">

    <!-- Start XP Rightbar -->
    <div class="xp-rightbar">

        <!-- XP Search Modal -->
        <div class="modal fade xpSearchModal" id="xpSearchModal" tabindex="-1" role="dialog"
             aria-labelledby="xpSearchModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="xp-searchbar">
                            <form>
                                <div class="input-group">
                                    <input type="search" class="form-control" placeholder="Search" aria-label="Search"
                                           aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit" id="button-addon2">GO</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start XP Headerbar -->
        <div class="xp-headerbar">

            <!-- Start XP Topbar -->
            <div class="xp-topbar">

                <!-- Start XP Row -->
                <div class="row">

                    <!-- Start XP Col -->
                    <div class="col-2 col-md-2 col-lg-2 align-self-center">
                        <!-- Start XP Logobar -->
                        <div class="xp-logobar">
                            <a href="index.html" class="xp-small-logo"><img src="assets/images/mobile-logo.svg"
                                                                            class="img-fluid" alt="logo"></a>
                            <a href="index.html" class="xp-main-logo"><img src="assets/images/logo.svg"
                                                                           class="img-fluid" alt="logo"></a>
                        </div>
                        <!-- End XP Logobar -->
                    </div>
                    <!-- End XP Col -->

                    <!-- Start XP Col -->
                    <div class="col-10 col-md-10 col-lg-10">
                        <div class="xp-profilebar text-right">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="xp-search">
                                        <a href="#" class="text-white" data-toggle="modal" data-target="#xpSearchModal"><i
                                                    class="icon-magnifier"></i></a>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="dropdown xp-message">
                                        <a class="dropdown-toggle  text-white" href="#" role="button" id="xp-message"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-speech font-18 v-a-m"></i>
                                            <span class="badge badge-pill bg-success-gradient xp-badge-up">8</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="xp-message">
                                            <ul class="list-unstyled">
                                                <li class="media">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-0 py-3 text-white text-center font-16">8 New
                                                            Messages</h5>
                                                    </div>
                                                </li>
                                                <li class="media xp-msg">
                                                    <img class="mr-3 align-self-center rounded-circle"
                                                         src="assets/images/topbar/user-message-1.jpg"
                                                         alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h5 class="mt-0 mb-1 font-14">Ariel Blue<span
                                                                        class="font-12 f-w-4 float-right">3 min ago</span>
                                                            </h5>
                                                            <p class="mb-0 font-13">Thank you for attending...<span
                                                                        class="badge badge-pill badge-success float-right">2</span>
                                                            </p>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li class="media xp-msg">
                                                    <img class="mr-3 align-self-center rounded-circle"
                                                         src="assets/images/topbar/user-message-2.jpg"
                                                         alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h5 class="mt-0 mb-1 font-14">Jammy Moon<span
                                                                        class="font-12 f-w-4 float-right">5 min ago</span>
                                                            </h5>
                                                            <p class="mb-0 font-13">Hey no worries! Trust me...<span
                                                                        class="badge badge-pill badge-success float-right">3</span>
                                                            </p>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li class="media xp-msg">
                                                    <img class="mr-3 align-self-center rounded-circle"
                                                         src="assets/images/topbar/user-message-3.jpg"
                                                         alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h5 class="mt-0 mb-1 font-14">Lisa Ross<span
                                                                        class="font-12 f-w-4 float-right">5:25 PM</span>
                                                            </h5>
                                                            <p class="mb-0 font-13">Remedies for colic? i don't...<span
                                                                        class="badge badge-pill badge-success float-right">5</span>
                                                            </p>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-0 py-3 text-black text-center font-14">
                                                            <a href="#" class="text-primary">View all</a>
                                                        </h5>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="dropdown xp-notification">
                                        <a class="dropdown-toggle  text-white" href="#" role="button"
                                           id="xp-notification" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            <i class="icon-bell font-18 v-a-m"></i>
                                            <span class="badge badge-pill bg-danger-gradient xp-badge-up">3</span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right"
                                             aria-labelledby="xp-notification">
                                            <ul class="list-unstyled">
                                                <li class="media">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-0 py-3 text-white text-center font-16">3 New
                                                            Notifications</h5>
                                                    </div>
                                                </li>
                                                <li class="media xp-noti">
                                                    <div class="mr-3 xp-noti-icon primary-rgba"><i
                                                                class="icon-user-follow text-primary"></i></div>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h5 class="mt-0 mb-1 font-14">New user registered</h5>
                                                            <p class="mb-0 font-12 f-w-4">2 min ago</p>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li class="media xp-noti">
                                                    <div class="mr-3 xp-noti-icon success-rgba"><i
                                                                class="icon-basket-loaded text-success"></i></div>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h5 class="mt-0 mb-1 font-14">New order placed</h5>
                                                            <p class="mb-0 font-12 f-w-4">8:45 PM</p>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li class="media xp-noti">
                                                    <div class="mr-3 xp-noti-icon danger-rgba"><i
                                                                class="icon-like text-danger"></i></div>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h5 class="mt-0 mb-1 font-14">John like your photo.</h5>
                                                            <p class="mb-0 font-12 f-w-4">Yesterday</p>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-0 py-3 text-black text-center font-14">
                                                            <a href="#" class="text-primary">View all</a>
                                                        </h5>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <div class="dropdown xp-userprofile">
                                        <a class="dropdown-toggle " href="#" role="button" id="xp-userprofile"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                                    src="assets/images/topbar/user.jpg" alt="user-profile"
                                                    class="rounded-circle img-fluid"><span class="xp-user-live"></span></a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="xp-userprofile">
                                            <a class="dropdown-item py-3 text-white text-center font-16" href="#">Welcome,
                                                John Doe</a>
                                            <a class="dropdown-item" href="#"><i
                                                        class="icon-user text-primary mr-2"></i> Profile</a>
                                            <a class="dropdown-item" href="#"><i
                                                        class="icon-wallet text-success mr-2"></i> Billing</a>
                                            <a class="dropdown-item" href="#"><i
                                                        class="icon-settings text-warning mr-2"></i> Setting</a>
                                            <a class="dropdown-item" href="#"><i class="icon-lock text-info mr-2"></i>
                                                Lock Screen</a>
                                            <a class="dropdown-item" href="#"><i
                                                        class="icon-power text-danger mr-2"></i> Logout</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item xp-horizontal-menu-toggle">
                                    <button type="button" class="navbar-toggle bg-transparent" data-toggle="collapse"
                                            data-target="#navbar-menu">
                                        <i class="icon-menu font-20 text-white"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End XP Col -->

                </div>
                <!-- End XP Row -->

            </div>
            <!-- End XP Topbar -->

            <!-- Start XP Menubar -->
            <div class="xp-menubar text-left">

                <!-- Start XP Nav -->
                <nav class="xp-horizontal-nav xp-mobile-navbar xp-fixed-navbar">

                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="xp-horizontal-menu">

                            <li class="scroll"><a href="index.php"><i
                                            class="icon-speedometer"></i>
                                    <span>Dashboard</span></a>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                            class="dripicons-gear"></i><span>System Configuration</span></a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Institution</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="config_institution.php">Details</a></li>
                                            <li><a href="config_department.php">Department</a></li>
                                            <li><a href="config_class.php">Class</a></li>
                                            <li><a href="config_courses.php">Courses/Programs</a></li>
                                            <li><a href="config_clubs.php">Clubs</a></li>
                                            <li><a href="config_sections.php">Sections</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Academic</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="config_academic_session.php">Academic Session</a></li>
                                            <li><a href="config_fees_attendance.php">Fees and Attendance</a></li>
                                            <li><a href="config_assessment.php">Assessment</a></li>
                                            <li><a href="config_grading.php">Grading</a></li>
                                        </ul>
                                    </li>

                                </ul>

                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                            class="icon-user-female"></i><span>Student Management</span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="student_add.php">Add Student</a></li>
                                    <li><a href="student_view.php">View Student Details</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                            class="dripicons-user-group"></i><span>Staff Management</span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="staff_add.php">Add Staff</a></li>
                                    <li><a href="staff_view.php">View Staff Details</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                            class="icon-calculator"></i><span>Continuous Assessment</span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="assessment_marks.php">Marks Input</a></li>
                                    <li><a href="assessment_conduct.php">General Conduct & Billing</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Terminal Report</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="terminal_report_ind.php">Individual</a></li>
                                            <li><a href="terminal_report_class.php">Class</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="assessment_merit.php">Order of Merit</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                            class="icon-calculator"></i><span>School Accounts and Bills</span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="accounts_fees.php">Fees Payment</a></li>
                                    <li><a href="accounts_report.php">Report and Statistics</a></li>
                                    <li><a href="accounts_payroll.php">Staff Payroll</a></li>
                                    <li><a href="accounts_search.php">Search</a></li>
                                </ul>
                            </li>

                            <li class="scroll"><a href="sms.php"><i
                                            class="icon-envelope-letter"></i><span>SMS</span></a>
                            </li>

                            <li class="scroll"><a href="events.php"><i class="icon-event"></i><span>Events</span></a>
                            </li>


                        </ul>
                    </div>

                </nav>
                <!-- End XP Nav -->

            </div>
            <!-- End XP Menubar -->

        </div>
        <!-- End XP Headerbar -->
