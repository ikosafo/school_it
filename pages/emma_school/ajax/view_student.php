<?php include('../dbcon.php');

@session_start();


$stud_id = $_POST['theindex'];

$q_s = $mysqli->query("select * from student where id='$stud_id'");
$res = $q_s->fetch_assoc();

$st_id = $res['student_id'];

?>



<form class="form-horizontal" name="student_form_edit" id="myform_edit"
      method="post" enctype="multipart/form-data" autocomplete="off">


    <input type="hidden" id="student_id" value="<?php echo $res['id']; ?>"/>







    <div class="row">
        <div class="col-md-4">

    <span class="profile-picture" style="width:34%">
    <img class="editable img-responsive" src="../<?php echo $res['picture'] ?>" id="avatar2"
         alt="" style="width: 100%">
															</span>
        </div>

        <div class="col-md-8">

            <table class="table table-hover">

                <?php $q = $mysqli->query("select * from course where student_id = '$st_id'"); ?>

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

                <i class="icon-on-right ace-icon fa fa-times"></i>

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
