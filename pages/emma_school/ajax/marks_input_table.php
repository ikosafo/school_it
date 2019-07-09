<?php include('../dbcon.php');

$date = date("Y-m-d");


$sess = $mysqli->query("select * from `academic_session` where date_from <= '$date' AND date_to >= '$date'");
$res_ses = $sess->fetch_assoc();
$academic_year = $res_ses['year'];
$term = $res_ses['term'];


$count = mysqli_num_rows($sess);

if ($count == "0"){ ?>

    <script>
        swal("Session for this period does not exist","","error");
    </script>

<?php }

else {

    $course_class=mysqli_real_escape_string($mysqli,$_POST['course_class']);
    $course=mysqli_real_escape_string($mysqli,$_POST['course']);


    $qustud = $mysqli->query("select * from student where status is null and class='$course_class' ORDER BY lastname,firstname,othername");

    $chk = $mysqli->query("select * from `class` where name = '$course_class'");
    $chk_res = $chk->fetch_assoc();

    $get_dept = $chk_res['department'];


    $chk_mk = $mysqli->query("select * from assessment where department = '$get_dept'");
    $res_mk = $chk_mk->fetch_assoc();

    $c_score = $res_mk['class_score'];
    $e_score = $res_mk['exam_score'];


    ?>




    <table id="" class="table table-striped table-bordered table-hover dynamic-table">
        <thead>
        <tr>

            <th width="30%">Full Name</th>
            <th width="10%">Class Score</th>
            <th width="10%">Exam Score</th>
            <th width="10%">Total</th>
            <th width="15%">Grade</th>
            <th width="15%">Remark</th>
            <th width="10%">Action</th>

        </tr>
        </thead>

        <tbody>

        <?php
        while ($row = $qustud->fetch_assoc()) {

            $stud_id = $row['student_id'];

            $que = $mysqli->query("SELECT * FROM course WHERE student_id = '$stud_id' AND (course = '$course' OR course = 'All Courses in Class')");
            $count2 = mysqli_num_rows($que);

            if ($count2 == "0"){ ?>

                <tr style="font-size: small">

                    <td><b><?php echo $fullname = $row['lastname'] . ' ' . $row['firstname'] . ' ' . $row['othername']; ?></b></td>


                    <td colspan="6">
                        STUDENT IS NOT REGISTERED FOR THIS COURSE
                    </td>

                </tr>

            <?php    }

            else {

                $qu = $mysqli->query("select * from student_assessment where student_id = '$stud_id' and course = '$course'");
                $ru = $qu->fetch_assoc();

                $count = mysqli_num_rows($qu);

                if ($count == "0")

                {
                    $cred = $mysqli->query("select * from grading where mark_from <= '0' and mark_to >= '0' and department = '$get_dept'");
                    $get_cred = $cred->fetch_assoc();

                    $remark = $get_cred['remark'];
                    $grade = $get_cred['grade'];
                    $grade_display = $get_cred['grade_display'];


                    ?>



                    <tr style="font-size: small">


                        <td><b><?php echo $fullname = $row['lastname'] . ' ' . $row['firstname'] . ' ' . $row['othername']; ?></b></td>

                        <td>0.00</td>
                        <td>0.00</td>
                        <td>0.00</td>
                        <td><?php echo $grade_display; ?></td>
                        <td><?php echo $remark; ?></td>


                        <td style="font-size: small" align="center">
                            <a href="#" data-toggle="modal" data-target="#add_student_mark"
                               class="add_student_mark"
                               i_index="<?php echo $row['id']; ?>"
                               student_id="<?php echo $stud_id; ?>"
                               academic_year="<?php echo $academic_year; ?>"
                               term="<?php echo $term; ?>"
                               course_class="<?php echo $course_class; ?>"
                               course="<?php echo $course; ?>"
                               fullname="<?php echo $fullname; ?>"

                                > <i class="fa fa-plus-circle fa-2x"></i> </a>

                        </td>

                    </tr>



                <?php      }

                else { ?>

                    <tr style="font-size: small">


                        <td><b><?php echo $fullname = $row['lastname'] . ' ' . $row['firstname'] . ' ' . $row['othername']; ?></b></td>

                        <td><?php echo $ru['class_score']; ?></td>
                        <td><?php echo $ru['exam_score']; ?></td>
                        <td><?php echo $ru['total']; ?></td>
                        <td><?php echo $ru['grade_display']; ?></td>
                        <td><?php echo $ru['remark']; ?></td>


                        <td style="font-size: small" align="center">
                            <a href="#" data-toggle="modal" data-target="#edit_student_mark"
                               class="edit_student_mark"
                               e_i_index="<?php echo $ru['id']; ?>"
                               e_student_id="<?php echo $stud_id; ?>"
                               e_academic_year="<?php echo $academic_year; ?>"
                               e_term="<?php echo $term; ?>"
                               e_course_class="<?php echo $course_class; ?>"
                               e_course="<?php echo $course; ?>"
                               e_fullname="<?php echo $fullname; ?>"

                                > <i class="fa fa-edit fa-2x"></i> </a>

                        </td>

                    </tr>

                <?php  }



            }


        }
        ?>

        </tbody>
    </table>


<?php }  ?>


<div id="add_student_mark" class="modal fade" tabindex="-1">
    <div class="modal-dialog" id="error_loc_mark">
        <form method="post" action="" name="add_mark_form" id="add_mark_form" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">Please fill the following form fields</h4>
                </div>

                <div class="modal-body" id="add_mark_body">


                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>

                    <button class="btn btn-sm btn-primary" type="submit" id="add_mark_btn">
                        <i class="ace-icon fa fa-plus-circle"></i>
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<div id="edit_student_mark" class="modal fade" tabindex="-1">
    <div class="modal-dialog" id="error_loc_mark_edit">
        <form method="post" action="" name="edit_mark_form" id="edit_mark_form" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">Please fill the following form fields</h4>
                </div>

                <div class="modal-body" id="edit_mark_body">


                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>

                    <button class="btn btn-sm btn-primary" type="button" id="edit_mark_btn">
                        <i class="ace-icon fa fa-edit"></i>
                        Edit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>




<script type="text/javascript">
    jQuery(function ($) {
        //initiate dataTables plugin
        var oTable1 =
            $('.dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                        {"bSortable": false},
                        null, null, null, null, null,
                        {"bSortable": false}
                    ],
                    "aaSorting": [],

                    //,
                    "sScrollY": "200px",
                    "bPaginate": false,

                    "sScrollXInner": "120%",
                    "bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                    //"iDisplayLength": 50
                });
        oTable1.fnAdjustColumnSizing();


        //TableTools settings
        TableTools.classes.container = "btn-group btn-overlap";
        TableTools.classes.print = {
            "body": "DTTT_Print",
            "info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
            "message": "tableTools-print-navbar"
        }

        //initiate TableTools extension
        var tableTools_obj = new $.fn.dataTable.TableTools(oTable1, {
            "sSwfPath": "assets/swf/copy_csv_xls_pdf.swf",

            "sRowSelector": "td:not(:last-child)",
            "sRowSelect": "multi",
            "fnRowSelected": function (row) {
                //check checkbox when row is selected
                try {
                    $(row).find('input[type=checkbox]').get(0).checked = true
                }
                catch (e) {
                }
            },
            "fnRowDeselected": function (row) {
                //uncheck checkbox
                try {
                    $(row).find('input[type=checkbox]').get(0).checked = false
                }
                catch (e) {
                }
            },

            "sSelectedClass": "success",
            "aButtons": [
                {
                    "sExtends": "copy",
                    "sToolTip": "Copy to clipboard",
                    "sButtonClass": "btn btn-white btn-primary btn-bold",
                    "sButtonText": "<i class='fa fa-copy bigger-110 pink'></i>",
                    "fnComplete": function () {
                        this.fnInfo('<h3 class="no-margin-top smaller">Table copied</h3>\
									<p>Copied ' + (oTable1.fnSettings().fnRecordsTotal()) + ' row(s) to the clipboard.</p>',
                            1500
                        );
                    }
                },

                {
                    "sExtends": "csv",
                    "sToolTip": "Export to CSV",
                    "sButtonClass": "btn btn-white btn-primary  btn-bold",
                    "sButtonText": "<i class='fa fa-file-excel-o bigger-110 green'></i>"
                },

                {
                    "sExtends": "pdf",
                    "sToolTip": "Export to PDF",
                    "sButtonClass": "btn btn-white btn-primary  btn-bold",
                    "sButtonText": "<i class='fa fa-file-pdf-o bigger-110 red'></i>"
                },

                {
                    "sExtends": "print",
                    "sToolTip": "Print view",
                    "sButtonClass": "btn btn-white btn-primary  btn-bold",
                    "sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",

                    "sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Optional Navbar &amp; Text</small></a></div></div>",

                    "sInfo": "<h3 class='no-margin-top'>Print view</h3>\
									  <p>Please use your browser's print function to\
									  print this table.\
									  <br />Press <b>escape</b> when finished.</p>",
                }
            ]
        });
        //we put a container before our table and append TableTools element to it
        $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));

        //also add tooltips to table tools buttons
        //addding tooltips directly to "A" buttons results in buttons disappearing (weired! don't know why!)
        //so we add tooltips to the "DIV" child after it becomes inserted
        //flash objects inside table tools buttons are inserted with some delay (100ms) (for some reason)
        setTimeout(function () {
            $(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function () {
                var div = $(this).find('> div');
                if (div.length > 0) div.tooltip({container: 'body'});
                else $(this).tooltip({container: 'body'});
            });
        }, 200);


        //ColVis extension
        var colvis = new $.fn.dataTable.ColVis(oTable1, {
            "buttonText": "<i class='fa fa-search'></i>",
            "aiExclude": [0, 6],
            "bShowAll": true,
            //"bRestore": true,
            "sAlign": "right",
            "fnLabel": function (i, title, th) {
                return $(th).text();//remove icons, etc
            }

        });

        //style it
        $(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')

        //and append it to our table tools btn-group, also add tooltip
        $(colvis.button())
            .prependTo('.tableTools-container .btn-group')
            .attr('title', 'Show/hide columns').tooltip({container: 'body'});

        //and make the list, buttons and checkboxed Ace-like
        $(colvis.dom.collection)
            .addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
            .find('li').wrapInner('<a href="javascript:void(0)" />') //'A' tag is required for better styling
            .find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');


        /////////////////////////////////
        //table checkboxes
        $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

        //select/deselect all rows according to table header checkbox
        $('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function () {
            var th_checked = this.checked;//checkbox inside "TH" table header

            $(this).closest('table').find('tbody > tr').each(function () {
                var row = this;
                if (th_checked) tableTools_obj.fnSelect(row);
                else tableTools_obj.fnDeselect(row);
            });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#dynamic-table').on('click', 'td input[type=checkbox]', function () {
            var row = $(this).closest('tr').get(0);
            if (!this.checked) tableTools_obj.fnSelect(row);
            else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
        });


        $(document).on('click', '#dynamic-table .dropdown-toggle', function (e) {
            e.stopImmediatePropagation();
            e.stopPropagation();
            e.preventDefault();
        });


        //And for the first simple table, which doesn't have TableTools or dataTables
        //select/deselect all rows according to table header checkbox
        var active_class = 'active';
        $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function () {
            var th_checked = this.checked;//checkbox inside "TH" table header

            $(this).closest('table').find('tbody > tr').each(function () {
                var row = this;
                if (th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
            });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#simple-table').on('click', 'td input[type=checkbox]', function () {
            var $row = $(this).closest('tr');
            if (this.checked) $row.addClass(active_class);
            else $row.removeClass(active_class);
        });


        /********************************/
        //add tooltip for small view action buttons in dropdown menu
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

        //tooltip placement on right or left
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            //var w2 = $source.width();

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
            return 'left';
        }

    })
</script>


<script>


    $(document).on('click', '.add_student_mark', function () {

        var theindex = $(this).attr('i_index');
        var student_id = $(this).attr('student_id');
        var academic_year = $(this).attr('academic_year');
        var term = $(this).attr('term');
        var course_class = $(this).attr('course_class');
        var course = $(this).attr('course');
        var student_name = $(this).attr('fullname');


        $.ajax({
            type: "POST",
            url: "ajax/add_student_mark.php",
            data: {

                theindex: theindex,
                student_id:student_id,
                academic_year:academic_year,
                term:term,
                course:course,
                course_class:course_class,
                fullname:student_name
            },
            beforeSend: function () {
                $.blockUI({
                    message: '<h3><img src="../busy.gif" /> Please Wait...</h3>'
                });
            },
            success: function (text) {
                $('#add_mark_body').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },
        });

    });


    $(document).on('click', '.edit_student_mark', function () {

        var theindex = $(this).attr('e_i_index');
        var student_id = $(this).attr('e_student_id');
        var academic_year = $(this).attr('e_academic_year');
        var term = $(this).attr('e_term');
        var course_class = $(this).attr('e_course_class');
        var course = $(this).attr('e_course');
        var student_name = $(this).attr('e_fullname');



        $.ajax({
            type: "POST",
            url: "ajax/edit_student_mark.php",
            data: {

                theindex: theindex,
                student_id:student_id,
                academic_year:academic_year,
                term:term,
                course:course,
                course_class:course_class,
                fullname:student_name
            },
            beforeSend: function () {
                $.blockUI({
                    message: '<h3><img src="../busy.gif" /> Please Wait...</h3>'
                });
            },
            success: function (text) {
                $('#edit_mark_body').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },
        });

    });






    $('#add_mark_btn').click(function () {


        var student_id = $('#student_id').val();
        var academic_year = $('#academic_year').val();
        var term = $('#term').val();
        var course = $('#course').val();
        var course_class = $('#course_class').val();
        var class_score = $('#class_score').val();
        var exam_score = $('#exam_score').val();
        var department  = '<?php echo $get_dept; ?>';

        var c_class = '<?php echo $c_score; ?>';
        var e_class = '<?php echo $e_score; ?>';


        var error = '';


        if (class_score == "") {
            error += 'Please enter class score \n';
            document.add_mark_form.class_score.focus();
        }

        if (exam_score == "") {
            error += 'Please enter exam score \n';
            document.add_mark_form.exam_score.focus();
        }

        if (class_score > c_class) {
            error += 'Class score exceeded \n';
            document.add_mark_form.class_score.focus();
        }

        if (exam_score > e_class) {
            error += 'Exam score exceeded \n';
            document.add_mark_form.exam_score.focus();
        }


        if (error == "") {

            $.ajax({
                type: "POST",
                url: "ajax/savestudentassessment.php",
                data: {

                    class_score: class_score,
                    exam_score: exam_score,
                    student_id:student_id,
                    academic_year:academic_year,
                    term:term,
                    course:course,
                    course_class:course_class,
                    department:department

                },
                success: function (text) {

                    swal("Submitted!", "Mark Saved", "success");

                    $.ajax({
                        type: "POST",
                        url: "ajax/marks_input_table.php",
                        data: {

                            course: course,
                            course_class: course_class

                        },
                        success: function (text) {

                            $('#marks_here').html(text);

                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },

                    });



                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },

            });


        }
        else {

            $('#error_loc_mark').notify(error);


        }
        return false;
    });









    $('#edit_mark_btn').click(function () {


        var student_id = $('#student_id').val();
        var assessment_id = $('#assessment_id').val();
        var academic_year = $('#academic_year').val();
        var term = $('#term').val();
        var course = $('#course').val();
        var course_class = $('#course_class').val();
        var class_score_edit = $('#class_score_edit').val();
        var exam_score_edit = $('#exam_score_edit').val();
        var department  = '<?php echo $chk_res['department']; ?>';

        var c_class = '<?php echo $c_score; ?>';
        var e_class = '<?php echo $e_score; ?>';

        var error = '';

        if (class_score_edit == "") {
            error += 'Please enter class score \n';
            document.edit_mark_form.class_score_edit.focus();
        }

        if (exam_score_edit == "") {
            error += 'Please enter exam score \n';
            document.edit_mark_form.exam_score_edit.focus();
        }

        if (class_score_edit > c_class) {
            error += 'Class score exceeded \n';
            document.edit_mark_form.class_score_edit.focus();
        }

        if (exam_score_edit > e_class) {
            error += 'Exam score exceeded \n';
            document.edit_mark_form.exam_score_edit.focus();
        }


        if (error == "") {

            $.ajax({
                type: "POST",
                url: "ajax/editstudentassessment.php",
                data: {

                    class_score: class_score_edit,
                    exam_score: exam_score_edit,
                    student_id:student_id,
                    academic_year:academic_year,
                    term:term,
                    course:course,
                    course_class:course_class,
                    department:department,
                    assessment_id:assessment_id

                },
                success: function (text) {

                    swal("Submitted!", "Mark Updated", "success");

                    $.ajax({
                        type: "POST",
                        url: "ajax/marks_input_table.php",
                        data: {

                            course: course,
                            course_class: course_class

                        },
                        success: function (text) {

                            $('#marks_here').html(text);

                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },

                    });



                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },

            });


        }
        else {

            $('#error_loc_mark_edit').notify(error);


        }
        return false;
    });




</script>