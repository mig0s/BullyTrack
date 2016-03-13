<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

$code = $_POST['course_code'];
$year = $_POST['ayear'];

if (isset($_POST['submit'])) {
	$successes[]=lang("CMR_ADDED");
}

$getgrades = $mysqli->prepare("SELECT  cw1, cw2, cw3, cw4, exam from gradestring where course_code='$code' and year(`timestamp`)=$year;");
$getgrades->execute();
$getgrades->bind_result($cw1, $cw2, $cw3, $cw4, $exam);
while ($getgrades->fetch()) {
	$grades[] = array('cw1' => $cw1,'cw2' => $cw2,'cw3' => $cw3,'cw4' => $cw4,'exam' => $exam);
}
$getgrades->close();

$getcoursename = $mysqli->prepare("SELECT course_name from course where course_code = '$code'");
$getcoursename->execute();
$getcoursename->bind_result($name);
while ($getcoursename->fetch()) {
	$name = $name;
}
$getcoursename->close();

$a_cw1 = array(0,0,0,0,0,0,0,0,0,0);
$a_cw2 = array(0,0,0,0,0,0,0,0,0,0);
$a_cw3 = array(0,0,0,0,0,0,0,0,0,0);
$a_cw4 = array(0,0,0,0,0,0,0,0,0,0);
$a_exam = array(0,0,0,0,0,0,0,0,0,0);

foreach ($grades as $gradestring => $grade) {

	if ((0 <= $grade['cw1'])and($grade['cw1']<10)){$a_cw1['0']++;}
	elseif ((10 <= $grade['cw1'])and($grade['cw1']<19)) {$a_cw1['1']++;}
	elseif ((20 <= $grade['cw1'])and($grade['cw1']<29)) {$a_cw1['2']++;}
	elseif ((30 <= $grade['cw1'])and($grade['cw1']<39)) {$a_cw1['3']++;}
	elseif ((40 <= $grade['cw1'])and($grade['cw1']<49)) {$a_cw1['4']++;}
	elseif ((50 <= $grade['cw1'])and($grade['cw1']<59)) {$a_cw1['5']++;}
	elseif ((60 <= $grade['cw1'])and($grade['cw1']<69)) {$a_cw1['6']++;}
	elseif ((70 <= $grade['cw1'])and($grade['cw1']<79)) {$a_cw1['7']++;}
	elseif ((80 <= $grade['cw1'])and($grade['cw1']<89)) {$a_cw1['8']++;}
	elseif ((90 <= $grade['cw1'])and($grade['cw1']<101)) {$a_cw1['9']++;}

$cw1grades[] = $grade['cw1'];

	if ((0 <= $grade['cw2'])and($grade['cw2']<10)){$a_cw2['0']++;}
	elseif ((10 <= $grade['cw2'])and($grade['cw2']<19)) {$a_cw2['1']++;}
	elseif ((20 <= $grade['cw2'])and($grade['cw2']<29)) {$a_cw2['2']++;}
	elseif ((30 <= $grade['cw2'])and($grade['cw2']<39)) {$a_cw2['3']++;}
	elseif ((40 <= $grade['cw2'])and($grade['cw2']<49)) {$a_cw2['4']++;}
	elseif ((50 <= $grade['cw2'])and($grade['cw2']<59)) {$a_cw2['5']++;}
	elseif ((60 <= $grade['cw2'])and($grade['cw2']<69)) {$a_cw2['6']++;}
	elseif ((70 <= $grade['cw2'])and($grade['cw2']<79)) {$a_cw2['7']++;}
	elseif ((80 <= $grade['cw2'])and($grade['cw2']<89)) {$a_cw2['8']++;}
	elseif ((90 <= $grade['cw2'])and($grade['cw2']<101)) {$a_cw2['9']++;}

$cw2grades[] = $grade['cw2'];

	if ((0 <= $grade['cw3'])and($grade['cw3']<10)){$a_cw3['0']++;}
	elseif ((10 <= $grade['cw3'])and($grade['cw3']<19)) {$a_cw3['1']++;}
	elseif ((20 <= $grade['cw3'])and($grade['cw3']<29)) {$a_cw3['2']++;}
	elseif ((30 <= $grade['cw3'])and($grade['cw3']<39)) {$a_cw3['3']++;}
	elseif ((40 <= $grade['cw3'])and($grade['cw3']<49)) {$a_cw3['4']++;}
	elseif ((50 <= $grade['cw3'])and($grade['cw3']<59)) {$a_cw3['5']++;}
	elseif ((60 <= $grade['cw3'])and($grade['cw3']<69)) {$a_cw3['6']++;}
	elseif ((70 <= $grade['cw3'])and($grade['cw3']<79)) {$a_cw3['7']++;}
	elseif ((80 <= $grade['cw3'])and($grade['cw3']<89)) {$a_cw3['8']++;}
	elseif ((90 <= $grade['cw3'])and($grade['cw3']<101)) {$a_cw3['9']++;}

$cw3grades[] = $grade['cw3'];

	if ((0 <= $grade['cw4'])and($grade['cw4']<10)){$a_cw4['0']++;}
	elseif ((10 <= $grade['cw4'])and($grade['cw4']<19)) {$a_cw4['1']++;}
	elseif ((20 <= $grade['cw4'])and($grade['cw4']<29)) {$a_cw4['2']++;}
	elseif ((30 <= $grade['cw4'])and($grade['cw4']<39)) {$a_cw4['3']++;}
	elseif ((40 <= $grade['cw4'])and($grade['cw4']<49)) {$a_cw4['4']++;}
	elseif ((50 <= $grade['cw4'])and($grade['cw4']<59)) {$a_cw4['5']++;}
	elseif ((60 <= $grade['cw4'])and($grade['cw4']<69)) {$a_cw4['6']++;}
	elseif ((70 <= $grade['cw4'])and($grade['cw4']<79)) {$a_cw4['7']++;}
	elseif ((80 <= $grade['cw4'])and($grade['cw4']<89)) {$a_cw4['8']++;}
	elseif ((90 <= $grade['cw4'])and($grade['cw4']<101)) {$a_cw4['9']++;}

$cw4grades[] = $grade['cw4'];

	if ((0 <= $grade['exam'])and($grade['exam']<10)){$a_exam['0']++;}
	elseif ((10 <= $grade['exam'])and($grade['exam']<19)) {$a_exam['1']++;}
	elseif ((20 <= $grade['exam'])and($grade['exam']<29)) {$a_exam['2']++;}
	elseif ((30 <= $grade['exam'])and($grade['exam']<39)) {$a_exam['3']++;}
	elseif ((40 <= $grade['exam'])and($grade['exam']<49)) {$a_exam['4']++;}
	elseif ((50 <= $grade['exam'])and($grade['exam']<59)) {$a_exam['5']++;}
	elseif ((60 <= $grade['exam'])and($grade['exam']<69)) {$a_exam['6']++;}
	elseif ((70 <= $grade['exam'])and($grade['exam']<79)) {$a_exam['7']++;}
	elseif ((80 <= $grade['exam'])and($grade['exam']<89)) {$a_exam['8']++;}
	elseif ((90 <= $grade['exam'])and($grade['exam']<101)) {$a_exam['9']++;}

$examgrades[] = $grade['exam'];

}

$cw1mean = mean($cw1grades);
$cw2mean = mean($cw2grades);
$cw3mean = mean($cw3grades);
$cw4mean = mean($cw4grades);
$exammean = mean($examgrades);

$overall_grades = array($cw1mean, $cw2mean, $cw3mean, $cw4mean, $exammean);

$overallmean = mean($overall_grades);

$cw1median = median($cw1grades);
$cw2median = median($cw2grades);
$cw3median = median($cw3grades);
$cw4median = median($cw4grades);
$exammedian = median($examgrades);
$overallmedian = median($overall_grades);

$cw1dev = standard_deviation($cw1grades);
$cw2dev = standard_deviation($cw2grades);
$cw3dev = standard_deviation($cw3grades);
$cw4dev = standard_deviation($cw4grades);
$examdev = standard_deviation($examgrades);
$overalldev = standard_deviation($overall_grades);


$tier0 = array($a_cw1['0'], $a_cw2['0'], $a_cw3['0'], $a_cw4['0'], $a_exam['0']);
$tier1 = array($a_cw1['1'], $a_cw2['1'], $a_cw3['1'], $a_cw4['1'], $a_exam['1']);
$tier2 = array($a_cw1['2'], $a_cw2['2'], $a_cw3['2'], $a_cw4['2'], $a_exam['2']);
$tier3 = array($a_cw1['3'], $a_cw2['3'], $a_cw3['3'], $a_cw4['3'], $a_exam['3']);
$tier4 = array($a_cw1['4'], $a_cw2['4'], $a_cw3['4'], $a_cw4['4'], $a_exam['4']);
$tier5 = array($a_cw1['5'], $a_cw2['5'], $a_cw3['5'], $a_cw4['5'], $a_exam['5']);
$tier6 = array($a_cw1['6'], $a_cw2['6'], $a_cw3['6'], $a_cw4['6'], $a_exam['6']);
$tier7 = array($a_cw1['7'], $a_cw2['7'], $a_cw3['7'], $a_cw4['7'], $a_exam['7']);
$tier8 = array($a_cw1['8'], $a_cw2['8'], $a_cw3['8'], $a_cw4['8'], $a_exam['8']);
$tier9 = array($a_cw1['9'], $a_cw2['9'], $a_cw3['9'], $a_cw4['9'], $a_exam['9']);

$overall = array(0,0,0,0,0,0,0,0,0,0);
$overall['0'] = array_sum($tier0);
$overall['1'] = array_sum($tier1);
$overall['2'] = array_sum($tier2);
$overall['3'] = array_sum($tier3);
$overall['4'] = array_sum($tier4);
$overall['5'] = array_sum($tier5);
$overall['6'] = array_sum($tier6);
$overall['7'] = array_sum($tier7);
$overall['8'] = array_sum($tier8);
$overall['9'] = array_sum($tier9);

$stcount = count($grades);

echo "
</div>
	<div id='main' class='col-md-10'>";
	echo resultBlock($errors,$successes);
	echo "<div id='regbox'>"; 

ob_start();

		echo"<h1>Course Monitoring Report</h1>
		<table class='table table-bordered'>
		<tr><td>Academic Session:</td><td>$year</td></tr>
		<tr><td>Course Code:</td><td>$code</td></tr>
		<tr><td>Course Title:</td><td>$name</td></tr>
		<tr><td>Course Leader:</td><td>$loggedInUser->displayname</td></tr>
		<tr><td>Student Count:</td><td>$stcount</td></tr>
		</table>
		<table class='table table-bordered'>
		<thead><th colspan='7'>STATISTICS</th></thead>
		<tr><td></td><td>CW1</td><td>CW2</td><td>CW3</td><td>CW4</td><td>EXAM</td><td>OVERALL</td></tr>
		<tr><td>Mean</td><td>$cw1mean</td><td>$cw2mean</td><td>$cw3mean</td><td>$cw4mean</td><td>$exammean</td><td>$overallmean</td></tr>
		<tr><td>Median</td><td>$cw1median</td><td>$cw2median</td><td>$cw3median</td><td>$cw4median</td><td>$exammedian</td><td>$overallmedian</td></tr>
		<tr><td>Standard<br />Deviation</td><td>$cw1dev</td><td>$cw2dev</td><td>$cw3dev</td><td>$cw4dev</td><td>$examdev</td><td>$overalldev</td></tr>
		</table>
		<table class='table table-hover table-condensed table-cmr'><thead>
			<tr><th class='cmrtop'></th><th>0 - 9</th><th>10 - 19</th><th>20 - 29</th><th>30 - 39</th><th>40 - 49</th><th>50 - 59</th><th>60 - 69</th><th>70 - 79</th><th>80 - 89</th><th>90 +</th></tr></thead><tbody><tr><td>CW1</td>";
		foreach ($a_cw1 as $gradecount) {echo "<td>$gradecount</td>";}
	echo"</tr><tr><td>CW2</td>";
		foreach ($a_cw2 as $gradecount) {echo "<td>$gradecount</td>";}
	echo"</tr><tr><td>CW3</td>";
		foreach ($a_cw3 as $gradecount) {echo "<td>$gradecount</td>";}
	echo"</tr><tr><td>CW4</td>";
		foreach ($a_cw4 as $gradecount) {echo "<td>$gradecount</td>";}
	echo"</tr><tr><td>EXAM</td>";
		foreach ($a_exam as $gradecount) {echo "<td>$gradecount</td>";}
	echo"</tr><tr><td>OVERALL</td>";
		foreach ($overall as $gradecount) {echo "<td>$gradecount</td>";}

echo"</tr></tbody></table>";

$content = ob_get_contents();
$content = addslashes($content);

if (isset($_POST['submit'])) {
	$today = date("Y-m-d");
	$addcmr = $mysqli->prepare("INSERT INTO cmr (`cl_name`, `course_code`, `cmr_timestamp`, `cmr_content`) VALUES ('$loggedInUser->displayname', '$code', '$today', '$content');");
	$addcmr->execute();
	$addcmr->close();
}

echo"<form class='form-horizontal' action='".$_SERVER['PHP_SELF']."' method='post'>
		<fieldset>
		<!-- Textarea -->
			<input type='hidden' name='course_code' value='".$code."' />
			<input type='hidden' name='ayear' value='".$year."' />
		<!-- Button -->
		<div class='form-group'>
		  <div class='col-md-4'>
		    <button id='submit' name='submit' class='btn btn-success'>Submit for approval</button>
		  </div>
		</div>

		</fieldset>
		</form>
	</div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";