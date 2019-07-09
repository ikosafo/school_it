<?php include('../dbcon.php');

$get = $mysqli->query("select * from institution LIMIT 1");
$res = $get->fetch_assoc();

?>
<div class="hr hr32 hr-dotted"></div>

<h6 style="font-family: verdana;font-weight: 800">
    INSTITUTION DETAILS
</h6>


<form class="form-horizontal" id="validation-form" name="details_form"
      method="post" enctype="multipart/form-data" autocomplete="off">

    <?php $todate = date("Y-m-d");
    $random_id = rand(1, 1000000) . $todate ?>
    <input type="hidden" id="inst_id" value="<?php echo $random_id;; ?>"/>


    <div class="form-group">
        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">Name *:</label>

        <div class="col-xs-6 col-sm-4">
            <div class="clearfix">
                <input type="text" id="name"
                       name="name"
                       class="col-xs-12 col-sm-12"
                       value="<?php echo $res['name'] ?>"
                       
                    />
            </div>
        </div>

        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">Motto*:</label>

        <div class="col-xs-6 col-sm-4">
            <div class="clearfix">
                <input type="text" id="motto"
                       name="motto"
                       class="col-xs-12 col-sm-12"
                       value="<?php echo $res['motto'] ?>"
                       />

            </div>
        </div>


    </div>


    <div class="space-2"></div>

    <div class="form-group">

        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">Logo*:</label>

        <div class="col-xs-6 col-sm-4">
            <div class="clearfix">
                <span class="profile-picture">
    <img class="editable img-responsive" src="../<?php echo $res['logo'] ?>" id="avatar2"
         alt="" style="width: 100%">
															</span>
            </div>


                    <input type="text" id="logo"
                           name="image"
                           class="col-xs-12 col-sm-12"/>

        </div>

        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">Country*:</label>

        <div class="col-xs-6 col-sm-4">
            <div class="clearfix">
                <input type="text" id="country"
                       name="country"
                       class="col-xs-12 col-sm-12"
                       value="<?php echo $res['country'] ?>"
                       />
            </div>
        </div>

    </div>


    <div class="space-2"></div>

    <div class="form-group">

        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">City*:</label>

        <div class="col-xs-6 col-sm-4">
            <div class="clearfix">
                <input type="text" id="city"
                       name="city"
                       class="col-xs-12 col-sm-12"
                       value="<?php echo $res['city'] ?>"
                       />
            </div>
        </div>

        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">State*:</label>

        <div class="col-xs-6 col-sm-4">
            <div class="clearfix">
                <input type="text" id="state"
                       name="state"
                       class="col-xs-12 col-sm-12"
                       value="<?php echo $res['state'] ?>"
                       />
            </div>
        </div>

    </div>

    <div class="space-2"></div>

    <div class="form-group">

        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">Mobile*:</label>

        <div class="col-xs-6 col-sm-4">
            <div class="clearfix">
                <input type="text" id="mobile"
                       name="mobile"
                       class="col-xs-12 col-sm-12"
                       value="<?php echo $res['mobile'] ?>"
                       />
            </div>
        </div>

        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">Alt. Mobile:</label>

        <div class="col-xs-6 col-sm-4">
            <div class="clearfix">
                <input type="text" id="alt_mobile"
                       name="alt_mobile"
                       class="col-xs-12 col-sm-12"
                       value="<?php echo $res['altmobile'] ?>"
                       />
            </div>
        </div>

    </div>

    <div class="space-2"></div>

    <div class="form-group">

        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">Telephone:</label>

        <div class="col-xs-6 col-sm-4">
            <div class="clearfix">
                <input type="text" id="telephone"
                       name="telephone"
                       class="col-xs-12 col-sm-12"
                       value="<?php echo $res['telephone'] ?>"
                       />
            </div>
        </div>

        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">Email:</label>

        <div class="col-xs-6 col-sm-4">
            <div class="clearfix">
                <input type="text" id="email"
                       name="email"
                       class="col-xs-12 col-sm-12"
                       value="<?php echo $res['email'] ?>"
                       />
            </div>
        </div>

    </div>


    <div class="space-2"></div>

    <div class="form-group">

        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">Address*:</label>

        <div class="col-xs-6 col-sm-4">
            <div class="clearfix">
                <input type="text" id="address"
                       name="address"
                       class="col-xs-12 col-sm-12"
                       value="<?php echo $res['address'] ?>"
                    />
            </div>
        </div>

        <label
            class="control-label col-xs-6 col-sm-2 no-padding-right">Signature*:</label>

        <div class="col-xs-6 col-sm-4">
            <div class="clearfix">
                <span class="profile-picture">
    <img class="editable img-responsive" src="../<?php echo $res['signature'] ?>" id="avatar2"
         alt="" style="width: 100%">
															</span>
            </div>


            <input type="text" id="signature"
                   name="signature"
                   class="col-xs-12 col-sm-12"/>

        </div>


    </div>



    <div class="space-2"></div>


    <div class="clearfix form-actions">
        <div class="col-md-offset-5 col-md-6">

                <button class="btn btn-info btn-sm btn-primary btn-white btn-round" type="button" id="edit_school">
                    <i class="ace-icon fa fa-save bigger-110"></i>
                    Edit
                </button>


        </div>
    </div>


</form>


<script>


    $('#logo').uploadifive({
        'auto'             : false,
        'method'           : 'post',
        'buttonText'       : 'Upload New Logo',
        'width'            : 160,
        'formData'         : {'randno':'<?php echo $res['logo']?>'},
        'dnd'              : false,
        'uploadScript'     : 'ajax/uploadlogoedit.php',
        'onUploadComplete' : function(file, data) { console.log(data); }
    });


    $('#signature').uploadifive({
        'auto'             : false,
        'method'           : 'post',
        'buttonText'       : 'Upload New Signature',
        'width'            : 160,
        'formData'         : {'randno':'<?php echo $res['logo']?>'},
        'dnd'              : false,
        'uploadScript'     : 'ajax/uploadsignatureedit.php',
        'onUploadComplete' : function(file, data) { console.log(data); }
    });



    $('.select2').css('width','200px').select2({allowClear:true})
    $('#select2-multiple-style .btn').on('click', function(e){
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        if(which == 2) $('.select2').addClass('tag-input-style');
        else $('.select2').removeClass('tag-input-style');
    });

    $.mask.definitions['~'] = '[+-]';
    $('#mobile').mask('(999) 999-9999');

    $.mask.definitions['~'] = '[+-]';
    $('#alt_mobile').mask('(999) 999-9999');

    $.mask.definitions['~'] = '[+-]';
    $('#telephone').mask('(999) 999-9999');



    $('#edit_school').click(function () {

        var name = $('#name').val();
        var motto = $('#motto').val();
        var country = $('#country').val();
        var city = $('#city').val();
        var state = $('#state').val();
        var mobile = $('#mobile').val();
        var alt_mobile = $('#alt_mobile').val();
        var telephone = $('#telephone').val();
        var email = $('#email').val();
        var inst_id = $('#inst_id').val();
        var address = $('#address').val();


        var error = '';

        if (name == "") {
            error += 'Please select name of institution \n';
            document.details_form.name.focus();
        }
        if (motto == "") {
            error += 'Please enter motto \n';
            document.details_form.motto.focus();
        }
        if (city == "") {
            error += 'Please enter city \n';
            document.details_form.city.focus();
        }
        if (state == "") {
            error += 'Please enter state \n';
            document.details_form.state.focus();
        }
        if (mobile == "") {
            error += 'Please enter mobile number \n';
            document.details_form.mobile.focus();
        }
        if (!email.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
            error += 'Please enter valid email \n';
            document.details_form.email.focus();
        }


        if (error == "") {

            $.ajax({
                type: "POST",
                url: "ajax/editschool.php",
                data: {
                    name: name,
                    motto: motto,
                    country: country,
                    city: city,
                    state: state,
                    mobile: mobile,
                    alt_mobile: alt_mobile,
                    telephone: telephone,
                    email: email,
                    inst_id: inst_id,
                    address:address

                },

                success: function (text) {

                    swal("Submitted!", "Institution Details Updated", "success");


                    $.ajax({
                        url: "ajax/institution_detail.php",
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
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },

            });


            $('#logo').uploadifive('upload');

            $('#signature').uploadifive('upload');



        }
        else {

            $.notify(error, {position: "top center"});


        }
        return false;
    });


</script>

