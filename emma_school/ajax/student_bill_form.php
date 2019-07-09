<?php include('../dbcon.php');

$date = date("Y-m-d");

$student_id=mysqli_real_escape_string($mysqli,$_POST['student_id']);

$sess = $mysqli->query("select * from `academic_session` where date_from <= '$date' AND date_to >= '$date'");
$res_ses = $sess->fetch_assoc();
$academic_year = $res_ses['year'];
$term = $res_ses['term'];
$total_attendance = $res_ses['total_attendance'];

$chk = $mysqli->query("SELECT * FROM student s JOIN class c ON s.`class` = c.`name` where student_id = '$student_id'");
$res_chk = $chk->fetch_assoc();
$department = $res_chk['department'];

$get_tu = $mysqli->query("select * from tuition_fees where department = '$department' and year = '$academic_year' and term = '$term'");
$res_tu = $get_tu->fetch_assoc();
$tuition_fee = $res_tu['amount'];
$attendance = $res_tu['attendance'];

$count = mysqli_num_rows($sess);

if ($count == "0"){ ?>

    <script>
        swal("Session for this period does not exist","","error");
    </script>

<?php }

else {



    $query_id = $mysqli->query("select * from student where student_id = '$student_id'");
    $result_id = $query_id->fetch_assoc();


    $get = $mysqli->query("select * from bill_conduct where student_id = '$student_id' and academic_year = '$academic_year' and term = '$term'");

    $count = mysqli_num_rows($get);

    if ($count == "0") { ?>


        <form class="form-horizontal" name="bill_form"
              method="post" enctype="multipart/form-data" autocomplete="on">



            <div class="form-group">
                <label
                    class="control-label col-xs-2 col-sm-3 no-padding-right">Promoted To / Repeated To:</label>

                <div class="col-xs-2 col-sm-3">
                    <div class="clearfix">

                        <select id="promoted_to"
                                class="select2"
                                data-placeholder="Click to Choose Class...">
                            <option value="">Select Class</option>


                            <?php $que = $mysqli->query("select * from department order by id");

                            while ($fet = $que->fetch_assoc()) {

                                ?>


                                <optgroup label="<?php echo $dept = $fet['name'] ?>">

                                    <?php
                                    $sql = "select * from `class` where department = '$dept'";
                                    $res = $mysqli->query($sql);
                                    if (mysqli_num_rows($res) > 0) {
                                        while ($row = mysqli_fetch_object($res)) {
                                            echo "<option value='" . $row->name . "'>" . $row->name . "</option>";
                                        }
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
                    class="control-label col-xs-2 col-sm-2 no-padding-right">Attendance:</label>

                <div class="col-xs-2 col-sm-1">
                    <div class="clearfix">
                        <input type="text" id="attendance"
                               class="col-xs-12 col-sm-12"
                               onkeyup="checkDec(this);"/>
                    </div>
                </div>

                <label
                    class="control-label col-xs-2 col-sm-2 no-padding-right">Total Attendance:</label>

                <div class="col-xs-2 col-sm-1">
                    <div class="clearfix">
                        <input type="text" id="attendance_total"
                               class="col-xs-12 col-sm-12" value="<?php echo $attendance; ?>"
                               readonly/>
                    </div>
                </div>


            </div>


            <div class="space-2"></div>



            <div class="form-group">
                <label
                    class="control-label col-xs-6 col-sm-3 no-padding-right">Conduct:</label>

                <div class="col-xs-6 col-sm-7">
                    <div class="clearfix">

                        <input type="text" id="conduct"
                               class="col-xs-12 col-sm-12"/>
                    </div>
                </div>

            </div>

            <div class="form-group">

                <label
                    class="control-label col-xs-6 col-sm-3 no-padding-right">Attitude:</label>

                <div class="col-xs-6 col-sm-7">
                    <div class="clearfix">

                        <input type="text" id="attitude"
                               class="col-xs-12 col-sm-12"/>
                    </div>
                </div>


            </div>


            <div class="space-2"></div>


            <div class="form-group">
                <label
                    class="control-label col-xs-6 col-sm-3 no-padding-right">Interest:</label>

                <div class="col-xs-6 col-sm-7">
                    <div class="clearfix">

                        <input type="text" id="interest"
                               class="col-xs-12 col-sm-12"/>
                    </div>
                </div>



            </div>


            <div class="space-2"></div>

            <hr/>

            <div class="form-group">
                <label
                    class="control-label col-xs-6 col-sm-3 no-padding-right">Class Teacher's Remark:</label>

                <div class="col-xs-6 col-sm-7">
                    <div class="clearfix">

                        <input type="text" id="teacher_remark"
                               class="col-xs-12 col-sm-12"/>
                    </div>
                </div>



            </div>


            <div class="space-2"></div>


            <div class="form-group">
                <label
                    class="control-label col-xs-6 col-sm-3 no-padding-right">Head Teacher's Remark:</label>

                <div class="col-xs-6 col-sm-7">
                    <div class="clearfix">

                        <input type="text" id="head_teacher_remark"
                               class="col-xs-12 col-sm-12"/>
                    </div>
                </div>



            </div>


            <div class="space-2"></div>

            <hr/>

            <div class="form-group">
                <label
                    class="control-label col-xs-6 col-sm-2 no-padding-right">Arrears:</label>

                <div class="col-xs-6 col-sm-4">
                    <div class="clearfix">

                        <input type="text" id="arrears"
                               class="col-xs-12 col-sm-12"
                               onkeyup="checkDec(this);"/>
                    </div>
                </div>


                <label
                    class="control-label col-xs-6 col-sm-2 no-padding-right">Tuition Fee:</label>

                <div class="col-xs-6 col-sm-4">
                    <div class="clearfix">

                        <input type="text" id="tuition_fee"
                               class="col-xs-12 col-sm-12" value="<?php echo $tuition_fee ?>" readonly/>
                    </div>
                </div>



            </div>


            <div class="space-2"></div>


            <div class="form-group">
                <label
                    class="control-label col-xs-6 col-sm-2 no-padding-right">ICT:</label>

                <div class="col-xs-6 col-sm-4">
                    <div class="clearfix">

                        <input type="text" id="ict"
                               class="col-xs-12 col-sm-12"
                               onkeyup="checkDec(this);"/>
                    </div>
                </div>


                <label
                    class="control-label col-xs-6 col-sm-2 no-padding-right">Others:</label>

                <div class="col-xs-6 col-sm-4">
                    <div class="clearfix">

                        <input type="text" id="others"
                               class="col-xs-12 col-sm-12"
                               onkeyup="checkDec(this);"/>
                    </div>
                </div>



            </div>


            <div class="space-2"></div>


            <div class="clearfix form-actions">
                <div class="col-md-offset-5 col-md-6">
                    <button class="btn btn-info btn-sm btn-primary btn-white btn-round" type="button" id="save_bill_btn">
                        <i class="ace-icon fa fa-save bigger-110"></i>
                        Save
                    </button>


                </div>
            </div>




        </form>


    <?php   }


    else {

        $get_edit = $mysqli->query("select * from bill_conduct where student_id = '$student_id' and academic_year = '$academic_year' and term = '$term'");
        $res_edit = $get_edit->fetch_assoc();

        ?>


        <form class="form-horizontal" name="edit_bill_form"
              method="post" enctype="multipart/form-data" autocomplete="on">



            <div class="form-group">
                <label
                    class="control-label col-xs-2 col-sm-3 no-padding-right">Promoted To / Repeated To:</label>

                <?php $class = $res_edit['promoted_to']?>

                <div class="col-xs-2 col-sm-3">
                    <div class="clearfix">

                        <select id="promoted_to"
                                class="select2"
                                data-placeholder="Click to Choose Class...">

                            <option value="<?php echo $res_edit['promoted_to']?>"><?php echo $class; ?></option>
                            <option value=""></option>


                            <?php $que = $mysqli->query("select * from department order by id");

                            while ($fet = $que->fetch_assoc()) {

                                ?>


                                <optgroup label="<?php echo $dept = $fet['name'] ?>">

                                    <?php
                                    $sql = "select * from `class` where department = '$dept'";
                                    $res = $mysqli->query($sql);
                                    if (mysqli_num_rows($res) > 0) {
                                        while ($row = mysqli_fetch_object($res)) {
                                            echo "<option value='" . $row->name . "'>" . $row->name . "</option>";
                                        }
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
                    class="control-label col-xs-2 col-sm-2 no-padding-right">Attendance:</label>

                <div class="col-xs-2 col-sm-1">
                    <div class="clearfix">
                        <input type="text" id="attendance"
                               class="col-xs-12 col-sm-12"
                            value="<?php echo $res_edit['attendance_from'] ?>"
                               onkeyup="checkDec(this);"/>
                    </div>
                </div>

                <label
                    class="control-label col-xs-2 col-sm-2 no-padding-right">Total Attendance:</label>

                <div class="col-xs-2 col-sm-1">
                    <div class="clearfix">
                        <input type="text" id="attendance_total"
                               class="col-xs-12 col-sm-12"
                               value="<?php echo $total_attendance; ?>"
                               readonly/>
                    </div>
                </div>


            </div>


            <div class="space-2"></div>



            <div class="form-group">
                <label
                    class="control-label col-xs-6 col-sm-3 no-padding-right">Conduct:</label>

                <div class="col-xs-6 col-sm-7">
                    <div class="clearfix">

                        <input type="text" id="conduct"
                               class="col-xs-12 col-sm-12"
                               value="<?php echo $res_edit['conduct'] ?>"/>
                    </div>
                </div>

            </div>

            <div class="form-group">

                <label
                    class="control-label col-xs-6 col-sm-3 no-padding-right">Attitude:</label>

                <div class="col-xs-6 col-sm-7">
                    <div class="clearfix">

                        <input type="text" id="attitude"
                               class="col-xs-12 col-sm-12"
                               value="<?php echo $res_edit['attitude'] ?>"/>
                    </div>
                </div>


            </div>


            <div class="space-2"></div>


            <div class="form-group">
                <label
                    class="control-label col-xs-6 col-sm-3 no-padding-right">Interest:</label>

                <div class="col-xs-6 col-sm-7">
                    <div class="clearfix">

                        <input type="text" id="interest"
                               class="col-xs-12 col-sm-12"
                               value="<?php echo $res_edit['interest'] ?>"/>
                    </div>
                </div>



            </div>


            <div class="space-2"></div>

            <hr/>

            <div class="form-group">
                <label
                    class="control-label col-xs-6 col-sm-3 no-padding-right">Class Teacher's Remark:</label>

                <div class="col-xs-6 col-sm-7">
                    <div class="clearfix">

                        <input type="text" id="teacher_remark"
                               class="col-xs-12 col-sm-12"
                               value="<?php echo $res_edit['class_teachers_remark'] ?>"/>
                    </div>
                </div>



            </div>


            <div class="space-2"></div>


            <div class="form-group">
                <label
                    class="control-label col-xs-6 col-sm-3 no-padding-right">Head Teacher's Remark:</label>

                <div class="col-xs-6 col-sm-7">
                    <div class="clearfix">

                        <input type="text" id="head_teacher_remark"
                               class="col-xs-12 col-sm-12"
                               value="<?php echo $res_edit['head_teachers_remark'] ?>"/>
                    </div>
                </div>



            </div>


            <div class="space-2"></div>

            <hr/>

            <div class="form-group">
                <label
                    class="control-label col-xs-6 col-sm-2 no-padding-right">Arrears:</label>

                <div class="col-xs-6 col-sm-4">
                    <div class="clearfix">

                        <input type="text" id="arrears"
                               class="col-xs-12 col-sm-12"
                               value="<?php echo $res_edit['arrears'] ?>"
                               onkeyup="checkDec(this);"/>
                    </div>
                </div>


                <label
                    class="control-label col-xs-6 col-sm-2 no-padding-right">Tuition Fee:</label>

                <div class="col-xs-6 col-sm-4">
                    <div class="clearfix">

                        <input type="text" id="tuition_fee"
                               class="col-xs-12 col-sm-12"
                               value="<?php echo $tuition_fee ?>" readonly/>
                    </div>
                </div>

<input type="hidden" id="table_id" value="<?php echo $res_edit['id'];?>"/>

            </div>


            <div class="space-2"></div>


            <div class="form-group">
                <label
                    class="control-label col-xs-6 col-sm-2 no-padding-right">ICT:</label>

                <div class="col-xs-6 col-sm-4">
                    <div class="clearfix">

                        <input type="text" id="ict"
                               class="col-xs-12 col-sm-12"
                               value="<?php echo $res_edit['ict'] ?>"
                               onkeyup="checkDec(this);"/>
                    </div>
                </div>


                <label
                    class="control-label col-xs-6 col-sm-2 no-padding-right">Others:</label>

                <div class="col-xs-6 col-sm-4">
                    <div class="clearfix">

                        <input type="text" id="others"
                               class="col-xs-12 col-sm-12"
                               value="<?php echo $res_edit['others'] ?>"
                               onkeyup="checkDec(this);"/>
                    </div>
                </div>



            </div>


            <div class="space-2"></div>


            <div class="clearfix form-actions">
                <div class="col-md-offset-5 col-md-6">
                    <button class="btn btn-info btn-sm btn-primary btn-white btn-round" type="button" id="edit_bill_btn">
                        <i class="ace-icon fa fa-edit bigger-110"></i>
                        Edit
                    </button>


                </div>
            </div>




        </form>



    <?php   }


    ?>



<?php } ?>



<script>

    function checkDec(el){
        var ex = /^[0-9]+\.?[0-9]*$/;
        if(ex.test(el.value)==false){
            el.value = el.value.substring(0,el.value.length - 1);
        }
    }


    $('#save_bill_btn').click(function () {


        var student_id = '<?php echo $student_id; ?>';
        var academic_year = '<?php echo $academic_year; ?>';
        var term = '<?php echo $term; ?>';
        var promoted_to = $('#promoted_to').val();
        var attendance = $('#attendance').val();
        var attendance_total = $('#attendance_total').val();
        var conduct = $('#conduct').val();
        var attitude = $('#attitude').val();
        var interest = $('#interest').val();

        var teacher_remark = $('#teacher_remark').val();
        var head_teacher_remark = $('#head_teacher_remark').val();

        var arrears = $('#arrears').val();
        var tuition_fee = $('#tuition_fee').val();
        var ict = $('#ict').val();
        var others = $('#others').val();
        var table_id = $('#table_id').val();





        $.ajax({
            type: "POST",
            url: "ajax/savebillconduct.php",
            data: {

                promoted_to: promoted_to,
                attendance: attendance,
                attendance_total: attendance_total,
                conduct: conduct,
                attitude: attitude,
                interest: interest,
                teacher_remark: teacher_remark,
                head_teacher_remark: head_teacher_remark,
                arrears: arrears,
                tuition_fee: tuition_fee,
                ict: ict,
                others: others,
                student_id:student_id,
                academic_year:academic_year,
                term:term,
                table_id:table_id

            },

            success: function (text) {

                swal("Submitted!", "Saved", "success");


                $.ajax({
                    type: "POST",
                    url: "ajax/student_bill_form.php",
                    data: {

                        student_id: student_id

                    },
                    success: function (text) {

                        $('#bill_here').html(text);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " " + thrownError);
                    },

                });


            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },

        });


        return false;
    });





    $('#edit_bill_btn').click(function () {

        var student_id = '<?php echo $student_id; ?>';
        var academic_year = '<?php echo $academic_year; ?>';
        var term = '<?php echo $term; ?>';
        var promoted_to = $('#promoted_to').val();
        var attendance = $('#attendance').val();
        var attendance_total = $('#attendance_total').val();
        var conduct = $('#conduct').val();
        var attitude = $('#attitude').val();
        var interest = $('#interest').val();

        var teacher_remark = $('#teacher_remark').val();
        var head_teacher_remark = $('#head_teacher_remark').val();

        var arrears = $('#arrears').val();
        var tuition_fee = $('#tuition_fee').val();
        var ict = $('#ict').val();
        var others = $('#others').val();
        var table_id = $('#table_id').val();


        $.ajax({
            type: "POST",
            url: "ajax/editbillconduct.php",
            data: {

                promoted_to: promoted_to,
                attendance: attendance,
                attendance_total: attendance_total,
                conduct: conduct,
                attitude: attitude,
                interest: interest,
                teacher_remark: teacher_remark,
                head_teacher_remark: head_teacher_remark,
                arrears: arrears,
                tuition_fee: tuition_fee,
                ict: ict,
                others: others,
                student_id:student_id,
                academic_year:academic_year,
                term:term,
                table_id:table_id

            },

            success: function (text) {

                swal("Submitted!", "Updated", "success");


                $.ajax({
                    type: "POST",
                    url: "ajax/student_bill_form.php",
                    data: {

                        student_id: student_id

                    },
                    success: function (text) {

                        $('#bill_here').html(text);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " " + thrownError);
                    },

                });


            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },

        });


        return false;
    });


</script>



