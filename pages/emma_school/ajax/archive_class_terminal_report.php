<?php include('../dbcon.php');

$date = date("Y-m-d");

$academic_year=mysqli_real_escape_string($mysqli,$_POST['academic_year']);
$term=mysqli_real_escape_string($mysqli,$_POST['term']);


$sess = $mysqli->query("select * from `academic_session` where year = '$academic_year' and term = '$term'");
$res_ses = $sess->fetch_assoc();

$term_begins = $res_ses['term_begins'];

$n_term_begins = date("F j, Y",$term_begins);

$term_begins = $res_ses['term_begins'];

$n_term_begins = date("F j, Y",$term_begins);



    $stud_class=mysqli_real_escape_string($mysqli,$_POST['stud_class']);

    $main_query = $mysqli->query("select * from student where class = '$stud_class'"); ?>

    <button class="btn btn-info btn-sm btn-primary btn-white btn-round" type="button" id="print_report"
            onclick="printContent('printt')">
        <i class="ace-icon fa fa-print bigger-110"></i>
        Print All Reports
    </button>


    <hr/>

    <div id="printt">


        <?php  while ($get_this = $main_query->fetch_assoc()) {

            $student_id = $get_this['student_id'];

            $query_id = $mysqli->query("select * from student where student_id = '$student_id'");
            $result_id = $query_id->fetch_assoc();


            $chk_type = $mysqli->query("select DISTINCT(type) from course_class order by type");

            $sch_chk = $mysqli->query("select * from institution LIMIT 1");
            $sch_get = $sch_chk->fetch_assoc();

            $one_m = substr($sch_get['mobile'], 1, 3);
            $two_m = substr($sch_get['mobile'], 6, 3);
            $three_m = substr($sch_get['mobile'], -4);

            $mobile = $one_m . '' . $two_m . '' . $three_m;

            $one_t = substr($sch_get['telephone'], 1, 3);
            $two_t = substr($sch_get['telephone'], 6, 3);
            $three_t = substr($sch_get['telephone'], -4);

            $telephone = $one_t . '' . $two_t . '' . $three_t;

            $one_a = substr($sch_get['altmobile'], 1, 3);
            $two_a = substr($sch_get['altmobile'], 6, 3);
            $three_a = substr($sch_get['altmobile'], -4);

            $altmobile = $one_a . '' . $two_a . '' . $three_a;


            ?>

            <div style="height: 1165px">

                <table class="table" width="100%">
                    <tr>
                        <td colspan="11"></td>
                    </tr>
                    <tr>

                        <td rowspan="2" colspan="2" width="20%">
                 <span class="profile-picture" style="width: 50%">
    <img class="editable img-responsive" src="../<?php echo $sch_get['logo'] ?>" id="avatar2"
         alt="" style="width: 100%">
															</span>
                        </td>

                        <td colspan="7" width="60%">

                            <b style="font-size: 20px" >
                                <?php echo $sch_get['name'] ?>
                            </b>

                            <div class="hr hr-2 dotted hr-double"></div>

                            <b>
                                <?php echo $sch_get['address'] ?>
                            </b>
                            <br/>
                            <b>
                                Tel: <?php echo $telephone; ?> / <?php echo $mobile; ?> / <?php echo $altmobile; ?>
                            </b>
                            <br/>
                            <b>
                                <?php echo $sch_get['email'] ?>
                            </b>


                        </td>

                        <td colspan="2" width="20%">
 <span class="profile-picture" style="width: 50%">
    <img class="editable img-responsive" src="../<?php echo $result_id['picture'] ?>" id="avatar2"
         alt="" style="width: 100%">
															</span>
                        </td>
                    </tr>



                </table>


                <table id="" class="table table-bordered table-hover" width="100%">
                    <thead>
                    <tr>

                        <th style="text-align: center" colspan="8">TERMINAL REPORT</th>

                    </tr>
                    </thead>

                    <tbody>

                    <tr style="font-size: x-small;text-transform: uppercase">
                        <td>
                            <b>STUDENT ID:</b>
                        </td>
                        <td colspan="3">
                            <?php echo $result_id['stud_id'] ?>
                        </td>
                        <td>
                            <b>ACADEMIC YEAR:</b>
                        </td>
                        <td colspan="3"><?php echo $academic_year; ?></td>
                    </tr>

                    <tr style="font-size: x-small;text-transform: uppercase">
                        <td>
                            <b>NAME:</b>
                        </td>
                        <td colspan="3">
                            <?php echo $result_id['lastname'] . ' ' . $result_id['firstname'] . ' ' . $result_id['othername']; ?>
                        </td>
                        <td>
                            <b>TERM:</b>
                        </td>
                        <td colspan="3"><?php echo $term; ?></td>
                    </tr>


                    <tr style="font-size: x-small;text-transform: uppercase">
                        <td>
                            <b>CLASS:</b>
                        </td>
                        <td colspan="3">
                            <?php echo $class = $result_id['class']; ?>  <?php echo $result_id['program']; ?>
                        </td>
                        <td>
                            <b>AGGREGATE:</b>
                        </td>
                        <td colspan="3"><?php

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

                            ?></td>
                    </tr>

                    <tr style="font-size: x-small;text-transform: uppercase">
                        <td>
                            <b>HOUSE:</b>
                        </td>
                        <td colspan="3">
                            <?php echo $result_id['house']; ?>
                        </td>
                        <td>
                            <b>POSITION:</b>
                        </td>
                        <td colspan="3"><?php $get_pos = $mysqli->query("SELECT
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
                    </tr>

                    <tr style="font-size: x-small;text-transform: uppercase">

                        <td>
                            <b>NEXT TERM BEGINS:</b>
                        </td>
                        <td colspan="3"><?php echo date("F j, Y", strtotime($term_begins)) ?></td>
                        <td>
                            <b>NO ON ROLL:</b>
                        </td>
                        <td colspan="3"><?php $get_no = $mysqli->query("select count(*) as class_no from student where class = '$class'");
                            $res_no = $get_no->fetch_assoc();
                            echo $res_no['class_no']?></td>
                    </tr>

                    </tbody>

                </table>

                <table id="" class="table table-bordered table-hover" width="100%" style="margin-top: -18px">


                    <tr style="font-size: x-small">

                        <th width="30%" style="text-align: center; vertical-align:middle" colspan="2">SUBJECT</th>
                        <th width="10%" style="text-align: center; vertical-align:middle">CLASS SCORE</th>
                        <th width="10%" style="text-align: center; vertical-align:middle">EXAM SCORE</th>
                        <th width="10%" style="text-align: center; vertical-align:middle">TOTAL</th>
                        <th width="10%" style="text-align: center; vertical-align:middle">GRADE</th>
                        <th width="10%" style="text-align: center; vertical-align:middle">POSITION</th>
                        <th width="20%" style="text-align: center; vertical-align:middle">REMARKS</th>

                    </tr>


                    <?php

                    while ($row_type = $chk_type->fetch_assoc()) {

                        ?>


                        <tr style="font-size: x-small">
                            <td colspan="8" style="text-transform: uppercase">
                                <b>
                                    <?php echo $course_type = $row_type['type']; ?>
                                </b>
                            </td>
                        </tr>


                        <?php
                        $que = $mysqli->query("SELECT DISTINCT(s.period),s.`course`,s.`class_score`,s.`exam_score`,c.`type`,s.`total`,s.`remark`,
s.`grade`,s.`grade_display`
                                      FROM student_assessment s JOIN course_class c ON s.course = c.course
                                      where s.student_id = '$student_id'
                                 and s.academic_year = '$academic_year' and s.term = '$term' and c.type = '$course_type'");

                        while ($row = $que->fetch_assoc()) {


                            ?>


                            <tr style="font-size: x-small;text-transform: uppercase">


                                <td colspan="2"><?php echo $course = $row['course'] ?></td>
                                <td style="text-align: center"><?php echo $row['class_score'] ?></td>
                                <td style="text-align: center"><?php echo $row['exam_score'] ?></td>
                                <td style="text-align: center"><b><?php echo $row['total'] ?></b></td>
                                <td style="text-align: center"><b><?php echo $row['grade_display'] ?></b></td>
                                <td style="text-align: center">
                                    <?php $get_pos = $mysqli->query("SELECT
                        student_id,academic_year,term,course,
                        1+(SELECT COUNT(*) FROM student_assessment a
                        WHERE a.total > b.total AND academic_year = '$academic_year' AND
                        course = '$course' AND class = '$stud_class' AND term = '$term') AS RNK,
                        total
                        FROM student_assessment b WHERE academic_year = '$academic_year' AND
                        course = '$course' AND class = '$stud_class' AND term = '$term' AND student_id='$student_id'");

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
                                <td style="text-align: center"><b><?php echo $row['remark'] ?></b></td>


                            </tr>


                        <?php }

                    }
                    ?>

                    <tr style="font-size: x-small">
                        <td colspan="2"></td>
                        <td></td>
                        <td></td>

                        <td style="text-align: center;background: #ECF2F7"><b>
                                <?php $get = $mysqli->query("select sum(total) as total from student_assessment where student_id = '$student_id' AND
                              academic_year = '$academic_year' and term = '$term'");
                                $sum = $get->fetch_assoc();
                                echo $total = $sum['total']; ?>
                            </b>
                        </td>

                        <td></td>
                        <td></td>
                        <td></td>


                    </tr>

                    <tr style="font-size: x-small">
                        <td colspan="5"></td>
                        <td colspan="2" style="text-align: center">AVERAGE MARK</td>
                        <td style="text-align: center">
                            <?php $get_ct = $mysqli->query("select count(*) as number from student_assessment where student_id = '$student_id' AND
                              academic_year = '$academic_year' and term = '$term'");
                            $num = $get_ct->fetch_assoc();
                            $number = $num['number'];

                            echo $avg = number_format(($total / $number), 2);

                            ?>
                        </td>
                    </tr>
                    <?php
                    $get_bill = $mysqli->query("select * from bill_conduct where student_id = '$student_id' AND
                              academic_year = '$academic_year' and term = '$term'");
                    $bill = $get_bill->fetch_assoc();


                    ?>

                    <tr style="font-size: x-small">
                        <td colspan="3"><b>PROMOTED TO/REPEATED TO</b></td>
                        <td colspan="2"><?php echo $bill['promoted_to'] ?></td>
                        <td colspan="3" style="text-align: center;background: #002a80;color: #ffffff"><b>BILL</b></td>
                    </tr>

                    <tr style="font-size: x-small">
                        <td><b>ATTENDANCE</b></td>
                        <td colspan="2"><?php echo $bill['attendance_from'] ?></td>
                        <td><b>OUT OF</b></td>
                        <td><?php echo $bill['attendance_to'] ?></td>
                        <td colspan="2"><b>ARREARS(GHS)</b></td>
                        <td><?php echo $bill['arrears'] ?></td>
                    </tr>

                    <tr style="font-size: x-small">
                        <td><b>CONDUCT</b></td>
                        <td colspan="4"><?php echo $bill['conduct'] ?></td>
                        <td colspan="2"><b>TUITION FEE(GHS)</b></td>
                        <td><?php echo $bill['tution_fee'] ?></td>
                    </tr>

                    <tr style="font-size: x-small">
                        <td><b>ATTITUDE</b></td>
                        <td colspan="4"><?php echo $bill['attitude'] ?></td>
                        <td colspan="2"><b>ICT(GHS)</b></td>
                        <td><?php echo $bill['ict'] ?></td>
                    </tr>

                    <tr style="font-size: x-small">
                        <td><b>INTEREST</b></td>
                        <td colspan="4"><?php echo $bill['interest'] ?></td>
                        <td colspan="2"><b>OTHERS(GHS)</b></td>
                        <td><?php echo $bill['others'] ?></td>
                    </tr>

                    <tr style="font-size: x-small">
                        <td colspan="5"></td>
                        <td colspan="2"><b>TOTAL</b></td>
                        <td><b><?php echo $bill['total'] ?></b></td>

                    </tr>


                    <tr style="font-size: x-small">
                        <td colspan="2"><b>CLASS TEACHER'S REMARKS</b></td>
                        <td colspan="4"><?php echo $bill['class_teachers_remark'] ?></td>
                        <td colspan="2" rowspan="2">
                   <span class="profile-picture" style="width: 47%">
    <img class="editable img-responsive" src="../<?php echo $sch_get['signature'] ?>" id="avatar2"
         alt="" style="width: 100%"> <b>
                           HEADMASTER
                       </b>
															</span>

                        </td>
                    </tr>
                    <tr style="font-size: x-small">
                        <td colspan="2"><b>HEAD TEACHER'S REMARKS</b></td>
                        <td colspan="4"><?php echo $bill['head_teachers_remark'] ?></td>
                    </tr>

                    <tr style="font-size: x-small">
                        <td colspan="8">
                            <b>NB:</b> PARENTS/ GUARDIANS ARE KINDLY ADVISED TO MAKE PART OR FULL PAYMENT OF FEES ON THE WEEK OF RE-OPENING.
                        </td>
                    </tr>


                    <!-- <tr>
                 <td><b>MARKS FROM</b></td>
                 <td><b>MARKS TO</b></td>
                 <td><b>REMARKS</b></td>
                 <td><b>GRADE</b></td>
                 <td colspan="4" rowspan="3">
                        <span class="profile-picture" style="width: 25%">
         <img class="editable img-responsive" src="../<?php /*echo $sch_get['signature'] */?>" id="avatar2"
              alt="" style="width: 100%">
                                                                 </span>
                     <br/>
                     <b>HEADMASTER</b>
                 </td>

             </tr>

             <?php
                    /*
                            $chk_dept = $mysqli->query("select * from class where name = '$class'");
                            $get_dept = $chk_dept->fetch_assoc();
                            $department = $get_dept['department'];

                            $get_keys = $mysqli->query("select * from grading where department = '$department'");

                            while ($res_key = $get_keys->fetch_assoc()) { */?>


                 <tr>

                     <td>
                         <?php /*echo $res_key['mark_from'] */?>
                     </td>
                     <td>
                         <?php /*echo $res_key['mark_to'] */?>
                     </td>
                     <td>
                         <?php /*echo $res_key['remark'] */?>
                     </td>
                     <td>
                         <?php /*echo $res_key['grade'] */?>
                     </td>

                 </tr>

             -->


                </table>

            </div>

            <?php /*}*/

        }
        ?>




    </div>




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

    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }

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
        var department  = '<?php echo $chk_res['department']; ?>';

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

