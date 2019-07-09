<?php

$departmentid =  date("ymdhis").rand(1,10);

?>
<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Enter Department</h5>
    </div>
    <div class="card-body">

        <label for="department_name">Department Name</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-laptop"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Department Name"
                   id="department_name" autocomplete="off">
        </div>


        <div class="input-group-append mb-3">
            <button class="btn btn-primary" type="button" id="btn_save_department">Submit</button>
        </div>


    </div>
</div>


<script>

    
    $("#btn_save_department").click(function () {

        var department_name = $("#department_name").val();
        var department_id = '<?php echo $departmentid; ?>';

        var error = '';


        if (department_name == "") {
            error += 'Please enter department name\n';
            $("#department_name").focus();
        }

        
        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_department.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/images/load.gif"/>'
                    });
                },
                data: {

                    department_name: department_name,
                    department_id: department_id

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {


                        $.notify("Department Saved", "success", {position: "top center"});


                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/config_department_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#department_form_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });


                        $.ajax({
                            type: "POST",
                            url: "ajax/tables/config_department_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#department_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });

                    }

                    else if (text == 2) {
                        $.notify("Department name already exists,",{position:"top center"});
                    }




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


            $.notify(error, {position: "top left"});

        }


        return false;


    })
</script>
