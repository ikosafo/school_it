<?php include('../../config.php');


$qdep = $mysqli->query("select * from fees_attendance ORDER BY academicyear DESC,id DESC");


?>


<!-- Kitchen Sink Card -->
<div class="card m-b-30">


    <div class="card-header bg-white">
        <h5 class="card-title text-black">Fees and Attendance</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="acad_db" class="display table table-bordered">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Academic Year</th>
                    <th>Term</th>
                    <th>Department</th>
                    <th>Fees</th>
                    <th>Attendance</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>


                <?php
                $counter = 1;
                while ($rdep = $qdep->fetch_assoc()) {

                    ?>


                    <tr>
                        <td>
                            <?php
                            echo $counter;
                            ?>
                        </td>
                        <td><?php echo $rdep['academicyear'] ?></td>
                        <td><?php echo $rdep['term'] ?></td>
                        <td><?php $department = $rdep['department'];
                                  $getname = $mysqli->query("select * from department where id = '$department'");
                                  $resname = $getname->fetch_assoc();
                                  echo $resname['department_name'];
                        ?>
                        </td>
                        <td><?php echo $rdep['schoolfees'] ?></td>
                        <td><?php echo $rdep['attendance'] ?></td>
                        <td align="center">
                            <a href="#" class="edit_feesatt" i_index="<?php echo $rdep['id']; ?>">
                                <i class="fa fa-2x fa-edit"></i>
                            </a>
                        </td>
                        <td align="center">
                            <a href="#" class="delete_feesatt" i_index="<?php echo $rdep['id']; ?>">
                                <i class="fa fa-2x fa-trash-o"></i>
                            </a>
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

    $('#acad_db').DataTable( {
        "scrollY":        "600px",
        "scrollCollapse": true,
        "paging":         false
    } );

    $_blockDelete = false;

    //Handle closeIcon's callback
    $(document).on('click', '.delete_feesatt', function () {

        event.preventDefault();

        if (!$_blockDelete) {
            $_blockDelete = true;

            var id_index = $(this).attr('i_index');

            //alert(id_index);

            $.confirm({
                title: 'Delete Fees and Attendance record!',
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
                                url: "ajax/tables/config_feesatt_table.php",
                                beforeSend: function () {
                                    $.blockUI({
                                        message: '<img src="assets/images/load.gif"/>'
                                    });
                                },

                                success: function (text) {
                                    $('#feesatt_table_div').html(text);
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
                                url: "ajax/queries/delete_feesatt.php",
                                data: {
                                    id_index: id_index
                                },
                                dataType: "html",

                                success: function (text) {

                                    $.ajax({
                                        url: "ajax/tables/config_feesatt_table.php",
                                        beforeSend: function () {
                                            $.blockUI({
                                                message: '<img src="assets/images/load.gif"/>'
                                            });
                                        },

                                        success: function (text) {
                                            $('#feesatt_table_div').html(text);
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


    $(document).on('click', '.edit_feesatt', function () {

        var id_index = $(this).attr('i_index');

        //alert(id_index);

        $.ajax({
            type: "POST",
            url: "ajax/forms/config_feesatt_form_edit.php",
            data:
                {
                    id_index: id_index
                },
            beforeSend: function () {
                $.blockUI({
                    message: '<img src="assets/images/load.gif"/>'
                });
            },
            success: function (text) {
                $('#feesatt_form_div').html(text);
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