<?php include('../dbcon.php');

@session_start();

?>


<div id="success_loc"></div>

<div class="widget-box">


    <div class="widget-body">


        <div class="widget-main">


            <div id="fuelux-wizard-container">
                <div>
                    <ul class="steps">
                        <li data-step="1" class="active">
                            <span class="step">1</span>
                            <span class="title">Personal Details</span>
                        </li>

                        <li data-step="2">
                            <span class="step">2</span>
                            <span class="title">Academics</span>
                        </li>


                    </ul>
                </div>

                <hr/>


                <div class="step-content pos-rel">
                    <div class="step-pane active" data-step="1">
                        <h5 class="lighter block green">Field marked * are
                            required</h5>


                        <form class="form-horizontal" id="validation-form"
                              method="post" enctype="multipart/form-data" autocomplete="off">

                            <?php $todate = date("Y-m-d");
                            $random_id = rand(1, 1000000) . $todate ?>
                            <input type="hidden" id="student_id" value="<?php echo $random_id;; ?>"/>


                            <div class="form-group">
                                <label
                                    class="control-label col-xs-12 col-sm-2 no-padding-right">Surname
                                    *:</label>

                                <div class="col-xs-12 col-sm-4">
                                    <div class="clearfix">
                                        <input type="text" id="surname"
                                               name="surname"
                                               class="col-xs-12 col-sm-12"/>
                                    </div>
                                </div>

                                <label
                                    class="control-label col-xs-12 col-sm-2 no-padding-right">First name
                                    *:</label>

                                <div class="col-xs-12 col-sm-4">
                                    <div class="clearfix">
                                        <input type="text" id="firstname"
                                               name="firstname"
                                               class="col-xs-12 col-sm-12"/>
                                    </div>
                                </div>


                            </div>


                            <div class="space-2"></div>

                            <div class="form-group">
                                <label
                                    class="control-label col-xs-12 col-sm-2 no-padding-right">Other Name(s)
                                    :</label>

                                <div class="col-xs-12 col-sm-4">
                                    <div class="clearfix">
                                        <input type="text" id="othername"
                                               name="othername"
                                               class="col-xs-12 col-sm-12"/>
                                    </div>
                                </div>


                                <label
                                    class="control-label col-xs-12 col-sm-2 no-padding-right">Gender
                                    *:</label>

                                <div class="col-xs-12 col-sm-4">
                                    <div class="clearfix">
                                        <select id="gender"
                                                name="gender"
                                                class="select2"
                                                data-placeholder="Click to Choose..."
                                                style="width: 80%">
                                            <option value="">&nbsp;</option>
                                            <option value="Male">Male
                                            </option>
                                            <option value="Female">Female
                                            </option>

                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="space-2"></div>

                            <div class="form-group">
                                <label
                                    class="control-label col-xs-12 col-sm-2 no-padding-right">House
                                    :</label>

                                <div class="col-xs-12 col-sm-4">
                                    <div class="clearfix">
                                        <input type="text" id="house"
                                               name="house"
                                               class="col-xs-12 col-sm-12"/>
                                    </div>
                                </div>


                                <label
                                    class="control-label col-xs-12 col-sm-2 no-padding-right">Image
                                    *:</label>

                                <div class="col-xs-12 col-sm-4">
                                    <div class="clearfix">
                                        <input type="file" id="student_image"
                                               name="image"
                                               class="col-xs-12 col-sm-12"/>
                                    </div>
                                </div>
                            </div>


                        </form>

                    </div>

                    <div class="step-pane" data-step="2">
                        <div>

                            <form class="form-horizontal" id="validation-form_2"
                                  method="post" enctype="multipart/form-data" autocomplete="off">


                                <div class="form-group">
                                    <label
                                        class="control-label col-xs-12 col-sm-2 no-padding-right">Class
                                        *:</label>

                                    <div class="col-xs-12 col-sm-4">
                                        <div class="clearfix">
                                            <select class="select2" data-placeholder="Click to Choose..."
                                                    id="student_class"
                                                    name="student_class"
                                                    style="width: 80%">
                                                <option value=""></option>


                                                <?php $que = $mysqli->query("select * from department order by id");

                                                while ($fet = $que->fetch_assoc()) {

                                                    ?>


                                                    <optgroup label="<?php echo $dept =  $fet['name'] ?>">

                                                        <?php
                                                        $que_sub = $mysqli->query("select * from class where department = '$dept'");

                                                        while ($fet_sub = $que_sub->fetch_assoc()) {
                                                            ?>

                                                            <option value="<?php echo $fet_sub['name'] ?>"><?php echo $fet_sub['name'] ?></option>


                                                            <?php
                                                        }
                                                        ?>

                                                    </optgroup>

                                                    <?php
                                                }
                                                ?>


                                            </select>
                                        </div>
                                    </div>

                                    <label
                                        class="control-label col-xs-12 col-sm-2 no-padding-right">Assign Course
                                        *:</label>

                                    <div class="col-xs-12 col-sm-4">
                                        <div class="clearfix">
                                            <select
                                                id="course_class"
                                                name="course_class[]"
                                                class="select2"
                                                data-placeholder="Click to Select Course(s)..."
                                                style="width: 200%"
                                                multiple required>
                                                <option
                                                    value="">
                                                    &nbsp;</option>
                                                <option>
                                                    All Courses in Class
                                                </option>
                                                <?php
                                                $cl_name = $mysqli->query("SELECT DISTINCT(course) FROM course_class ORDER BY course");
                                                while ($row=$cl_name->fetch_assoc()) {
                                                    ?>
                                                    <?php echo '<option value="' . $row['course'] . '"';

                                                    echo '> ' . $row['course'] . '</option>';
                                                    //   echo $row['sign_name'];
                                                    ?>


                                                    <?php

                                                }
                                                ?>


                                            </select>
                                        </div>
                                    </div>


                                </div>

                                <div class="space-2"></div>

                                <div class="form-group">
                                    <label
                                        class="control-label col-xs-12 col-sm-2 no-padding-right">Student ID
                                        :</label>

                                    <div class="col-xs-12 col-sm-4">
                                        <div class="clearfix">
                                            <input type="text" id="stud_id"
                                                   class="col-xs-12 col-sm-12"/>
                                        </div>
                                    </div>

                                    </div>


                            </form>
                        </div>
                    </div>

                </div>


            </div>


            <hr/>
            <div class="wizard-actions">
                <button class="btn btn-prev">
                    <i class="ace-icon fa fa-arrow-left"></i>
                    Prev
                </button>

                <button class="btn btn-success btn-next" data-last="Finish">
                    Continue
                    <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                </button>
            </div>


        </div>


        <!-- /.widget-main -->
    </div>


    <!-- /.widget-body -->
</div>


<script type="text/javascript">
    jQuery(function ($) {


        $('[data-rel=tooltip]').tooltip();

        $(".select2").css('width', '200px').select2({allowClear: true})
            .on('change', function () {
                $(this).closest('form').validate().element($(this));
            });

        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });


        $('#student_image').uploadifive({
            'auto': false,
            'method': 'post',
            'buttonText': 'Upload Image',
            'width': 160,
            'formData': {'randno': '<?php echo $random_id?>'},
            'dnd': false,
            'uploadScript': 'ajax/uploadstudentimage.php',
            'onUploadComplete': function (file, data) {
                console.log(data);
            }
        });


        var $validation = false;
        var student_id = $('#student_id').val();


        $('#fuelux-wizard-container')
            .ace_wizard({
                //step: 2 //optional argument. wizard will jump to step "2" at first
                //buttons: '.wizard-actions:eq(0)'
            })


            .on('actionclicked.fu.wizard', function (e, info) {


                var surname = $('#surname').val();
                var firstname = $('#firstname').val();
                var lastname = $('#lastname').val();
                var othername = $('#othername').val();
                var gender = $('#gender').val();
                var house = $('#house').val();
                var student_class = $('#student_class').val();
                var course_class = $('#course_class').val();
                var stud_id = $('#stud_id').val();



                if (info.step == 1) {

                    if (!$('#validation-form').valid()) e.preventDefault();


                    var error = '';

                    if (surname == "") {
                        error += 'Please enter surname \n';
                    }
                    if (firstname == "") {
                        error += 'Please enter first name \n';
                    }

                    if (lastname == "") {
                        error += 'Please enter last name \n';
                    }
                    if (gender == "") {
                        error += 'Please select gender \n';
                    }
                    /* if (image == "") {
                     error += 'Please upload image \n';
                     }*/

                    if (error == "") {


                        $.notify("Details Entered","info")


                    }
                    else {

                        $.notify(error, {position: "top center"});


                    }

                }

            })
            .on('finished.fu.wizard', function (e) {
                e.preventDefault();


                var surname = $('#surname').val();
                var firstname = $('#firstname').val();
                var lastname = $('#lastname').val();
                var othername = $('#othername').val();
                var gender = $('#gender').val();
                var house = $('#house').val();
                var student_class = $('#student_class').val();
                var course_class = $('#course_class').val();
                var stud_id = $('#stud_id').val();


                var error2 = '';

                if (course_class == "") {
                    error2 += 'Please select class \n';
                }



                if (error2 == "") {


                    $.ajax({
                        type: "POST",
                        url: "ajax/savestudentdetails.php",
                        data: {

                            surname: surname,
                            firstname: firstname,
                            othername: othername,
                            gender: gender,
                            house: house,
                            course_class:course_class,
                            student_class:student_class,
                            student_id: student_id,
                            stud_id:stud_id



                        },
                        success: function (text) {

                            swal("Submitted!", "Student Info Saved", "success");

                            $.ajax({
                                url: "ajax/add_new_student.php",
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


                    $('#student_image').uploadifive('upload');

                }
                else {

                    $.notify(error2, {position: "top center"});


                }


            }).on('stepclick.fu.wizard', function (e) {
                //e.preventDefault();//this will prevent clicking and selecting steps
            });


        //jump to a step
        /**
         var wizard = $('#fuelux-wizard-container').data('fu.wizard')
         wizard.currentStep = 3;
         wizard.setState();
         */

            //determine selected step
            //wizard.selectedItem().step


            //hide or show the other form which requires validation
            //this is for demo only, you usullay want just one form in your application
        $('#skip-validation').removeAttr('checked').on('click', function () {
            $validation = this.checked;
            if (this.checked) {
                $('#sample-form').hide();
                $('#validation-form').removeClass('hide');
            }
            else {
                $('#validation-form').addClass('hide');
                $('#sample-form').show();
            }
        });

        $.mask.definitions['~'] = '[+-]';
        $('#phone').mask('(999) 999-9999');

        $.mask.definitions['~'] = '[+-]';
        $('#altphone').mask('(999) 999-9999');

        $('#dob').mask('9999-99-99');

        $('#date_bap').mask('9999-99-99');

        $('#date_join').mask('9999-99-99');


        $('#id-input-file-3').ace_file_input({
            style: 'well',
            btn_choose: 'Drop files here or click to choose',
            btn_change: null,
            no_icon: 'ace-icon fa fa-cloud-upload',
            droppable: true,
            thumbnail: 'small'//large | fit
            //,icon_remove:null//set null, to hide remove/reset button
            /**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
            /**,before_remove : function() {
						return true;
					}*/
            ,
            preview_error: function (filename, error_code) {
                //name of the file that failed
                //error_code values
                //1 = 'FILE_LOAD_FAILED',
                //2 = 'IMAGE_LOAD_FAILED',
                //3 = 'THUMBNAIL_FAILED'
                //alert(error_code);
            }

        }).on('change', function () {
            //console.log($(this).data('ace_input_files'));
            //console.log($(this).data('ace_input_method'));
        });


        //documentation : http://docs.jquery.com/Plugins/Validation/validate


        jQuery.validator.addMethod("phone", function (value, element) {
            return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
        }, "Enter a valid phone number.");


        $('#validation-form_2').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            ignore: "",
            rules: {
                student_class: {
                    required: true
                },

                agree: {
                    required: true
                }
            },

            messages: {
                email: {
                    required: "Please provide a valid email.",
                    email: "Please provide a valid email."
                },
                password: {
                    required: "Please specify a password.",
                    minlength: "Please specify a secure password."
                },
                state: "Please choose state",
                subscription: "Please choose at least one option",
                gender: "Please choose gender",
                agree: "Please accept our policy"
            },


            highlight: function (e) {
                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
            },

            success: function (e) {
                $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                $(e).remove();
            },

            errorPlacement: function (error, element) {
                if (element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                    var controls = element.closest('div[class*="col-"]');
                    if (controls.find(':checkbox,:radio').length > 1) controls.append(error);
                    else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                }
                else if (element.is('.select2')) {
                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                }
                else if (element.is('.chosen-select')) {
                    error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                }
                else error.insertAfter(element.parent());
            },

            submitHandler: function (form) {
            },
            invalidHandler: function (form) {
            }
        });


        $('#validation-form').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            ignore: "",
            rules: {

                firstname: {
                    required: true,
                    minlength: 2
                },
                surname: {
                    required: true,
                    minlength: 2
                },


                gender: {
                    required: true
                },

                email: {
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                },
                password2: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                name: {
                    required: true
                },
                phone: {
                    required: true,
                    phone: 'required'
                },
                url: {
                    required: true,
                    url: true
                },
                comment: {
                    required: true
                },
                state: {
                    required: true
                },
                platform: {
                    required: true
                },
                subscription: {
                    required: true
                },

                agree: {
                    required: true,
                }
            },

            messages: {
                email: {
                    required: "Please provide a valid email.",
                    email: "Please provide a valid email."
                },
                password: {
                    required: "Please specify a password.",
                    minlength: "Please specify a secure password."
                },
                state: "Please choose state",
                subscription: "Please choose at least one option",
                gender: "Please choose gender",
                agree: "Please accept our policy"
            },


            highlight: function (e) {
                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
            },

            success: function (e) {
                $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                $(e).remove();
            },

            errorPlacement: function (error, element) {
                if (element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                    var controls = element.closest('div[class*="col-"]');
                    if (controls.find(':checkbox,:radio').length > 1) controls.append(error);
                    else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                }
                else if (element.is('.select2')) {
                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                }
                else if (element.is('.chosen-select')) {
                    error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                }
                else error.insertAfter(element.parent());
            },

            submitHandler: function (form) {
            },
            invalidHandler: function (form) {
            }
        });


        $('#modal-wizard-container').ace_wizard();
        $('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');


        /**
         $('#date').datepicker({autoclose:true}).on('changeDate', function(ev) {
					$(this).closest('form').validate().element($(this));
				});

         $('#mychosen').chosen().on('change', function(ev) {
					$(this).closest('form').validate().element($(this));
				});
         */


        $(document).one('ajaxloadstart.page', function (e) {
            //in ajax mode, remove remaining elements before leaving page
            $('[class*=select2]').remove();
        });


    })
</script>