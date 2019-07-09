<?php include('../dbcon.php');


$qucel=$mysqli->query("select DISTINCT(department) from grading");



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
        height:350px;
        overflow:scroll;
        overflow-x:hidden;
    }
</style>

<div class="hr hr32 hr-dotted"></div>

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
                            &nbsp;<?php echo $department = $fet_cel['department'] ?>
                        </a>
                    </h4>
                </div>

                <div class="panel-collapse collapse in" id="collapseOne">
                    <div class="panel-body">

                        <?php

                        $q = $mysqli->query("select * from grading where department = '$department'");

                        ?>


                        <table id="" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>

                                <th width="15%">Mark From</th>
                                <th width="15%">Mark To</th>
                                <th width="25%">Remark</th>
                                <th width="15%">Grade</th>
                                <th width="15%">Display Grade</th>
                                <th width="15%">Action</th>

                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            while($r=$q->fetch_assoc())
                            {

                                ?>

                                <tr>



                                    <td><?php echo $r['mark_from'];?></td>

                                    <td><?php echo $r['mark_to'];?></td>

                                    <td><?php echo $r['remark'];?></td>

                                    <td><?php echo $r['grade'];?></td>

                                    <td><?php echo $r['grade_display'];?></td>


                                    <td>
                                        <a href="#" class="delete_grade" i_index="<?php echo $r['id'];?>">
                                            Delete</a></td>


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



    $(document).on('click','.delete_grade',function() {
        var theindex = $(this).attr('i_index');
        swal({
                title: "Do you want to delete this grade?",
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
                        url: "ajax/delete_grade.php",
                        data: {theindex: theindex},
                        dataType: "html",

                        success:function(text) {

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


                        },

                        complete: function () {

                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        }
                    });

                    swal("Deleted!", "Grading has been deleted.", "success");

                } else {
                    swal("Cancelled", "Data is safe.", "error");
                }
            });


    });



</script>

