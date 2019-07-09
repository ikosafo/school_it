<?php include('../dbcon.php');

$qucel=$mysqli->query("select * from assessment ORDER BY id");


?>

<script>
    function checkDec(el){
        var ex = /^[0-9]+\.?[0-9]*$/;
        if(ex.test(el.value)==false){
            el.value = el.value.substring(0,el.value.length - 1);
        }
    }
</script>

<div class="hr hr32 hr-dotted"></div>


<form class="form-horizontal" id="validation-form" name="ass_form"
      method="post" enctype="multipart/form-data" autocomplete="off">


    <div class="form-group">

        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">Select Department:</label>

        <div class="col-xs-6 col-sm-2">
            <div class="clearfix">
                <select id="dept_name"
                        class="select2"
                        data-placeholder="Click to select Dept....">
                    <option value=""></option>
                    <?php
                    $cl_name = $mysqli->query("SELECT * FROM department");
                    while ($row = $cl_name->fetch_assoc()) {
                        ?>
                        <?php echo '<option value="' . $row['name'] . '"';

                        echo '> ' . $row['name'] . '</option>';


                        ?>


                        <?php

                    }
                    ?>

                </select>

            </div>
        </div>

        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">Class Score:</label>

        <div class="col-xs-6 col-sm-1">
            <div class="clearfix">
                <input type="text" id="class_score"
                       class="col-xs-12 col-sm-12"
                       onkeyup="checkDec(this);"
                    />
            </div>
        </div>

        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">Exam Score:</label>

        <div class="col-xs-6 col-sm-1">
            <div class="clearfix">
                <input type="text" id="exam_score"
                       class="col-xs-12 col-sm-12"
                       onkeyup="checkDec(this);"
                    />
            </div>
        </div>

        <div class="col-xs-6 col-sm-2">

            <div class="clearfix">

                <button class="btn btn-info btn-sm btn-primary btn-white btn-round" type="button"
                        id="save_assessment_btn">
                    <i class="ace-icon fa fa-save bigger-110"></i>
                    Save
                </button>

            </div>


        </div>

    </div>


</form>


<hr/>


<table id="" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>

        <th>Department</th>
        <th>Class Score</th>
        <th>Exam Score</th>


    </tr>
    </thead>

    <tbody>

    <?php
    while($fet_cel=$qucel->fetch_assoc())
    {

        ?>

        <tr>



            <td><?php echo $fet_cel['department'];?></td>

            <td><?php echo $fet_cel['class_score'];?></td>

            <td><?php echo $fet_cel['exam_score'];?></td>


        </tr>

        <?php
    }
    ?>

    </tbody>
</table>


<p>
    NB: Entering new scores updates old record with same department
</p>


<script>

    $('.select2').css('width', '200px').select2({allowClear: true})
    $('#select2-multiple-style .btn').on('click', function (e) {
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        if (which == 2) $('.select2').addClass('tag-input-style');
        else $('.select2').removeClass('tag-input-style');
    });


    $('#save_assessment_btn').click(function () {

        var class_score = $('#class_score').val();
        var exam_score = $('#exam_score').val();
        var dept_name = $('#dept_name').val();
        var sum = parseInt(class_score) + parseInt(exam_score);


        var error = '';

        if (class_score == "") {
            error += 'Please enter class score \n';
            document.ass_form.class_score.focus();
        }
        if (exam_score == "") {
            error += 'Please enter exam score \n';
            document.ass_form.exam_score.focus();
        }
        if (dept_name == "") {
            error += 'Please select department \n';

        }
        if (sum != 100) {
            error += 'Sum is not up to 100% \n';

        }

        if (error == "") {

            $.ajax({
                type: "POST",
                url: "ajax/saveassessment.php",
                data: {
                    class_score: class_score,
                    exam_score: exam_score,
                    dept_name: dept_name

                },

                success: function (text) {

                    swal("Submitted!", "Assessment Config Updated", "success");


                    $.ajax({
                        url: "ajax/assessment_form.php",
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


</script>



