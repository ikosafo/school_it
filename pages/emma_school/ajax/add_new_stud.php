<?php include('../dbcon.php');

@session_start();

?>

<h5 class="blue">
    Field marked * are required
</h5>


<form class="form-horizontal" name="student_form" id="myform"
      method="post" enctype="multipart/form-data" autocomplete="off">

    <?php $todate = date("Y-m-d");
    $random_id = rand(1, 1000000) . $todate ?>
    <input type="hidden" id="student_id" value="<?php echo $random_id;; ?>"/>


    <div class="form-group">
        <label
            class="control-label col-xs-12 col-sm-2 no-padding-right">Surname
            *:</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix">
                <input type="text" id="surname"
                       class="col-xs-12 col-sm-12"/>
            </div>
        </div>

        <label
            class="control-label col-xs-12 col-sm-2 no-padding-right">First name
            *:</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix">
                <input type="text" id="firstname"
                       class="col-xs-12 col-sm-12"/>
            </div>
        </div>


    </div>


    <div class="space-2"></div>

    <div class="form-group">
        <label
            class="control-label col-xs-12 col-sm-2 no-padding-right">Other Name(s)
            :</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix">
                <input type="text" id="othername"
                       class="col-xs-12 col-sm-12"/>
            </div>
        </div>


        <label
            class="control-label col-xs-12 col-sm-2 no-padding-right">Gender
            *:</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix">
                <select id="gender"
                        class="select2"
                        data-placeholder="Click to Choose..."
                        style="width: 80%">
                    <option value="">&nbsp;</option>
                    <option value="Male">Male
                    </option>
                    <option value="Female">Female
                    </option>

                </select>
            </div>
        </div>
    </div>


    <div class="space-2"></div>

    <div class="form-group">
        <label
            class="control-label col-xs-12 col-sm-2 no-padding-right">House
            :</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix">
                <input type="text" id="house"
                       class="col-xs-12 col-sm-12"/>
            </div>
        </div>


        <label
            class="control-label col-xs-12 col-sm-2 no-padding-right">Image
            :</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix">
                <input type="file" id="student_image"
                       name="image"
                       class="col-xs-12 col-sm-12"/>
            </div>
        </div>
    </div>

    <hr/>


    <div class="form-group">
        <label
            class="control-label col-xs-12 col-sm-2 no-padding-right">Class
            *:</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix">
                <select class="select2" data-placeholder="Click to Choose..."
                        id="student_class"
                        style="width: 80%">
                    <option value=""></option>


                    <?php $que = $mysqli->query("select * from department order by id");

                    while ($fet = $que->fetch_assoc()) {

                        ?>


                        <optgroup label="<?php echo $dept = $fet['name'] ?>">

                            <?php
                            $que_sub = $mysqli->query("select * from class where department = '$dept'");

                            while ($fet_sub = $que_sub->fetch_assoc()) {
                                ?>

                                <option
                                    value="<?php echo $fet_sub['name'] ?>"><?php echo $fet_sub['name'] ?></option>


                                <?php
                            }
                            ?>

                        </optgroup>

                        <?php
                    }
                    ?>


                </select>
            </div>
        </div>

        <label
            class="control-label col-xs-12 col-sm-2 no-padding-right">Program
            :</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix">
                <select id="program"
                        class="select2"
                        data-placeholder="Click to Choose..."
                        style="width: 80%">
                    <option value="">&nbsp;</option>
                    <?php
                    $que_sub = $mysqli->query("select * from program order by name");

                    while ($fet_sub = $que_sub->fetch_assoc()) {
                        ?>

                        <option
                            value="<?php echo $fet_sub['name'] ?>"><?php echo $fet_sub['name'] ?></option>


                        <?php
                    }
                    ?>


                </select>
            </div>
        </div>
    </div>

    <div clas="form-group">
        <label
            class="control-label col-xs-12 col-sm-2 no-padding-right">Assign Course
            :</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix">
                <select
                    id="course_class"
                    class="select2"
                    data-placeholder="Click to Select Course(s)..."
                    style="width: 200%"
                    multiple required>
                    <option
                        value="">
                        &nbsp;</option>
                    <option value="All Courses in Class">
                        All Courses in Class
                    </option>
                    <?php
                    $cl_name = $mysqli->query("SELECT DISTINCT(course) FROM course_class ORDER BY course");
                    while ($row = $cl_name->fetch_assoc()) {
                        ?>

                        <option value="<?php echo $row['course'] ?>"><?php echo $row['course'] ?></option>

                        <?php

                    }
                    ?>


                </select>
            </div>
        </div>


    </div>

    <div class="space-2"></div>

    <div class="form-group">
        <label
            class="control-label col-xs-12 col-sm-2 no-padding-right">Student ID
            :</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix">
                <input type="text" id="stud_id"
                       class="col-xs-12 col-sm-12"/>
            </div>
        </div>

    </div>


    <div class="form-group">

        <div class="col-xs-5 col-sm-5"></div>

        <div class="col-xs-7 col-sm-7">

            <button type="button"
                    class="btn btn-sm btn-primary btn-white btn-round" id="save_student_btn">

                <i class="icon-on-right ace-icon fa fa-save"></i>

                <span class="bigger-110">Save</span>
            </button>

        </div>


    </div>


</form>


<script type="text/javascript">
    jQuery(function ($) {


        $('[data-rel=tooltip]').tooltip();

        $(".select2").css('width', '200px').select2({allowClear: true})
            .on('change', function () {
                $(this).closest('form').validate().element($(this));
            });

        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });


        $('#student_image').uploadifive({
            'auto': false,
            'method': 'post',
            'buttonText': 'Upload Image',
            'width': 160,
            'formData': {'randno': '<?php echo $random_id?>'},
            'dnd': false,
            'uploadScript': 'ajax/uploadstudentimage.php',
            'onUploadComplete': function (file, data) {
                console.log(data);
            }
        });


        $.mask.definitions['~'] = '[+-]';
        $('#phone').mask('(999) 999-9999');

        $.mask.definitions['~'] = '[+-]';
        $('#altphone').mask('(999) 999-9999');

        $('#dob').mask('9999-99-99');

        $('#date_bap').mask('9999-99-99');

        $('#date_join').mask('9999-99-99');


        $('#save_student_btn').click(function () {

            var surname = $('#surname').val();
            var firstname = $('#firstname').val();
            var othername = $('#othername').val();
            var gender = $('#gender').val();
            var house = $('#house').val();
            var student_class = $('#student_class').val();
            var program = $('#program').val();
            var course_class = $('#course_class').val();
            var student_id = $('#student_id').val();
            var stud_id = $('#stud_id').val();


            var error = '';


            if (surname == "") {
                error += 'Please enter surname \n';
                document.student_form.surname.focus();
            }

            if (firstname == "") {
                error += 'Please enter first name \n';
                document.student_form.firstname.focus();
            }

            if (gender == "") {
                error += 'Please select gender \n';
                document.student_form.gender.focus();
            }

            if (student_class == "") {
                error += 'Please select class \n';
                document.student_form.student_class.focus();
            }

            if (course_class == "") {
                error += 'Please select course \n';
                document.student_form.course_class.focus();
            }


            if (error == "") {

                $('#student_image').uploadifive('upload');

                $.ajax({
                    type: "POST",
                    url: "ajax/savestudentdetails.php",
                    data: {

                        surname: surname,
                        firstname: firstname,
                        othername: othername,
                        gender: gender,
                        house: house,
                        course_class: course_class,
                        student_class: student_class,
                        student_id: student_id,
                        stud_id: stud_id,
                        program: program

                    },
                    success: function (text) {


                        swal("Submitted!", "Student Details Saved", "success");

                        $('#here').html(text);

                        $.ajax({
                            url: "ajax/summary_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<h3><img src="../busy.gif" /> Please Wait...</h3>'
                                });
                            },
                            success: function (text) {
                                $('#summary_here').html(text);
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

                $.notify(error, {position: "top center"});


            }
            return false;


        });


    })
</script>