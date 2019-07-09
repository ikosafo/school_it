<?php include('../dbcon.php');


$qucel=$mysqli->query("select name from class ORDER BY department");



?>

<style>
    .DivToScroll{
        background-color: #F5F5F5;
        border: 1px solid #DDDDDD;
        border-radius: 4px 0 4px 0;
        color: #3B3C3E;
        font-size: 12px;
        font-weight: bold;
        left: -1px;
        padding: 10px 7px 5px;
    }

    .DivWithScroll{
        height:430px;
        overflow:scroll;
        overflow-x:hidden;
    }
</style>


<div class="DivWithScroll">



    <div id="accordion" class="accordion-style1 panel-group">

        <?php
        while($fet_cel=$qucel->fetch_assoc())
        {

            ?>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                            &nbsp;<?php echo $class = $fet_cel['name'] ?>
                        </a>
                    </h4>
                </div>

                <div class="panel-collapse collapse in" id="collapseOne">
                    <div class="panel-body">

                        <?php

                        $q = $mysqli->query("select * from student where status is null and class = '$class' ORDER BY lastname,firstname,othername,gender");

                        ?>


                        <table id="" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>

                                <th>Name</th>
                                <th>Gender</th>
                                <th>Action</th>


                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            while($r=$q->fetch_assoc())
                            {

                                ?>

                                <tr>



                                    <td><?php echo $r['lastname'].' '.$r['firstname'].' '.$r['othername'];?></td>

                                    <td><?php echo $r['gender'];?></td>

                                    <td>
                                        <a href="#" class="view_student" title="View Student Details" i_index="<?php echo $r['id']; ?>">
                                            <i class="fa fa-eye"></i> </a>

                                        <a href="#" class="edit_student" title="Edit Student Details" i_index="<?php echo $r['id']; ?>">
                                            <i class="fa fa-edit"></i> </a>

                                        <a href="#" class="delete_student" title="Delete Student Details" i_index="<?php echo $r['id']; ?>">
                                            <i class="fa fa-trash"></i> </a>
                                    </td>


                                </tr>

                                <?php
                            }
                            ?>

                            </tbody>
                        </table>



                    </div>
                </div>
            </div>


        <?php } ?>


    </div>


</div>

<script>


    $(document).on('click', '.view_student', function () {

        var theindex = $(this).attr('i_index');

        $.ajax({
            type: "POST",
            url: "ajax/view_student.php",
            data: {theindex: theindex},
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



    $(document).on('click', '.edit_student', function () {

        var theindex = $(this).attr('i_index');

        $.ajax({
            type: "POST",
            url: "ajax/edit_student.php",
            data: {theindex: theindex},
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



    $(document).on('click','.delete_student',function() {
        var theindex = $(this).attr('i_index');
        swal({
                title: "Do you want to delete this student?",
                text: "You will not be able to recover this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: "POST",
                        url: "ajax/delete_student.php",
                        data: {theindex: theindex},
                        dataType: "html",

                        success:function(text) {

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

                            $.ajax({
                                url: "ajax/student_table.php",
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

                        complete: function () {

                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        }
                    });

                    swal("Deleted!", "Student has been deleted.", "success");

                } else {
                    swal("Cancelled", "Data is safe.", "error");
                }
            });


    });



</script>

