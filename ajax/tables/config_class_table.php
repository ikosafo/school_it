<?php include('../../config.php');


$qclass = $mysqli->query("select * from class ORDER BY class_name");


?>


<!-- Kitchen Sink Card -->
<div class="card m-b-30">


    <div class="card-header bg-white">
        <h5 class="card-title text-black">Class</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="xp-default-datatable" class="display table table-bordered">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Edit</th>
                    <th>Delete</th>
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
                        <td><?php echo $rclass['class_name'] ?></td>
                        <td><?php $did = $rclass['department'];
                        $q = $mysqli->query("select * from department where id = '$did'");
                        $r = $q->fetch_assoc();
                        echo $r['department_name'];
                        ?></td>
                        <td align="center">
                            <a href="#" class="edit_class" i_index="<?php echo $rclass['id']; ?>">
                                <i class="fa fa-2x fa-edit"></i>
                            </a>
                        </td>
                        <td align="center">
                            <a href="#" class="delete_class" i_index="<?php echo $rclass['id']; ?>">
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

    $_blockDelete = false;

    //Handle closeIcon's callback
    $(document).on('click', '.delete_class', function () {

        event.preventDefault();

        if (!$_blockDelete) {
            $_blockDelete = true;

            var id_index = $(this).attr('i_index');

            //alert(id_index);

            $.confirm({
                title: 'Delete Class!',
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
                                url: "ajax/tables/config_class_table.php",
                                beforeSend: function () {
                                    $.blockUI({
                                        message: '<img src="assets/images/load.gif"/>'
                                    });
                                },

                                success: function (text) {
                                    $('#class_table_div').html(text);
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
                                url: "ajax/queries/delete_class.php",
                                data: {
                                    id_index: id_index
                                },
                                dataType: "html",

                                success: function (text) {

                                    $.ajax({
                                        url: "ajax/tables/config_class_table.php",
                                        beforeSend: function () {
                                            $.blockUI({
                                                message: '<img src="assets/images/load.gif"/>'
                                            });
                                        },

                                        success: function (text) {
                                            $('#class_table_div').html(text);
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


    $(document).on('click', '.edit_class', function () {

        var id_index = $(this).attr('i_index');

        //alert(id_index);

        $.ajax({
            type: "POST",
            url: "ajax/forms/config_class_form_edit.php",
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
                $('#class_form_div').html(text);
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