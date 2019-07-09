<?php include('../dbcon.php'); ?>



<div class="hr hr32 hr-dotted"></div>


<form class="form-horizontal" id="validation-form" name="pass_form"
      method="post" enctype="multipart/form-data" autocomplete="off">


    <div class="form-group">

        <label
            class="control-label col-xs-12 col-sm-4">Old Password:</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix">
                <input type="password" id="old_password"
                       class="col-xs-12 col-sm-8"
                    />
            </div>
        </div>

    </div>

    <div class="form-group">

        <label
            class="control-label col-xs-12 col-sm-4">New Password:</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix">
                <input type="password" id="new_password"
                       class="col-xs-12 col-sm-8"
                    />
            </div>
        </div>


    </div>


    <div class="form-group">

        <label
            class="control-label col-xs-12 col-sm-4">Confirm Password:</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix">
                <input type="password" id="confirm_password"
                       class="col-xs-12 col-sm-8"
                    />
            </div>
        </div>

    </div>

   
    <div class="space-2"></div>


    <div class="clearfix form-actions">
        <div class="col-md-offset-5 col-md-6">
            <button class="btn btn-info btn-sm btn-primary btn-white btn-round" type="button" id="save_pass_btn">
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





    $('#save_pass_btn').click(function () {

        var old_password = $('#old_password').val();
        var new_password = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();


        var error = '';


        if (old_password == "") {
            error += 'Please enter old password \n';
            document.pass_form.old_password.focus();
        }

        if (new_password == "") {
            error += 'Please enter new password \n';
            document.pass_form.new_password.focus();
        }

        if (new_password.length < 5) {
            error += 'Password must exceed 4 characters \n';
            document.pass_form.new_password.focus();
        }

        if (new_password != confirm_password) {
            error += 'Passwords do not match \n';
            document.pass_form.confirm_password.focus();
        }


        if (error == "") {

            $.ajax({
                type: "POST",
                url: "ajax/savepassword.php",
                data: {
                    old_password: old_password,
                    new_password: new_password

                },

                success: function (text) {

                    if (text == 1){


                        swal("Submitted!", "Password Changed", "success");

                    }

                    else {

                        swal("Sorry! Wrong Password", "", "error");
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


