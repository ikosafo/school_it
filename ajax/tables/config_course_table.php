<?php include('../../config.php');

$qclass = $mysqli->query("select DISTINCT(course_name) from course_class ORDER BY course_name");

?>


<!-- Kitchen Sink Card -->
<div class="card m-b-30">


    <div class="card-header bg-white">
        <h5 class="card-title text-black">Courses</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="xp-default-datatable" class="display table table-bordered">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <!--<th>Code</th>-->
                    <th>Type</th>
                    <th>Add Class</th>
                    <th>Edit Course</th>
                    <th>Delete Course</th>
                    <th>Class(es)</th>

                </tr>
                </thead>
                <tbody>


                <?php
                $counter = 1;
                while ($rclass = $qclass->fetch_assoc()) {

                    ?>


                    <tr>
                        <td>
                            <?php
                            echo $counter;
                            ?>
                        </td>
                        <td><?php echo $course_name = $rclass['course_name'];

                        $getid = $mysqli->query("select * from course_class where course_name = '$course_name'");
                        $resid = $getid->fetch_assoc();
                        $course_id = $resid['course_id'];
                        $course_code = $resid['course_code'];
                        $course_type = $resid['type'];

                        ?>
                        </td>
                       <!-- <td>
                            <?php /*echo $course_code; */?>
                        </td>-->
                        <td>
                            <?php echo $course_type; ?>
                        </td>

                        <td align="center">
                            <a href="#" class="add_class"
                               i_index="<?php echo $course_id; ?>">
                                <i class="fa fa-2x fa-plus-circle"></i>
                            </a>
                        </td>

                        <td align="center">
                            <a href="#" class="edit_course"
                               i_index="<?php echo $course_id; ?>">
                                <i class="fa fa-2x fa-edit"></i>
                            </a>
                        </td>

                        <td align="center">
                            <a href="#" class="delete_course"
                               i_index="<?php echo $course_id; ?>">
                                <i class="fa fa-2x fa-trash-o"></i>
                            </a>
                        </td>

                        <td>

                            <table class="display">

                                <?php

                                $course_name = $rclass['course_name'];
                                $getclass = $mysqli->query("select * from course_class where course_name = '$course_name'");

                                while ($resclass = $getclass->fetch_assoc()){ ?>

                                    <tr>

                                        <td>
                                            <?php $classid = $resclass['classid'];
                                            $getcl = $mysqli->query("select * from class where id = '$classid'");
                                            $rescl = $getcl->fetch_assoc();
                                            echo $rescl['class_name']
                                            ?>
                                        </td>

                                        <td align="center">
                                            <a href="#" class="delete_courseclass"
                                               courseclass_id="<?php echo $resclass['id']; ?>">
                                                Delete
                                            </a>
                                        </td>

                                    </tr>

                                <?php } ?>

                            </table>


                        </td>

                    </tr>

                    <?php $counter++;

                } ?>

                </tbody>


            </table>
        </div>
    </div>

</div>
<!-- Kitchen Sink Card -->


<!-- Datatable init JS -->
<script src="assets/js/init/table-datatable-init.js"></script>

<script>

    $_blockDelete = false;

    //Handle closeIcon's callback
    $(document).on('click', '.delete_course', function () {

        event.preventDefault();

        if (!$_blockDelete) {
            $_blockDelete = true;

            var id_index = $(this).attr('i_index');

            //alert(id_index);

            $.confirm({
                title: 'Delete Course!',
                content: 'Are you sure to continue?',
                buttons: {
                    no: {
                        text: 'No',
                        keys: ['enter', 'shift'],
                        backdrop: 'static',
                        keyboard: false,
                        action: function () {

                            $.alert('Data is safe');

                            $.ajax({
                                url: "ajax/tables/config_course_table.php",
                                beforeSend: function () {
                                    $.blockUI({
                                        message: '<img src="assets/images/load.gif"/>'
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
                    yes: {
                        text: 'Yes, Delete it!',
                        btnClass: 'btn-blue',
                        action: function () {


                            $.ajax({
                                type: "POST",
                                url: "ajax/queries/delete_course.php",
                                data: {
                                    id_index: id_index
                                },
                                dataType: "html",

                                success: function (text) {


                                    $.ajax({
                                        url: "ajax/tables/config_course_table.php",
                                        beforeSend: function () {
                                            $.blockUI({
                                                message: '<img src="assets/images/load.gif"/>'
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
                                },

                                complete: function () {

                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    alert(xhr.status + " " + thrownError);
                                }
                            });


                        }

                    }


                }
            });

        }


    });







    $(document).on('click', '.delete_courseclass', function () {

        event.preventDefault();

        if (!$_blockDelete) {
            $_blockDelete = true;

            var courseclass_id = $(this).attr('courseclass_id');

            //alert(id_index);

            $.confirm({
                title: 'Delete Class assigned to course!',
                content: 'Are you sure to continue?',
                buttons: {
                    no: {
                        text: 'No',
                        keys: ['enter', 'shift'],
                        backdrop: 'static',
                        keyboard: false,
                        action: function () {

                            $.alert('Data is safe');

                            $.ajax({
                                url: "ajax/tables/config_course_table.php",
                                beforeSend: function () {
                                    $.blockUI({
                                        message: '<img src="assets/images/load.gif"/>'
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
                    yes: {
                        text: 'Yes, Delete it!',
                        btnClass: 'btn-blue',
                        action: function () {


                            $.ajax({
                                type: "POST",
                                url: "ajax/queries/delete_courseclass.php",
                                data: {
                                    courseclass_id: courseclass_id
                                },
                                dataType: "html",

                                success: function (text) {


                                    $.ajax({
                                        url: "ajax/tables/config_course_table.php",
                                        beforeSend: function () {
                                            $.blockUI({
                                                message: '<img src="assets/images/load.gif"/>'
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
                                },

                                complete: function () {

                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    alert(xhr.status + " " + thrownError);
                                }
                            });


                        }

                    }


                }
            });

        }


    });







    $(document).on('click', '.edit_course', function () {

        var id_index = $(this).attr('i_index');

        //alert(id_index);

        $.ajax({
            type: "POST",
            url: "ajax/forms/config_course_form_edit.php",
            data: {id_index: id_index },
            beforeSend: function () {
                $.blockUI({
                    message: '<img src="assets/images/load.gif"/>'
                });
            },
            success: function (text) {
                $('#course_form_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },

        });


    });






    $(document).on('click', '.add_class', function () {

        var id_index = $(this).attr('i_index');

        //alert(id_index);

        $.ajax({
            type: "POST",
            url: "ajax/forms/config_course_add_class.php",
            data: {id_index: id_index },
            beforeSend: function () {
                $.blockUI({
                    message: '<img src="assets/images/load.gif"/>'
                });
            },
            success: function (text) {
                $('#course_form_div').html(text);
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