
<?php
include('../dbcon.php');

$theindex = $_POST['theindex'];
$student_id = $_POST['student_id'];
$academic_year = $_POST['academic_year'];
$term = $_POST['term'];
$course = $_POST['course'];
$course_class = $_POST['course_class'];
$fullname = $_POST['fullname'];


$ch = $mysqli->query("select * from student_assessment where student_id = '$student_id' and course = '$course' and class = '$course_class'
 and academic_year = '$academic_year' and term = '$term'");
$re = $ch->fetch_assoc();


?>

<script type="text/Javascript">
    function checkDec(el){
        var ex = /^[0-9]+\.?[0-9]*$/;
        if(ex.test(el.value)==false){
            el.value = el.value.substring(0,el.value.length - 1);
        }
    }
</script>




<div class="row">

    <div class="col-md-12 col-sm-12">


        <div class="form-group col-md-6">
            <label for="form-field-username">Student Name</label>

            <div>
                <input type="text" readonly style="width:90%" value="<?php echo $fullname; ?>"/>
            </div>
        </div>

        <div class="form-group col-md-3">
            <label for="form-field-username">Class</label>

            <div>
                <input type="text" readonly style="width:90%" value="<?php echo $course_class; ?>"/>
            </div>
        </div>

        <div class="form-group col-md-3">
            <label for="form-field-username">Course</label>

            <div>
                <input type="text" readonly style="width:90%" value="<?php echo $course; ?>"/>
            </div>
        </div>



        <div class="space-4"></div>

    </div>







    <div class="col-md-12 col-sm-12">


        <div class="form-group col-md-6">
            <label for="form-field-username">Class Score</label>

            <div>
                <input type="text" style="width:90%" id="class_score_edit" onkeyup="checkDec(this);" value="<?php echo $re['class_score'] ?>"/>
            </div>
        </div>

        <div class="form-group col-md-6">
            <label for="form-field-username">Exam Score</label>

            <div>
                <input type="text" style="width:90%" id="exam_score_edit" onkeyup="checkDec(this);" value="<?php echo $re['exam_score'] ?>"/>
            </div>
        </div>


        <input type="hidden" id="student_id" value="<?php echo $student_id ?>"/>

        <input type="hidden" id="academic_year" value="<?php echo $academic_year ?>"/>

        <input type="hidden" id="term" value="<?php echo $term ?>"/>

        <input type="hidden" id="course" value="<?php echo $course ?>"/>

        <input type="hidden" id="course_class" value="<?php echo $course_class ?>"/>

        <input type="hidden" id="assessment_id" value="<?php echo $theindex ?>"/>


        <div class="space-4"></div>

    </div>
</div>

