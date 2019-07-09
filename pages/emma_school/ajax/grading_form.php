<?php include('../dbcon.php'); ?>

<script>
    function isNumberKey(evt, obj) {

        var charCode = (evt.which) ? evt.which : event.keyCode
        var value = obj.value;
        var dotcontains = value.indexOf(".") != -1;
        if (dotcontains)
            if (charCode == 46) return false;
        if (charCode == 46) return true;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>

<div class="hr hr32 hr-dotted"></div>


<form class="form-horizontal" id="validation-form" name="grade_form"
      method="post" enctype="multipart/form-data" autocomplete="off">


    <div class="form-group">

        <label
            class="control-label col-xs-12 col-sm-4 no-padding-right">Select Department:</label>

        <div class="col-xs-12 col-sm-8">
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

    </div>

    <div class="form-group">

        <label
            class="control-label col-xs-12 col-sm-4 no-padding-right">Marks From:</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix">
                <input type="text" id="mark_from"
                       class="col-xs-12 col-sm-12"
                       onkeypress="return isNumberKey(event,this)"
                    />
            </div>
        </div>

    </div>

    <div class="form-group">

        <label
            class="control-label col-xs-12 col-sm-4 no-padding-right">Marks To:</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix">
                <input type="text" id="mark_to"
                       class="col-xs-12 col-sm-12"
                       onkeypress="return isNumberKey(event,this)"
                    />
            </div>
        </div>


    </div>


    <div class="form-group">

        <label
            class="control-label col-xs-12 col-sm-4 no-padding-right">Remarks:</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix">
                <input type="text" id="remark"
                       class="col-xs-12 col-sm-12"
                    />
            </div>
        </div>

        </div>

    <div class="form-group">

        <label
            class="control-label col-xs-12 col-sm-4 no-padding-right">Grade for Computation:</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix">
                <input type="text" id="grade"
                       class="col-xs-12 col-sm-12"
                       onkeypress="return isNumberKey(event,this)"
                    />
            </div>
        </div>


    </div>


    <div class="form-group">

        <label
            class="control-label col-xs-12 col-sm-4 no-padding-right">Grade to Display:</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix">
                <input type="text" id="grade_display"
                       class="col-xs-12 col-sm-12"
                    />
            </div>
        </div>


    </div>


    <div class="space-2"></div>


    <div class="clearfix form-actions">
        <div class="col-md-offset-5 col-md-6">
            <button class="btn btn-info btn-sm btn-primary btn-white btn-round" type="button" id="save_grading_btn">
                <i class="ace-icon fa fa-save bigger-110"></i>
                Save
            </button>


        </div>
    </div>






</form>

<script>

    $('.select2').css('width', '200px').select2({allowClear: true})
    $('#select2-multiple-style .btn').on('click', function (e) {
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        if (which == 2) $('.select2').addClass('tag-input-style');
        else $('.select2').removeClass('tag-input-style');
    });





    $('#save_grading_btn').click(function () {

        var dept_name = $('#dept_name').val();
        var mark_from = $('#mark_from').val();
        var mark_to = $('#mark_to').val();
        var remark = $('#remark').val();
        var grade = $('#grade').val();
        var grade_display = $('#grade_display').val();


        var error = '';


        if (dept_name == "") {
            error += 'Please select department \n';
            document.grade_form.dept_name.focus();
        }

        if (mark_from == "") {
            error += 'Please enter mark from \n';
            document.grade_form.mark_from.focus();
        }

        if (mark_to == "") {
            error += 'Please enter mark to \n';
            document.grade_form.mark_to.focus();
        }

        if (remark == "") {
            error += 'Please enter mark to \n';
            document.grade_form.remark.focus();
        }

        if (grade == "") {
            error += 'Please enter grade for computation \n';
            document.grade_form.grade.focus();
        }

        if (grade_display == "") {
            error += 'Please enter grade to display \n';
            document.grade_form.grade_display.focus();
        }

        if (parseFloat(mark_from) > parseFloat(mark_to)) {
            error += 'Error with mark range \n';
            document.grade_form.mark_from.focus();
        }


        if (error == "") {

            $.ajax({
                type: "POST",
                url: "ajax/savegrading.php",
                data: {
                    dept_name: dept_name,
                    mark_from: mark_from,
                    mark_to: mark_to,
                    remark: remark,
                    grade:grade,
                    grade_display:grade_display

                },

                success: function (text) {

                    if (text == 1){


                        swal("Submitted!", "Grading Added", "success");

                        $.ajax({
                            url: "ajax/grading_table.php",
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


                        $.ajax({
                            url: "ajax/grading_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<h3><img src="../busy.gif" /> Please Wait...</h3>'
                                });
                            },
                            success: function (text) {
                                $('#grade_form_here').html(text);
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

                        swal("Sorry! Mark Range Value already exist", "", "error");
                    }


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


