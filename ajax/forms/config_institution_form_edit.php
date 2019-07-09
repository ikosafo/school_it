<?php

include('../../config.php');

$randomid = $_POST['randomid'];

$instq = $mysqli->query("select * from institution_details where randomid = '$randomid'");
$instr = $instq->fetch_assoc();


?>


<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Update Institution Details</h5>
        <h6 class="card-subtitle"> All fields are required</h6>
    </div>
    <div class="card-body">

        <label for="institution_name_ed">Institution Name</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-university"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Institution Name" id="institution_name_ed"
                   value="<?php echo $instr['name']; ?>">
        </div>

        <label for="institution_address_ed">Address</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-address-book-o"></i> </span>
            </div>
            <textarea class="form-control" placeholder="Enter Address"
                      id="institution_address_ed"><?php echo $instr['address'] ?></textarea>
        </div>

        <label for="institution_location_ed">Location</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-map-marker"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Location" id="institution_location_ed"
                   value="<?php echo $instr['location'] ?>">
        </div>

        <label for="institution_telephone_ed">Telephone</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-phone-square"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Telephone" id="institution_telephone_ed"
                   value="<?php echo $instr['telephone'] ?>">
        </div>

        <label for="institution_email_ed">Email Address</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-envelope-open"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Email Address" id="institution_email_ed"
                   value="<?php echo $instr['email_address'] ?>">
        </div>

        <label for="institution_motto_ed">School Motto</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-graduation-cap"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter School Motto" id="institution_motto_ed"
                   value="<?php echo $instr['motto'] ?>">
        </div>

        <label for="update_institution_logo">School Logo</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-file-image-o"></i> </span>
            </div>
            <input type="text" class="form-control" id="update_institution_logo">

            <input type="hidden" id="selected_file"/>
            <input type="hidden" id="selected_img_edit" value="edit_img"/>

        </div>
        <p></p>
        <img src="<?php echo $instr['logofile'] ?>" style="width: 25%;height: 25%"/>
        <p></p>

        <div class="input-group-append mb-3">
            <button class="btn btn-primary" type="submit" id="btn_update_institution">Update</button>
        </div>


    </div>
</div>


<script>

    $("#update_institution_logo").uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload New Logo',
        'fileType': 'image/*',
        'multi': true,
        'width': 180,
        'formData': {'randno': '<?php echo $randomid?>'},
        'dnd': false,
        'uploadScript': 'ajax/queries/upload_institution_logo.php',
        'onUploadComplete': function (file, data) {
            console.log(data);
        },
        'onSelect': function (file) {
            // Update selected so we know they have selected a file
            $("#selected_file").val('yes');

        },
        'onCancel': function (file) {
            // Update selected so we know they have no file selected
            $("#selected_file").val('');
        }
    });


    $("#btn_update_institution").click(function () {

        var institution_name = $("#institution_name_ed").val();
        var institution_address = $("#institution_address_ed").val();
        var institution_location = $("#institution_location_ed").val();
        var institution_telephone = $("#institution_telephone_ed").val();
        var institution_email = $("#institution_email_ed").val();
        var institution_motto = $("#institution_motto_ed").val();
        var random_id = '<?php echo $randomid ?>';


        var error = '';


        if (institution_name == "") {
            error += 'Please enter institution name\n';
            $("#institution_name_ed").focus();
        }

        if (institution_address == "") {
            error += 'Please enter address \n';
            $("#institution_address_ed").focus();
        }

        if (institution_location == "") {
            error += 'Please enter location \n';
            $("#institution_location_ed").focus();
        }

        if (institution_telephone == "") {
            error += 'Please enter telephone \n';
            $("#institution_telephone_ed").focus();
        }

        if (institution_email == "") {
            error += 'Please enter email address \n';
            $("#institution_email_ed").focus();
        }

        if (!institution_email.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
            error += 'Please enter valid email \n';
            $("#institution_email_ed").focus();

        }

        if (institution_motto == "") {
            error += 'Please enter motto \n';
            $("#institution_motto_ed").focus();
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_institution.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/images/load.gif"/>'
                    });
                },
                data: {

                    institution_name: institution_name,
                    institution_address: institution_address,
                    institution_location: institution_location,
                    institution_telephone: institution_telephone,
                    institution_email: institution_email,
                    institution_motto: institution_motto,
                    random_id: random_id

                },
                success: function (text) {


                    //alert(text);


                    var selected_file = $("#selected_file").val();
                    var selected_img_edit = $("#selected_img_edit").val();


                    if (selected_file == 'yes' || selected_img_edit == 'edit_img') {

                        $('#update_institution_logo').uploadifive('upload');


                        $.notify("Institution Saved", "success", {position: "top center"});


                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/config_institution_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#institution_form_div').html(text);
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
                            url: "ajax/tables/config_institution_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#institution_table_div').html(text);
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

                        $.notify("Please select a file to upload", {position: "top left"});

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

