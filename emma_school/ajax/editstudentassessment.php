<?php

include("../dbcon.php");

$date = date("Y-m-d H:i:s");

$class_score = mysqli_real_escape_string($mysqli,$_POST['class_score']);
$exam_score = mysqli_real_escape_string($mysqli,$_POST['exam_score']);
$student_id = mysqli_real_escape_string($mysqli,$_POST['student_id']);
$academic_year = mysqli_real_escape_string($mysqli,$_POST['academic_year']);
$term = mysqli_real_escape_string($mysqli,$_POST['term']);
$course = mysqli_real_escape_string($mysqli,$_POST['course']);
$course_class = mysqli_real_escape_string($mysqli,$_POST['course_class']);
$department = mysqli_real_escape_string($mysqli,$_POST['department']);
$assessment_id = mysqli_real_escape_string($mysqli,$_POST['assessment_id']);


$total = $class_score + $exam_score;


$get_grade = $mysqli->query("select * from grading where department = '$department' and (mark_from <= $total and mark_to >= $total)");
$res_grade = $get_grade->fetch_assoc();

$remark = $res_grade['remark'];
$grade = $res_grade['grade'];
$grade_display = $res_grade['grade_display'];



$mysqli->query("UPDATE `student_assessment`

SET

  `class_score` = '$class_score',
  `exam_score` = '$exam_score',
  `total` = '$total',
  `remark` = '$remark',
  `grade` = '$grade',
  `grade_display` = '$grade_display'


WHERE `id` = '$assessment_id'")

or die(mysqli_error($mysqli));

echo 1;







$get_dp = $mysqli->query("select * from class where name = '$course_class'");
$res_dp = $get_dp->fetch_assoc();

$dept = $res_dp['department'];

if ($dept == 'SHS') {

    //Get Total Core Aggregate

    $get_c1 = $mysqli->query("SELECT MIN(grade) as min_grade
FROM student_assessment
WHERE academic_year = '$academic_year' and term = '$term' and type = 'Core' and student_id = '$student_id'");
    $res_c1 = $get_c1->fetch_assoc();
    $c1 = $res_c1['min_grade'];


    $get_c1_id = $mysqli->query("select id from student_assessment where grade = '$c1' and
 academic_year = '$academic_year' and term = '$term' and type = 'Core' and student_id = '$student_id'");
    $res_c1_id = $get_c1_id->fetch_assoc();

    $c1_id = $res_c1_id['id'];

    $get_t1 = $mysqli->query("select * from student_assessment where id = '$c1_id'");
    $res_t1 = $get_t1->fetch_assoc();
    $core_t1 = $res_t1['total'];


    $get_c2 = $mysqli->query("SELECT MIN(grade) AS min_grade2
FROM student_assessment
WHERE academic_year = '$academic_year' AND term = '$term' AND type = 'Core' AND student_id = '$student_id'
AND grade >= '$c1' AND id <> '$c1_id'");
    $res_c2 = $get_c2->fetch_assoc();

    $c2 = $res_c2['min_grade2'];


    $get_c2_id = $mysqli->query("select id from student_assessment where grade = '$c2' and id <> '$c1_id' and
 academic_year = '$academic_year' and term = '$term' and type = 'Core' and student_id = '$student_id'");
    $res_c2_id = $get_c2_id->fetch_assoc();

    $c2_id = $res_c2_id['id'];

    $get_t2 = $mysqli->query("select * from student_assessment where id = '$c2_id'");
    $res_t2 = $get_t2->fetch_assoc();
    $core_t2 = $res_t2['total'];


    $get_c3 = $mysqli->query("SELECT MIN(grade) AS min_grade3
FROM student_assessment
WHERE academic_year = '$academic_year' AND term = '$term' AND `type` = 'Core' AND student_id = '$student_id'
AND grade >= '$c1' AND grade >= '$c2' AND id <> '$c1_id' AND id <> '$c2_id'");
    $res_c3 = $get_c3->fetch_assoc();

    $c3 = $res_c3['min_grade3'];


    $get_c3_id = $mysqli->query("select id from student_assessment where grade = '$c3' and id <> '$c1_id' and id <> '$c2_id' and
 academic_year = '$academic_year' and term = '$term' and type = 'Core' and student_id = '$student_id'");
    $res_c3_id = $get_c3_id->fetch_assoc();

    $c3_id = $res_c3_id['id'];

    $get_t3 = $mysqli->query("select * from student_assessment where id = '$c3_id'");
    $res_t3 = $get_t3->fetch_assoc();
    $core_t3 = $res_t3['total'];



    $sum_core = $c1 + $c2 + $c3;

    $core_total = $core_t1 + $core_t2 + $core_t3;






    //Get Total Elective Aggregate


    $get_e1 = $mysqli->query("SELECT MIN(grade) as min_grade
FROM student_assessment
WHERE academic_year = '$academic_year' and term = '$term' and type = 'Elective' and student_id = '$student_id'");
    $res_e1 = $get_e1->fetch_assoc();
    $e1 = $res_e1['min_grade'];


    $get_e1_id = $mysqli->query("select id from student_assessment where grade = '$e1' and
 academic_year = '$academic_year' and term = '$term' and type = 'Elective' and student_id = '$student_id'");
    $res_e1_id = $get_e1_id->fetch_assoc();

    $e1_id = $res_e1_id['id'];


    $get_t1_e = $mysqli->query("select * from student_assessment where id = '$e1_id'");
    $res_t1_e = $get_t1_e->fetch_assoc();
    $e_t1 = $res_t1_e['total'];


    $get_e2 = $mysqli->query("SELECT MIN(grade) AS min_grade2
FROM student_assessment
WHERE academic_year = '$academic_year' AND term = '$term' AND type = 'Elective' AND student_id = '$student_id'
AND grade >= '$e1' AND id <> '$e1_id'");
    $res_e2 = $get_e2->fetch_assoc();

    $e2 = $res_e2['min_grade2'];


    $get_e2_id = $mysqli->query("select id from student_assessment where grade = '$e2' and id <> '$e1_id' and
 academic_year = '$academic_year' and term = '$term' and type = 'Elective' and student_id = '$student_id'");
    $res_e2_id = $get_e2_id->fetch_assoc();

    $e2_id = $res_e2_id['id'];

    $get_t2_e = $mysqli->query("select * from student_assessment where id = '$e2_id'");
    $res_t2_e = $get_t2_e->fetch_assoc();
    $e_t2 = $res_t2_e['total'];



    $get_e3 = $mysqli->query("SELECT MIN(grade) AS min_grade3
FROM student_assessment
WHERE academic_year = '$academic_year' AND term = '$term' AND type = 'Elective' AND student_id = '$student_id'
AND grade >= '$e1' AND grade >= '$e2' AND id <> '$e1_id' AND id <> '$e2_id'");
    $res_e3 = $get_e3->fetch_assoc();

    $e3 = $res_e3['min_grade3'];



    $get_e3_id = $mysqli->query("select id from student_assessment where grade = '$e3' and id <> '$e1_id' and id <> '$e2_id' and
 academic_year = '$academic_year' and term = '$term' and type = 'Elective' and student_id = '$student_id'");
    $res_e3_id = $get_e3_id->fetch_assoc();

    $e3_id = $res_e3_id['id'];


    $get_t3_e = $mysqli->query("select * from student_assessment where id = '$e3_id'");
    $res_t3_e = $get_t3_e->fetch_assoc();
    $e_t3 = $res_t3_e['total'];




    $sum_elective = $e1 + $e2 + $e3;

    $elective_total = $e_t1 + $e_t2 + $e_t3;

    echo $sum_core + $sum_elective;


    $raw_score = $core_total + $elective_total;






}



else {

    $get_chk = $mysqli->query("select sum(grade) as core_grade from student_assessment where
                                          academic_year = '$academic_year' and term = '$term' and type = 'Core' and student_id = '$student_id'");
    $res_chk = $get_chk->fetch_assoc();
    $core_grade = $res_chk['core_grade'];


    $get_chk_t = $mysqli->query("select sum(total) as core_total from student_assessment where
                                          academic_year = '$academic_year' and term = '$term' and type = 'Core' and student_id = '$student_id'");
    $res_chk_t = $get_chk_t->fetch_assoc();
    $core_total = $res_chk_t['core_total'];


    $get_chk2 = $mysqli->query("SELECT MIN(grade) as min_grade
FROM student_assessment
WHERE academic_year = '$academic_year' and term = '$term' and type = 'Elective' and student_id = '$student_id'");
    $res_chk2 = $get_chk2->fetch_assoc();
    $elective_grade_1 = $res_chk2['min_grade'];


    $get_id = $mysqli->query("select id from student_assessment where grade = '$elective_grade_1' and
 academic_year = '$academic_year' and term = '$term' and type = 'Elective' and student_id = '$student_id'");
    $res_id = $get_id->fetch_assoc();

    $id = $res_id['id'];

    $get_et1 = $mysqli->query("select total from student_assessment where id = '$id'");
    $res_et1 = $get_et1->fetch_assoc();
    $elective_total_1 = $res_et1['total'];




    $get_chk3 = $mysqli->query("SELECT MIN(grade) AS min_grade2
FROM student_assessment
WHERE academic_year = '$academic_year' AND term = '$term' AND TYPE = 'Elective' AND student_id = '$student_id'
AND grade >= '$elective_grade_1' AND id <> '$id'");
    $res_chk3 = $get_chk3->fetch_assoc();

    $elective_grade_2 = $res_chk3['min_grade2'];



    $get_id2 = $mysqli->query("SELECT id
FROM student_assessment
WHERE academic_year = '$academic_year' AND term = '$term' AND TYPE = 'Elective' AND student_id = '$student_id'
AND grade >= '$elective_grade_1' AND id <> '$id' AND grade = '$elective_grade_2'");
    $res_id2 = $get_id2->fetch_assoc();

    $id2 = $res_id2['id'];


    $get_et2 = $mysqli->query("select total from student_assessment where id = '$id2'");
    $res_et2 = $get_et2->fetch_assoc();
    $elective_total_2 = $res_et2['total'];




    echo $core_grade + $elective_grade_1 + $elective_grade_2;




    $raw_score = $core_total + $elective_total_1 + $elective_total_2;


}



$mysqli->query("UPDATE `student_assessment`
SET
`raw_score` = '$raw_score'

WHERE `student_id` = '$student_id' and term = '$term' and academic_year = '$academic_year'")
or die();




?>