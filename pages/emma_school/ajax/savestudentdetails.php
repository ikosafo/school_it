<?php

include("../dbcon.php");

@session_start();


$surname = mysqli_real_escape_string($mysqli,$_POST["surname"]);
$firstname = mysqli_real_escape_string($mysqli,$_POST["firstname"]);
$othername = mysqli_real_escape_string($mysqli,$_POST["othername"]);
$gender = mysqli_real_escape_string($mysqli,$_POST["gender"]);
$house = mysqli_real_escape_string($mysqli,$_POST["house"]);
$student_class = mysqli_real_escape_string($mysqli,$_POST["student_class"]);
$student_id = mysqli_real_escape_string($mysqli,$_POST["student_id"]);
$stud_id = mysqli_real_escape_string($mysqli,$_POST["stud_id"]);
$program = mysqli_real_escape_string($mysqli,$_POST["program"]);


$full_name = $surname.' '.$firstname.' '.$othername;


$date = date("Y-m-d H:i:s");



$res=$mysqli->query("select * from student where `student_id` = '$student_id'");
$rowcount = mysqli_num_rows($res);


if ($rowcount == "0"){



    foreach ($_POST['course_class'] as $course_class)
    {

        $r = $mysqli->query("select * from course where student_id = '$student_id' and course = '$course_class'");
        $resu = mysqli_num_rows($r);

        if ($resu == "0"){


            $mysqli->query("INSERT INTO `course`
            (`student`,
             `course`,
             `student_id`)
VALUES ('$full_name',
    '$course_class',
    '$student_id')")

            or die(mysqli_error($mysqli));

        }

        else {

            $mysqli->query("UPDATE `course`
SET
  `student` = '$full_name',
  `course` = '$course_class'

WHERE `id` = '$student_id'")

            or die(mysqli_error($mysqli));

        }




    }







    $mysqli->query("INSERT INTO `student`
            (`student_id`,
            `firstname`,
             `lastname`,
             `othername`,
             `gender`,
             `house`,
              `stud_id`,
              `program`,
             `class`)
VALUES ('$student_id',
        '$firstname',
        '$surname',
        '$othername',
        '$gender',
        '$house',
        '$stud_id',
        '$program',
        '$student_class')")

    or die(mysqli_error($mysqli));





}

else {

    $insert = $mysqli->query("UPDATE `student`

SET

   `firstname` = '$firstname',
  `lastname` = '$surname',
  `othername` = '$othername',
  `gender` = '$gender',
  `house` = '$house',
  `class` = '$student_class',
  `stud_id` = '$stud_id',
  `program` = '$program'

WHERE `student_id` = '$student_id'") or die (mysql_error());



    foreach ($_POST['course_class'] as $course_class)
    {

        $r = $mysqli->query("select * from course where student_id = '$student_id' and course = '$course_class'");
        $resu2 = mysqli_num_rows($r);

        if ($resu2 == "0"){


            $mysqli->query("INSERT INTO `course`
            (`student`,
             `course`,
             `student_id`)
VALUES ('$full_name',
    '$course_class',
    '$student_id')")

            or die(mysqli_error($mysqli));

        }


    }



}


$q_s = $mysqli->query("select * from student where student_id='$student_id'");
$res = $q_s->fetch_assoc();

$random_id = $res['student_id'];

?>



<form class="form-horizontal" name="student_form_view"
      method="post" enctype="multipart/form-data" autocomplete="off">


    <input type="hidden" id="student_id" value="<?php echo $res['id']; ?>"/>




    <div class="row">

        <div class="col-md-2"> </div>

        <div class="col-md-8">

            <table class="table table-hover">

                <?php $q = $mysqli->query("select * from course where student_id = '$random_id'"); ?>

                <thead>

                <tr>
                    <th>Courses Studying</th>
                </tr>

                </thead>

                <tbody>

                <?php
                while ($r = $q->fetch_assoc()) {
                    ?>

                    <tr>
                        <td>

                            <?php echo $r['course'] ?>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

        <div class="col-md-2"> </div>

    </div>


    <hr/>



    <div class="form-group">
        <label
            class="col-xs-12 col-sm-2 no-padding-right">Surname</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['lastname'] ?>
            </div>
        </div>


        <label
            class="col-xs-12 col-sm-2 no-padding-right">First name</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['firstname'] ?>
            </div>
        </div>



    </div>


    <div class="space-2"></div>

    <div class="form-group">
        <label
            class="col-xs-12 col-sm-2 no-padding-right">Other Name(s)</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['othername'] ?>
            </div>
        </div>

        <label
            class="col-xs-12 col-sm-2 no-padding-right">Gender</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['gender'] ?>
            </div>
        </div>

    </div>


    <div class="space-2"></div>

    <div class="form-group">
        <label
            class="col-xs-12 col-sm-2 no-padding-right">House</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['house'] ?>
            </div>
        </div>


        <label
            class="col-xs-12 col-sm-2 no-padding-right">Class</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['class'] ?>
            </div>
        </div>


    </div>


    <div class="form-group">

        <label
            class="col-xs-12 col-sm-2 no-padding-right">Program</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['program'] ?>
            </div>
        </div>

        <label
            class="col-xs-12 col-sm-2 no-padding-right">Student ID</label>

        <div class="col-xs-12 col-sm-4">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['stud_id'] ?>
            </div>
        </div>


    </div>


    <div class="space-2"></div>

    <div class="form-group">

        <div class="col-xs-5 col-sm-5"></div>

        <div class="col-xs-7 col-sm-7">

            <button type="button"
                    class="btn btn-sm btn-primary btn-white btn-round" id="ok_student_btn">

                <i class="icon-on-right ace-icon fa fa-check"></i>

                <span class="bigger-110">Ok</span>
            </button>

            <button type="button"
                    class="btn btn-sm btn-primary btn-white btn-round" id="edit_student_btn">

                <i class="icon-on-right ace-icon fa fa-edit"></i>

                <span class="bigger-110">Edit</span>
            </button>

        </div>





    </div>


</form>


<script>

    $('#edit_student_btn').click(function () {

        var theindex = $('#student_id').val();


        $.ajax({
            type: "POST",
            url: "ajax/edit_student.php",
            data: {
                theindex: theindex
            },
            beforeSend: function () {
                $.blockUI({
                    message: '<h3><img src="../busy.gif" /> Please Wait...</h3>'
                });
            },
            success: function (text) {
                $('#here').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },
        });


        return false;


    });





    $('#ok_student_btn').click(function () {


        $.ajax({
            type: "POST",
            url: "ajax/add_new_stud.php",

            beforeSend: function () {
                $.blockUI({
                    message: '<h3><img src="../busy.gif" /> Please Wait...</h3>'
                });
            },
            success: function (text) {
                $('#here').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },
        });


    });

</script>

