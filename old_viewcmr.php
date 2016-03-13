<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$cmrId = $_GET['id'];
require_once("models/header.php");
$getcmrinfo = $mysqli->prepare("SELECT
	cmr_id,
	cmr_academicsession,
	cmr_coursecode,
	cmr_coursetitle,
	cmr_courseleader,
	cmr_faculties,
	cmr_studentcount FROM `bullytrack`.`cl_cmr` WHERE `cmr_id`='".$cmrId."'");
$getcmrinfo->execute();
$getcmrinfo->bind_result($cmr_id, $cmr_academicsession, $cmr_coursecode, $cmr_coursetitle, $cmr_courseleader, $cmr_faculties, $cmr_studentcount);
while ($getcmrinfo->fetch()){
	$cmrinfo[] = array('cmr_id' => $cmr_id, 'cmr_academicsession' => $cmr_academicsession, 'cmr_coursecode' => $cmr_coursecode, 'cmr_coursetitle' => $cmr_coursetitle, 'cmr_courseleader' => $cmr_courseleader,'cmr_faculties' => $cmr_faculties, 'cmr_studentcount' => $cmr_studentcount);
	}
$getcmrinfo->close();

$getcw1 = $mysqli->prepare("SELECT cw1_0, cw1_1, cw1_2, cw1_3, cw1_4, cw1_5, cw1_6, cw1_7, cw1_8, cw1_9 FROM `bullytrack`.`cl_cw1` WHERE cmr_id=".$cmrId.";");
$getcw1->execute();
$getcw1->bind_result($cw1_0, $cw1_1, $cw1_2, $cw1_3, $cw1_4, $cw1_5, $cw1_6, $cw1_7, $cw1_8, $cw1_9);
while ($getcw1->fetch()){
	$cw1records[] = array('cw1_0' => $cw1_0,'cw1_1' => $cw1_1,'cw1_2' => $cw1_2,'cw1_3' => $cw1_3,'cw1_4' => $cw1_4,'cw1_5' => $cw1_5,'cw1_6' => $cw1_6,'cw1_7' => $cw1_7,'cw1_8' => $cw1_8,'cw1_9' => $cw1_9);
}
$getcw1->close();

$getcw2 = $mysqli->prepare("SELECT cw2_0, cw2_1, cw2_2, cw2_3, cw2_4, cw2_5, cw2_6, cw2_7, cw2_8, cw2_9 FROM `bullytrack`.`cl_cw2` WHERE cmr_id=".$cmrId.";");
$getcw2->execute();
$getcw2->bind_result($cw2_0, $cw2_1, $cw2_2, $cw2_3, $cw2_4, $cw2_5, $cw2_6, $cw2_7, $cw2_8, $cw2_9);
while ($getcw2->fetch()){
	$cw2records[] = array('cw2_0' => $cw2_0,'cw2_1' => $cw2_1,'cw2_2' => $cw2_2,'cw2_3' => $cw2_3,'cw2_4' => $cw2_4,'cw2_5' => $cw2_5,'cw2_6' => $cw2_6,'cw2_7' => $cw2_7,'cw2_8' => $cw2_8,'cw2_9' => $cw2_9);
}
$getcw2->close();

$getcw3 = $mysqli->prepare("SELECT cw3_0, cw3_1, cw3_2, cw3_3, cw3_4, cw3_5, cw3_6, cw3_7, cw3_8, cw3_9 FROM `bullytrack`.`cl_cw3` WHERE cmr_id=".$cmrId.";");
$getcw3->execute();
$getcw3->bind_result($cw3_0, $cw3_1, $cw3_2, $cw3_3, $cw3_4, $cw3_5, $cw3_6, $cw3_7, $cw3_8, $cw3_9);
while ($getcw3->fetch()){
	$cw3records[] = array('cw3_0' => $cw3_0,'cw3_1' => $cw3_1,'cw3_2' => $cw3_2,'cw3_3' => $cw3_3,'cw3_4' => $cw3_4,'cw3_5' => $cw3_5,'cw3_6' => $cw3_6,'cw3_7' => $cw3_7,'cw3_8' => $cw3_8,'cw3_9' => $cw3_9);
}
$getcw3->close();

$getcw4 = $mysqli->prepare("SELECT cw4_0, cw4_1, cw4_2, cw4_3, cw4_4, cw4_5, cw4_6, cw4_7, cw4_8, cw4_9 FROM `bullytrack`.`cl_cw4` WHERE cmr_id=".$cmrId.";");
$getcw4->execute();
$getcw4->bind_result($cw4_0, $cw4_1, $cw4_2, $cw4_3, $cw4_4, $cw4_5, $cw4_6, $cw4_7, $cw4_8, $cw4_9);
while ($getcw4->fetch()){
	$cw4records[] = array('cw4_0' => $cw4_0,'cw4_1' => $cw4_1,'cw4_2' => $cw4_2,'cw4_3' => $cw4_3,'cw4_4' => $cw4_4,'cw4_5' => $cw4_5,'cw4_6' => $cw4_6,'cw4_7' => $cw4_7,'cw4_8' => $cw4_8,'cw4_9' => $cw4_9);
}
$getcw4->close();

$getexam = $mysqli->prepare("SELECT exam_0, exam_1, exam_2, exam_3, exam_4, exam_5, exam_6, exam_7, exam_8, exam_9 FROM `bullytrack`.`cl_exam` WHERE cmr_id=".$cmrId.";");
$getexam->execute();
$getexam->bind_result($exam_0, $exam_1, $exam_2, $exam_3, $exam_4, $exam_5, $exam_6, $exam_7, $exam_8, $exam_9);
while ($getexam->fetch()){
	$examrecords[] = array('exam_0' => $exam_0,'exam_1' => $exam_1,'exam_2' => $exam_2,'exam_3' => $exam_3,'exam_4' => $exam_4,'exam_5' => $exam_5,'exam_6' => $exam_6,'exam_7' => $exam_7,'exam_8' => $exam_8,'exam_9' => $exam_9);
}
$getexam->close();

$getoverall = $mysqli->prepare("SELECT overall_0, overall_1, overall_2, overall_3, overall_4, overall_5, overall_6, overall_7, overall_8, overall_9 FROM `bullytrack`.`cl_overall` WHERE cmr_id=".$cmrId.";");
$getoverall->execute();
$getoverall->bind_result($overall_0, $overall_1, $overall_2, $overall_3, $overall_4, $overall_5, $overall_6, $overall_7, $overall_8, $overall_9);
while ($getoverall->fetch()){
	$overallrecords[] = array('overall_0' => $overall_0,'overall_1' => $overall_1,'overall_2' => $overall_2,'overall_3' => $overall_3,'overall_4' => $overall_4,'overall_5' => $overall_5,'overall_6' => $overall_6,'overall_7' => $overall_7,'overall_8' => $overall_8,'overall_9' => $overall_9);
}
$getoverall->close();

echo "
</div>
	<div id='main' class='col-md-10'>
		<div id='regbox'><h1>Course Monitoring Report №".$cmrId."</h1>";

		foreach ($cmrinfo as $info) {echo "<h4>Academic session: ".$info['cmr_academicsession']."</h4><h4>Course code: ".$info['cmr_coursecode']."</h4><h4>Course title: ".$info['cmr_coursetitle']."</h4><h4>Course leader: ".$info['cmr_courseleader']."</h4><h4>Faculty: ".$info['cmr_faculties']."</h4><h4>№ of students: ".$info['cmr_studentcount']."</h4>";
		}
echo "
		<table class='table table-hover table-condensed table-cmr'><thead>
		<tr><th class='cmrtop'></th><th>0 - 9</th><th>10 - 19</th><th>20 - 29</th><th>30 - 39</th><th>40 - 49</th><th>50 - 59</th><th>60 - 69</th><th>70 - 79</th><th>80 - 89</th><th>90 +</th></tr></thead>
		<tbody>
		<tr><td>CW1</td>"; 	foreach ($cw1records as $record) {echo "<td>".$record['cw1_0']."</td><td>".$record['cw1_1']."</td><td>".$record['cw1_2']."</td><td>".$record['cw1_3']."</td><td>".$record['cw1_4']."</td><td>".$record['cw1_5']."</td><td>".$record['cw1_6']."</td><td>".$record['cw1_7']."</td><td>".$record['cw1_8']."</td><td>".$record['cw1_9']."</td>";} echo "</tr>
		<tr><td>CW2</td>"; 	foreach ($cw2records as $record) {echo "<td>".$record['cw2_0']."</td><td>".$record['cw2_1']."</td><td>".$record['cw2_2']."</td><td>".$record['cw2_3']."</td><td>".$record['cw2_4']."</td><td>".$record['cw2_5']."</td><td>".$record['cw2_6']."</td><td>".$record['cw2_7']."</td><td>".$record['cw2_8']."</td><td>".$record['cw2_9']."</td>";} echo "</tr>
		<tr><td>CW3</td>"; 	foreach ($cw3records as $record) {echo "<td>".$record['cw3_0']."</td><td>".$record['cw3_1']."</td><td>".$record['cw3_2']."</td><td>".$record['cw3_3']."</td><td>".$record['cw3_4']."</td><td>".$record['cw3_5']."</td><td>".$record['cw3_6']."</td><td>".$record['cw3_7']."</td><td>".$record['cw3_8']."</td><td>".$record['cw3_9']."</td>";} echo "</tr>
		<tr><td>CW4</td>"; 	foreach ($cw4records as $record) {echo "<td>".$record['cw4_0']."</td><td>".$record['cw4_1']."</td><td>".$record['cw4_2']."</td><td>".$record['cw4_3']."</td><td>".$record['cw4_4']."</td><td>".$record['cw4_5']."</td><td>".$record['cw4_6']."</td><td>".$record['cw4_7']."</td><td>".$record['cw4_8']."</td><td>".$record['cw4_9']."</td>";} echo "</tr>
    	<tr><td>EXAM</td>"; 	foreach ($examrecords as $record) {echo "<td>".$record['exam_0']."</td><td>".$record['exam_1']."</td><td>".$record['exam_2']."</td><td>".$record['exam_3']."</td><td>".$record['exam_4']."</td><td>".$record['exam_5']."</td><td>".$record['exam_6']."</td><td>".$record['exam_7']."</td><td>".$record['exam_8']."</td><td>".$record['exam_9']."</td>";} echo "</tr>
		<tr><td>OVERALL</td>"; 	foreach ($overallrecords as $record) {echo "<td>".$record['overall_0']."</td><td>".$record['overall_1']."</td><td>".$record['overall_2']."</td><td>".$record['overall_3']."</td><td>".$record['overall_4']."</td><td>".$record['overall_5']."</td><td>".$record['overall_6']."</td><td>".$record['overall_7']."</td><td>".$record['overall_8']."</td><td>".$record['overall_9']."</td>";} echo "</tr></tbody></table>
		</div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>