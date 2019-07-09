<?php

include('dbcon.php');
@session_start();


include('top.php'); ?>


<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">




            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="center-was-here">


                        <div class="row">

                            <div class="col-sm-2"></div>


                            <div class="col-sm-8">
                                <div class="widget-box transparent" id="recent-box">
                                    <div class="widget-header">

                                        <div class="widget-toolbar no-border">
                                            <ul class="nav nav-tabs" id="recent-tab">


                                                <li class="active">
                                                    <a data-toggle="tab" href="#details">Details</a>
                                                </li>

                                                <li>
                                                    <a data-toggle="tab" href="#dept">Departments</a>
                                                </li>

                                                <li>
                                                    <a data-toggle="tab" href="#class">Class</a>
                                                </li>

                                                <li>
                                                    <a data-toggle="tab" href="#course">Course</a>
                                                </li>

                                                <li>
                                                    <a data-toggle="tab" href="#position">Positions</a>
                                                </li>

                                                <li>
                                                    <a data-toggle="tab" href="#users"><i
                                                            class="ace-icon fa fa-male bigger-110 blue"></i> System
                                                        Users</a>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main padding-4">
                                            <div class="tab-content padding-8">


                                                <div id="details" class="tab-pane active">

                                                    <p></p>

                                                    <div id="details_form_div"></div>


                                                </div>


                                                <div id="dept" class="tab-pane">
                                                    <a href="#modal-form_dept" role="button" class="blue"
                                                       data-toggle="modal">
                                                        <button type="submit"
                                                                class="btn btn-sm btn-primary btn-white btn-round">

                                                            <i class="icon-on-right ace-icon fa fa-plus-circle"></i>

                                                            <span class="bigger-110">New Department</span>
                                                        </button>
                                                    </a>

                                                    <div id="modal-form_dept" class="modal fade" tabindex="-1">
                                                        <div class="modal-dialog" id="error_loc_dep">
                                                            <form method="post" action="" name="dep_form"
                                                                  id="dep_form" autocomplete="off">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal">&times;</button>
                                                                        <h4 class="blue bigger">Please fill the
                                                                            following form fields</h4>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="row">

                                                                            <div class="col-md-12 col-sm-12">


                                                                                <div class="form-group col-md-12">
                                                                                    <label
                                                                                        for="form-field-username">Department</label>

                                                                                    <div>
                                                                                        <input type="text"
                                                                                               id="dept_name"
                                                                                               placeholder="Enter department name"
                                                                                               style="width:90%"
                                                                                               required/>
                                                                                        <input type="hidden"
                                                                                               id="dept_branch"
                                                                                               placeholder=""
                                                                                               style="width:90%"
                                                                                               value="<?php echo $branch; ?>"/>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="space-4"></div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-sm"
                                                                                data-dismiss="modal">
                                                                            <i class="ace-icon fa fa-times"></i>
                                                                            Cancel
                                                                        </button>

                                                                        <button class="btn btn-sm btn-primary"
                                                                                type="submit"
                                                                                id="save_dept_btn">
                                                                            <i class="ace-icon fa fa-check"></i>
                                                                            Save
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>


                                                    <p></p>

                                                    <div id="dept_table_div"></div>


                                                </div>


                                                <div id="class" class="tab-pane">
                                                    <a href="#modal-form_class" role="button" class="blue"
                                                       data-toggle="modal">
                                                        <button type="submit"
                                                                class="btn btn-sm btn-primary btn-white btn-round">

                                                            <i class="icon-on-right ace-icon fa fa-plus-circle"></i>

                                                            <span class="bigger-110">New Class</span>
                                                        </button>
                                                    </a>

                                                    <div id="modal-form_class" class="modal fade" tabindex="-1">
                                                        <div class="modal-dialog" id="error_loc_class">
                                                            <form method="post" action="" name="class_form"
                                                                  id="class_form" autocomplete="off">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal">&times;</button>
                                                                        <h4 class="blue bigger">Please fill the
                                                                            following form fields</h4>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="row">

                                                                            <div class="col-md-12 col-sm-12">


                                                                                <div class="form-group col-md-12">
                                                                                    <label
                                                                                        for="form-field-username">Class</label>

                                                                                    <div>
                                                                                        <input type="text"
                                                                                               id="class_name"
                                                                                               placeholder="Enter class name"
                                                                                               style="width:90%"
                                                                                               required/>


                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group col-md-6">
                                                                                    <label for="form-field-username">Department</label>

                                                                                    <div>
                                                                                        <select id="class_dept"
                                                                                                class="select2"
                                                                                                data-placeholder="Click to Choose..."
                                                                                                required>
                                                                                            <option value="">&nbsp;</option>
                                                                                            <?php
                                                                                            $cl_name = $mysqli->query("SELECT * FROM department ORDER BY id");
                                                                                            while ($row=$cl_name->fetch_assoc()) {
                                                                                                ?>
                                                                                                <?php echo '<option value="' . $row['name'] . '"';

                                                                                                echo '> ' . $row['name'] . '</option>';
                                                                                                //   echo $row['sign_name'];
                                                                                                ?>


                                                                                                <?php

                                                                                            }
                                                                                            ?>

                                                                                        </select>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="space-4"></div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-sm"
                                                                                data-dismiss="modal">
                                                                            <i class="ace-icon fa fa-times"></i>
                                                                            Cancel
                                                                        </button>

                                                                        <button class="btn btn-sm btn-primary"
                                                                                type="submit"
                                                                                id="save_class_btn">
                                                                            <i class="ace-icon fa fa-check"></i>
                                                                            Save
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>


                                                    <p></p>

                                                    <div id="class_table_div"></div>


                                                </div>


                                                <div id="course" class="tab-pane">
                                                    <a href="#modal-form_course" role="button" class="blue"
                                                       data-toggle="modal">
                                                        <button type="submit"
                                                                class="btn btn-sm btn-primary btn-white btn-round">

                                                            <i class="icon-on-right ace-icon fa fa-plus-circle"></i>

                                                            <span class="bigger-110">New Course</span>
                                                        </button>
                                                    </a>

                                                    <div id="modal-form_course" class="modal fade" tabindex="-1">
                                                        <div class="modal-dialog" id="error_loc_course"
                                                             style="width: 40%">
                                                            <form method="post" action="" name="course_form"
                                                                  autocomplete="off">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal">&times;</button>
                                                                        <h4 class="blue bigger">Please fill the
                                                                            following form fields</h4>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="row">

                                                                            <div class="col-md-12 col-sm-12">


                                                                                <div class="form-group col-md-12">
                                                                                    <label
                                                                                        for="form-field-username">Course
                                                                                        Name</label>

                                                                                    <div>
                                                                                        <input type="text"
                                                                                               id="course_name"
                                                                                               name="course_name"
                                                                                               placeholder="Enter name of course"
                                                                                               style="width:80%"/>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="form-group col-md-12">
                                                                                    <label
                                                                                        for="form-field-username">Course Code</label>

                                                                                    <div>
                                                                                        <input type="text"
                                                                                               id="course_code"
                                                                                               name="course_code"
                                                                                               placeholder="Enter course code"
                                                                                               style="width:80%"/>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="form-group col-md-12">
                                                                                    <label for="form-field-username">Select Type</label>

                                                                                    <div>
                                                                                        <select id="course_type"
                                                                                                class="select2"
                                                                                                data-placeholder="Click to Choose..."
                                                                                                required>
                                                                                            <option value="">&nbsp;</option>
                                                                                            <option value="Core">Core</option>
                                                                                            <option value="Elective">Elective</option>


                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="hr hr-dotted"></div>

                                                                                <h5><b>Assign course to class</b></h5>



                                                                                    <div
                                                                                        class="form-group col-md-12">

                                                                                        <div>
                                                                                            <select
                                                                                                id="course_class"
                                                                                                name="course_class[]"
                                                                                                class="select2"
                                                                                                data-placeholder="Click to Select Class(es)..."
                                                                                                style="width: 200%"
                                                                                                multiple required>
                                                                                                <option
                                                                                                    value="">
                                                                                                    &nbsp;</option>
                                                                                                <?php
                                                                                                $cl_name = $mysqli->query("SELECT * FROM class ORDER BY department");
                                                                                                while ($row=$cl_name->fetch_assoc()) {
                                                                                                    ?>
                                                                                                    <?php echo '<option value="' . $row['id'] . '"';

                                                                                                    echo '> ' . $row['name'] . '</option>';
                                                                                                    //   echo $row['sign_name'];
                                                                                                    ?>


                                                                                                    <?php

                                                                                                }
                                                                                                ?>


                                                                                            </select>
                                                                                        </div>
                                                                                    </div>



                                                                                <div class="space-4"></div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-sm"
                                                                                data-dismiss="modal">
                                                                            <i class="ace-icon fa fa-times"></i>
                                                                            Cancel
                                                                        </button>

                                                                        <button class="btn btn-sm btn-primary"
                                                                                type="button"
                                                                                name="save_course"
                                                                                id="save_course_btn">
                                                                            <i class="ace-icon fa fa-check"></i>
                                                                            Save
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>


                                                    <p></p>

                                                    <div id="course_table_div"></div>


                                                </div>


                                                <div id="position" class="tab-pane">
                                                    <a href="#modal-form_position" role="button" class="blue"
                                                       data-toggle="modal">
                                                        <button type="submit"
                                                                class="btn btn-sm btn-primary btn-white btn-round">

                                                            <i class="icon-on-right ace-icon fa fa-plus-circle"></i>

                                                            <span class="bigger-110">New Position</span>
                                                        </button>
                                                    </a>

                                                    <div id="modal-form_position" class="modal fade" tabindex="-1">
                                                        <div class="modal-dialog" id="error_loc_pos">
                                                            <form method="post" action="" name="pos_form"
                                                                  id="pos_form" autocomplete="off">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal">&times;</button>
                                                                        <h4 class="blue bigger">Please fill the
                                                                            following form fields</h4>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="row">

                                                                            <div class="col-md-12 col-sm-12">


                                                                                <div class="form-group col-md-12">
                                                                                    <label
                                                                                        for="form-field-username">Position</label>

                                                                                    <div>
                                                                                        <input type="text"
                                                                                               id="position_name"
                                                                                               placeholder="Enter position name"
                                                                                               style="width:90%"
                                                                                               required/>

                                                                                        <input type="hidden"
                                                                                               id="position_branch"
                                                                                               placeholder=""
                                                                                               style="width:90%"
                                                                                               value="<?php echo $branch; ?>"/>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="space-4"></div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-sm"
                                                                                data-dismiss="modal">
                                                                            <i class="ace-icon fa fa-times"></i>
                                                                            Cancel
                                                                        </button>

                                                                        <button class="btn btn-sm btn-primary"
                                                                                type="submit"
                                                                                id="save_position_btn">
                                                                            <i class="ace-icon fa fa-check"></i>
                                                                            Save
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>


                                                    <p></p>

                                                    <div id="position_table_div"></div>


                                                </div>


                                                <div id="users" class="tab-pane">
                                                    <?php if ($_SESSION['user_type'] == 'Normal') {
                                                        echo "You are not eligible to view this page";
                                                    } ?>
                                                    <?php if ($_SESSION['user_type'] == 'Admin') { ?>
                                                        <a href="#modal-form_user" role="button" class="blue"
                                                           data-toggle="modal">
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-primary btn-white btn-round">

                                                                <i class="icon-on-right ace-icon fa fa-plus-circle"></i>

                                                                <span class="bigger-110">New User</span>
                                                            </button>
                                                        </a>


                                                        <div id="modal-form_user" class="modal fade" tabindex="-1">
                                                            <div class="modal-dialog" id="error_loc_user"
                                                                 style="width: 60%">
                                                                <form method="post" action="" name="user_form"
                                                                      autocomplete="off">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close"
                                                                                    data-dismiss="modal">&times;</button>
                                                                            <h4 class="blue bigger">Please fill the
                                                                                following form fields</h4>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="row">

                                                                                <div class="col-md-12 col-sm-12">


                                                                                    <div
                                                                                        class="form-group col-md-12">
                                                                                        <label
                                                                                            for="form-field-username">Full
                                                                                            Name</label>

                                                                                        <div>
                                                                                            <input type="text"
                                                                                                   id="user_fullname"
                                                                                                   name="full_name"
                                                                                                   placeholder="Enter name of user"
                                                                                                   style="width:90%"/>
                                                                                        </div>
                                                                                    </div>

                                                                                    <h5><b>Permissions</b></h5>

                                                                                    <div class="row">


                                                                                        <div
                                                                                            class="form-group col-md-12">

                                                                                            <div>
                                                                                                <select
                                                                                                    id="permission"
                                                                                                    name="permission[]"
                                                                                                    class="select2"
                                                                                                    data-placeholder="Click to Select Permissions..."
                                                                                                    style="width: 120%"
                                                                                                    multiple>
                                                                                                    <option
                                                                                                        value="">
                                                                                                        &nbsp;</option>
                                                                                                    <option
                                                                                                        value="Configurations">
                                                                                                        Configurations
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Documents">
                                                                                                        Documents
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Memberships">
                                                                                                        Memberships
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Attendance">
                                                                                                        Attendance
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Monetary">
                                                                                                        Monetary
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="SMS">
                                                                                                        SMS
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Birthdays">
                                                                                                        Birthdays
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Accounts">
                                                                                                        Accounts
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Asset Register">
                                                                                                        Asset
                                                                                                        Register
                                                                                                    </option>

                                                                                                </select>
                                                                                            </div>
                                                                                        </div>


                                                                                    </div>


                                                                                    <div class="hr hr-dotted"></div>

                                                                                    <div
                                                                                        class="form-group col-md-6">
                                                                                        <label
                                                                                            for="form-field-username">Username</label>

                                                                                        <div>
                                                                                            <input type="text"
                                                                                                   id="user_username"
                                                                                                   name="username"
                                                                                                   placeholder="Enter username"
                                                                                                   style="width:90%"
                                                                                                   required/>
                                                                                        </div>
                                                                                    </div>


                                                                                    <div
                                                                                        class="form-group col-md-6">
                                                                                        <label
                                                                                            for="form-field-username">Password</label>

                                                                                        <div>
                                                                                            <input type="password"
                                                                                                   id="user_password"
                                                                                                   name="password"
                                                                                                   placeholder="Enter password"
                                                                                                   style="width:90%"
                                                                                                   required/>
                                                                                        </div>
                                                                                    </div>


                                                                                    <div
                                                                                        class="form-group col-md-6">
                                                                                        <label
                                                                                            for="form-field-username">Confirm
                                                                                            Password</label>

                                                                                        <div>
                                                                                            <input type="password"
                                                                                                   id="user_password_conf"
                                                                                                   name="password_conf"
                                                                                                   placeholder="Confirm password"
                                                                                                   style="width:90%"
                                                                                                   required/>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div
                                                                                        class="form-group col-md-6">
                                                                                        <label
                                                                                            for="form-field-username">User
                                                                                            Type</label>

                                                                                        <div>
                                                                                            <select name="user_type"
                                                                                                    id="user_type"
                                                                                                    class="select2">
                                                                                                <option value="">
                                                                                                    Select User Type
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Normal">
                                                                                                    Normal
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Admin">
                                                                                                    Admin
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="space-4"></div>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-sm"
                                                                                    data-dismiss="modal">
                                                                                <i class="ace-icon fa fa-times"></i>
                                                                                Cancel
                                                                            </button>

                                                                            <button class="btn btn-sm btn-primary"
                                                                                    type="button"
                                                                                    name="save_user"
                                                                                    id="save_user_btn">
                                                                                <i class="ace-icon fa fa-check"></i>
                                                                                Save
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>


                                                        <p></p>

                                                        <div id="user_table_div"></div>


                                                    <?php } ?>
                                                </div>


                                            </div>
                                        </div>
                                        <!-- /.widget-main -->
                                    </div>
                                    <!-- /.widget-body -->
                                </div>
                                <!-- /.widget-box -->
                            </div>
                            <!-- /.col -->


                            <div class="col-sm-2"></div>


                        </div>
                        <!-- /.row -->


                    </div>

                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>


            <!-- /.row -->
        </div>
        <!-- /.page-content -->
    </div>
</div><!-- /.main-content -->


<div id="edit-clergy-form" class="modal fade" tabindex="-1">
    <div class="modal-dialog" id="error_loc_cle_ed">
        <form method="post" action="" name="cler_form_ed" id="cler_form_ed" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">Please fill the following form fields</h4>
                </div>

                <div class="modal-body" id="edit-clergy-body">


                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>

                    <button class="btn btn-sm btn-primary" type="submit" id="edit_clergy_btn">
                        <i class="ace-icon fa fa-edit"></i>
                        Edit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<div id="edit-dept-form" class="modal fade" tabindex="-1">
    <div class="modal-dialog" id="error_loc_dep_ed">
        <form method="post" action="" name="dept_form_ed" id="dept_form_ed" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">Please fill the following form fields</h4>
                </div>

                <div class="modal-body" id="edit-dept-body">


                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>

                    <button class="btn btn-sm btn-primary" type="submit" id="edit_dept_btn">
                        <i class="ace-icon fa fa-edit"></i>
                        Edit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<div id="edit-class-form" class="modal fade" tabindex="-1">
    <div class="modal-dialog" id="error_loc_class_ed">
        <form method="post" action="" name="class_form_ed" id="class_form_ed" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">Please fill the following form fields</h4>
                </div>

                <div class="modal-body" id="edit-class-body">


                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>

                    <button class="btn btn-sm btn-primary" type="submit" id="edit_class_btn">
                        <i class="ace-icon fa fa-edit"></i>
                        Edit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>





<div id="view-course-table" class="modal fade" tabindex="-1">
    <div class="modal-dialog" id="error_loc_pos_ed">
        <form method="post" action="" name="">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">Please fill the following form fields</h4>
                </div>


                <div class="modal-body" id="course-table">


                </div>


            </div>
        </form>
    </div>
</div>





<div id="update-course" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" action="" name="">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">Update Course</h4>
                </div>


                <div class="modal-body" id="course-form">


                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>

                    <button class="btn btn-sm btn-primary" type="submit" id="edit_course_btn">
                        <i class="ace-icon fa fa-edit"></i>
                        Edit
                    </button>
                </div>


            </div>
        </form>
    </div>
</div>




<?php include('bottom.php'); ?>


<script type="text/javascript">
    $(document).ready(function () {


        $.ajax({
            url: "ajax/details_form.php",
            beforeSend: function () {
                $.blockUI({
                    message: '<h3><img src="busy.gif" /> Please Wait...</h3>'
                });
            },
            success: function (text) {
                $('#details_form_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },
        });


        $.ajax({
            url: "ajax/dept_table.php",
            beforeSend: function () {
                $.blockUI({
                    message: '<h3><img src="busy.gif" /> Please Wait...</h3>'
                });
            },
            success: function (text) {
                $('#dept_table_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },
        });

        $.ajax({
            url: "ajax/class_table.php",
            beforeSend: function () {
                $.blockUI({
                    message: '<h3><img src="busy.gif" /> Please Wait...</h3>'
                });
            },
            success: function (text) {
                $('#class_table_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },
        });


        $.ajax({
            url: "ajax/course_table.php",
            beforeSend: function () {
                $.blockUI({
                    message: '<h3><img src="busy.gif" /> Please Wait...</h3>'
                });
            },
            success: function (text) {
                $('#course_table_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },
        });


        $('#save_dept_btn').click(function () {

            var dept_name = $('#dept_name').val();


            var error = '';


            if (dept_name == "") {
                error += 'Please enter department \n';
                document.dep_form.dept_name.focus();
            }


            if (error == "") {

                $.ajax({
                    type: "POST",
                    url: "ajax/savedept.php",
                    data: {
                        dept_name: dept_name
                    },
                    success: function (text) {


                        if (text == 1) {
                            swal("Submitted!", "Department Saved", "success");


                            $.ajax({
                                url: "ajax/dept_table.php",
                                beforeSend: function () {
                                    $.blockUI({
                                        message: '<h3><img src="busy.gif" /> Please Wait...</h3>'
                                    });
                                },
                                success: function (text) {
                                    $('#dept_table_div').html(text);
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    alert(xhr.status + " " + thrownError);
                                },
                                complete: function () {
                                    $.unblockUI();
                                },
                            });

                        }

                        else {
                            swal("Department already exist", "", "error");
                        }


                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " " + thrownError);
                    },

                });


            }
            else {

                $('#error_loc_dep').notify(error);


            }
            return false;
        });





        $('#save_class_btn').click(function () {

            var class_name = $('#class_name').val();
            var class_dept = $('#class_dept').val();


            var error = '';


            if (class_name == "") {
                error += 'Please enter class \n';
                document.class_form.class_name.focus();
            }

            if (class_dept == "") {
                error += 'Please select department \n';
                document.class_form.class_dept.focus();
            }


            if (error == "") {

                $.ajax({
                    type: "POST",
                    url: "ajax/saveclass.php",
                    data: {
                        class_name: class_name,
                        class_dept: class_dept
                    },
                    success: function (text) {


                        if (text == 1) {
                            swal("Submitted!", "Class Saved", "success");


                            $.ajax({
                                url: "ajax/class_table.php",
                                beforeSend: function () {
                                    $.blockUI({
                                        message: '<h3><img src="busy.gif" /> Please Wait...</h3>'
                                    });
                                },
                                success: function (text) {
                                    $('#class_table_div').html(text);
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    alert(xhr.status + " " + thrownError);
                                },
                                complete: function () {
                                    $.unblockUI();
                                },
                            });

                        }

                        else {
                            swal("Class already exist", "", "error");
                        }


                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " " + thrownError);
                    },

                });


            }
            else {

                $('#error_loc_class').notify(error);


            }
            return false;
        });




        $('#save_course_btn').click(function () {

            var course_name = $('#course_name').val();
            var course_class = $('#course_class').val();
            var course_type = $('#course_type').val();
            var course_code = $('#course_code').val();


            var error = '';


            if (course_name == "") {
                error += 'Please enter course\n';
                document.course_form.course_name.focus();
            }

            if (course_type == "") {
                error += 'Please select course type \n';
                document.course_form.course_type.focus();
            }



            if (error == "") {

                $.ajax({
                    type: "POST",
                    url: "ajax/savecourse.php",
                    data: {
                        course_name: course_name,
                        course_class: course_class,
                        course_type: course_type,
                        course_code: course_code
                    },
                    success: function (text) {

                        if (text == 2){
                            swal("Course already exist for class", "", "error");
                        }

                        else {

                            swal("Submitted!", "Course Saved", "success");


                            $.ajax({
                                url: "ajax/course_table.php",
                                beforeSend: function () {
                                    $.blockUI({
                                        message: '<h3><img src="busy.gif" /> Please Wait...</h3>'
                                    });
                                },
                                success: function (text) {
                                    $('#course_table_div').html(text);
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    alert(xhr.status + " " + thrownError);
                                },
                                complete: function () {
                                    $.unblockUI();
                                },
                            });

                        }



                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " " + thrownError);
                    },

                });


            }
            else {

                $('#error_loc_course').notify(error);


            }
            return false;
        });




        $('#edit_dept_btn').click(function () {


            var dept_name_ed = $('#dept_name_ed').val();
            var dept_id = $('#dept_id').val();


            var error = '';

            if (dept_name_ed == "") {
                error += 'Please enter department \n';
                document.dept_form_ed.dept_name_ed.focus();
            }


            if (error == "") {

                $.ajax({
                    type: "POST",
                    url: "ajax/saveeditdept.php",
                    data: {
                        dept_name: dept_name_ed,
                        dept_id: dept_id

                    },
                    success: function (text) {
                        swal("Submitted!", "Department Edited", "success");


                        $.ajax({
                            url: "ajax/dept_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<h3><img src="busy.gif" /> Please Wait...</h3>'
                                });
                            },
                            success: function (text) {
                                $('#dept_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },
                        });


                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " " + thrownError);
                    },

                });


            }
            else {

                $('#error_loc_dep_ed').notify(error);


            }
            return false;
        });



        $('#edit_class_btn').click(function () {


            var class_name = $('#class_name_ed').val();
            var class_dept = $('#class_dept_ed').val();
            var class_id = $('#class_id').val();


            var error = '';

            if (class_name == "") {
                error += 'Please enter class \n';
                document.class_form_ed.class_name.focus();
            }


            if (error == "") {

                $.ajax({
                    type: "POST",
                    url: "ajax/saveeditclass.php",
                    data: {
                        class_name: class_name,
                        class_dept:class_dept,
                        class_id: class_id

                    },
                    success: function (text) {
                        swal("Submitted!", "Class Edited", "success");


                        $.ajax({
                            url: "ajax/class_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<h3><img src="busy.gif" /> Please Wait...</h3>'
                                });
                            },
                            success: function (text) {
                                $('#class_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },
                        });


                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " " + thrownError);
                    },

                });


            }
            else {

                $('#error_loc_cel_ed').notify(error);


            }
            return false;
        });


        $('#id-input-file-1 , #id-input-file-2, #doc_file').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose Document',
            btn_change:'Change',
            droppable:false,
            onchange:null,
            thumbnail:false //| true | large
            //whitelist:'gif|png|jpg|jpeg'
            //blacklist:'exe|php'
            //onchange:''
            //
        });





    });


</script>
