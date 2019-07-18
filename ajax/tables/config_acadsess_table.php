<?php include('../../config.php');


$qdep = $mysqli->query("select * from academic_session ORDER BY academicyear DESC,date_started DESC");


?>


<!-- Kitchen Sink Card -->
<div class="card m-b-30">


    <div class="card-header bg-white">
        <h5 class="card-title text-black">Academic Sessions</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="acad_db" class="display table table-bordered">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Academic Year</th>
                    <th>Term</th>
                    <th>Date Started</th>
                    <th>Date Ended</th>
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
                        <td><?php echo $rdep['date_started'] ?></td>
                        <td><?php echo $rdep['date_ended'] ?></td>
                        <td align="center">
                            <a href="#" class="delete_acadsess" i_index="<?php echo $rdep['id']; ?>">
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
    $(document).on('click', '.delete_acadsess', function () {

        event.preventDefault();

        if (!$_blockDelete) {
            $_blockDelete = true;

            var id_index = $(this).attr('i_index');

            //alert(id_index);

            $.confirm({
                title: 'Delete Academic Session!',
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
                                url: "ajax/tables/config_acadsess_table.php",
                                beforeSend: function () {
                                    $.blockUI({
                                        message: '<img src="assets/images/load.gif"/>'
                                    });
                                },

                                success: function (text) {
                                    $('#acadsess_table_div').html(text);
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
                                url: "ajax/queries/delete_acadsess.php",
                                data: {
                                    id_index: id_index
                                },
                                dataType: "html",

                                success: function (text) {

                                    $.ajax({
                                        url: "ajax/tables/config_acadsess_table.php",
                                        beforeSend: function () {
                                            $.blockUI({
                                                message: '<img src="assets/images/load.gif"/>'
                                            });
                                        },

                                        success: function (text) {
                                            $('#acadsess_table_div').html(text);
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


    $(document).on('click', '.edit_acadsess', function () {

        var id_index = $(this).attr('i_index');

        //alert(id_index);

        $.ajax({
            type: "POST",
            url: "ajax/forms/config_acadsess_form_edit.php",
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
                $('#acadsess_form_div').html(text);
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