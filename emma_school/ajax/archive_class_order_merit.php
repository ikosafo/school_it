<?php

include('../dbcon.php');

$date = date("Y-m-d");

$stud_class = mysqli_real_escape_string($mysqli, $_POST['stud_class']);
$academic_year = mysqli_real_escape_string($mysqli, $_POST['academic_year']);
$term = mysqli_real_escape_string($mysqli, $_POST['term']);


?>

<button class="btn btn-info btn-sm btn-primary btn-white btn-round" type="button" id="print_report" onclick="printContent('printt')">
    <i class="ace-icon fa fa-print bigger-110"></i>
    Print
</button>


<hr/>

<div id="printt">

    <h3 style="text-align: center;text-transform: uppercase;font-weight: 800"><?php echo $academic_year ?> - <?php echo $term ?></h3>

    <h4 style="text-align: center;text-transform: uppercase;font-weight: 800">Class: <?php echo $stud_class; ?></h4>

    <table id="" class="table table-striped table-bordered table-hover dynamic-table">
        <thead>
        <tr>

            <th width="25%" rowspan="2">CANDIDATES</th>
            <th width="60%" colspan="<?php
            $get = $mysqli->query("select * from course_class where class = '$stud_class' order by type");
            $count = mysqli_num_rows($get);
            echo $act_count = $count * 2;
            ?>
        " style="text-align: center">SCORES PER SUBJECT
            </th>
            <th rowspan="2" width="5%">
                AGG
            </th>
            <th rowspan="2" width="5%">
                RAW <br/>
                SCORE
            </th>
            <th rowspan="2" width="5%">
                POSN.
            </th>
            <th rowspan="2" width="5%">
                TOTAL
            </th>

        </tr>
        <tr>

            <?php

            while ($get_course = $get->fetch_assoc()) {

                ?>

                <th style="text-transform: uppercase"><?php $course = $get_course['course'];
                    echo $tr_course = substr($course, 0, 3); ?></th>
                <th>G</th>


            <?php } ?>


        </tr>
        </thead>

        <tbody>




        <?php $get_st = $mysqli->query("select DISTINCT(a.student_id),s.lastname,s.firstname,s.othername from student s
JOIN student_assessment a on s.student_id = a.student_id

                                          where s.class = '$stud_class' order by a.raw_score DESC,s.lastname,s.firstname,s.othername");

        while ($res_st = $get_st->fetch_assoc()){

            $student_id = $res_st['student_id'];

            ?>

            <tr>

                <td style="text-transform: uppercase">
                    <?php echo $res_st['lastname'].' '.$res_st['firstname'].' '.$res_st['othername']; ?>
                </td>

                <?php

                $get_m = $mysqli->query("select * from course_class where class = '$stud_class' order by type");

                while ($course_m = $get_m->fetch_assoc()) {

                    $course_mark = $course_m['course'];

                    $get_score = $mysqli->query("select * from student_assessment where course = '$course_mark' and student_id = '$student_id'");
                    $total = $get_score->fetch_assoc();
                    ?>
                    <td>
                        <?php  echo $total['total'];?>

                    </td>
                    <td>
                        <b>
                            <?php echo $grade = $total['grade_display']; ?>
                        </b>
                    </td>

                    <?php

                }

                ?>
                <td>
                    <?php

                    $get_dp = $mysqli->query("select * from class where name = '$stud_class'");
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

                    ?>
                </td>

                <td><b>
                        <?php  echo $raw_score; ?>
                    </b>

                </td>

                <td style="text-transform: uppercase;color: red;font-weight: 800">
                    <?php $get_pos = $mysqli->query("SELECT
                        student_id,academic_year,term,course,
                        1+(SELECT COUNT(DISTINCT(student_id)) FROM student_assessment a
                        WHERE a.raw_score > b.raw_score AND academic_year = '$academic_year' AND
                        class = '$stud_class' AND term = '$term') AS RNK,
                        raw_score
                        FROM student_assessment b WHERE academic_year = '$academic_year' AND
                        class = '$stud_class' AND term = '$term' AND student_id='$student_id'");

                    $position = $get_pos->fetch_assoc();

                    $rank = $position['RNK'];

                    if (substr($rank, -1) == 1 && $rank != 11) {
                        echo $rank . 'st';
                    } elseif (substr($rank, -1) == 2 && $rank != 12) {
                        echo $rank . 'nd';
                    } elseif (substr($rank, -1) == 3 && $rank != 13) {
                        echo $rank . 'rd';
                    } else {
                        echo $rank . 'th';
                    }

                    ?>
                </td>
                <td>
                    <b>
                        <?php $get = $mysqli->query("select sum(total) as total from student_assessment where student_id = '$student_id' AND
                              academic_year = '$academic_year' and term = '$term'");
                        $sum = $get->fetch_assoc();
                        echo $total = $sum['total']; ?>
                    </b>

                </td>

            </tr>

        <?php  }

        ?>







        </tbody>
    </table>


</div>


<script>
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }

</script>
