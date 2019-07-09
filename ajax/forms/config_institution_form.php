<?php $random = rand(1, 100) . date("Y-m-d"); ?>
<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Enter Institution Details</h5>
        <h6 class="card-subtitle"> All fields are required</h6>
    </div>
    <div class="card-body">

        <label for="institution_name">Institution Name</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-university"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Institution Name" id="institution_name">
        </div>

        <label for="institution_address">Address</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-address-book-o"></i> </span>
            </div>
            <textarea class="form-control" placeholder="Enter Address" id="institution_address"></textarea>
        </div>

        <label for="institution_location">Location</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-map-marker"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Location" id="institution_location">
        </div>

        <label for="institution_telephone">Telephone</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-phone-square"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Telephone" id="institution_telephone">
        </div>

        <label for="institution_email">Email Address</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-envelope-open"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Email Address" id="institution_email">
        </div>

        <label for="institution_motto">School Motto</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-graduation-cap"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter School Motto" id="institution_motto">
        </div>

        <label for="institution_logo">School Logo</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-file-image-o"></i> </span>
            </div>
            <input type="text" class="form-control" id="institution_logo">
            <input type="hidden" id="selected_file"/>
        </div>

        <div class="input-group-append mb-3">
            <button class="btn btn-primary" type="submit" id="btn_save_institution">Submit</button>
        </div>


    </div>
</div>


<script>

    $("#institution_logo").uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload Logo',
        'fileType': 'image/*',
        'multi': true,
        'width': 180,
        'formData': {'randno': '<?php echo $random?>'},
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


    $("#btn_save_institution").click(function () {

        var institution_name = $("#institution_name").val();
        var institution_address = $("#institution_address").val();
        var institution_location = $("#institution_location").val();
        var institution_telephone = $("#institution_telephone").val();
        var institution_email = $("#institution_email").val();
        var institution_motto = $("#institution_motto").val();
        var random_id = '<?php echo $random ?>';


        var error = '';


        if (institution_name == "") {
            error += 'Please enter institution name\n';
            $("#institution_name").focus();
        }

        if (institution_address == "") {
            error += 'Please enter address \n';
            $("#institution_address").focus();
        }

        if (institution_location == "") {
            error += 'Please enter location \n';
            $("#institution_location").focus();
        }

        if (institution_telephone == "") {
            error += 'Please enter telephone \n';
            $("#institution_telephone").focus();
        }

        if (institution_email == "") {
            error += 'Please enter email address \n';
            $("#institution_email").focus();
        }

        if (!institution_email.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
            error += 'Please enter valid email \n';
            $("#institution_email").focus();

        }

        if (institution_motto == "") {
            error += 'Please enter motto \n';
            $("#institution_motto").focus();
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
                    random_id:random_id

                },
                success: function (text) {


                    var selected_file = $("#selected_file").val();


                    if (selected_file == 'yes') {

                        $('#institution_logo').uploadifive('upload');


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

                        $.notify("Please select a file to upload",{position: "top left"});

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
