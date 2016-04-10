<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

$code = $_POST['course_code'];
$year = $_POST['ayear'];

if (isset($_POST['send'])) {
	$successes[]=lang("CMR_ADDED");
}

$getgrades = $mysqli->prepare("SELECT  cw1, cw2, cw3, cw4, exam from gradestring where course_code='$code' and year(`timestamp`)=$year;");
$getgrades->execute();
$getgrades->bind_result($cw1, $cw2, $cw3, $cw4, $exam);
while ($getgrades->fetch()) {
	$grades[] = array('cw1' => $cw1,'cw2' => $cw2,'cw3' => $cw3,'cw4' => $cw4,'exam' => $exam);
}
$getgrades->close();

$getcoursename = $mysqli->prepare("SELECT course_name, cm_name, cl_name from course where course_code = '$code'");
$getcoursename->execute();
$getcoursename->bind_result($name, $cm, $cl);
while ($getcoursename->fetch()) {
	$name = $name;
	$cm = $cm;
	$cl = $cl;
}
$getcoursename->close();

$a_cw1 = array();
$a_cw2 = array();
$a_cw3 = array();
$a_cw4 = array();
$a_exam = array();

foreach ($grades as $gradestring => $grade) {

	for ($i=0; $i < 10; $i++) {{$a_cw1[$i]=0;} if (($i*10 <= $grade['cw1'])and($grade['cw1']<$i*10+10)){$a_cw1[$i]++;}}
	for ($i=0; $i < 10; $i++) {{$a_cw2[$i]=0;} if (($i*10 <= $grade['cw2'])and($grade['cw2']<$i*10+10)){$a_cw2[$i]++;}}
	for ($i=0; $i < 10; $i++) {{$a_cw3[$i]=0;} if (($i*10 <= $grade['cw3'])and($grade['cw3']<$i*10+10)){$a_cw3[$i]++;}}
	for ($i=0; $i < 10; $i++) {{$a_cw4[$i]=0;} if (($i*10 <= $grade['cw4'])and($grade['cw4']<$i*10+10)){$a_cw4[$i]++;}}
	for ($i=0; $i < 10; $i++) {{$a_exam[$i]=0;} if (($i*10 <= $grade['exam'])and($grade['exam']<$i*10+10)){$a_exam[$i]++;}}

	$cw1grades[] = $grade['cw1'];
	$cw2grades[] = $grade['cw2'];
	$cw3grades[] = $grade['cw3'];
	$cw4grades[] = $grade['cw4'];
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

for ($i=0; $i < 10; $i++) { $tier[] = array($a_cw1[$i], $a_cw2[$i], $a_cw3[$i], $a_cw4[$i], $a_exam[$i]); }

for ($i=0; $i < 10; $i++) { $overall[$i] = array_sum($tier[$i]); }

$stcount = count($grades);
$overall_str = "";
foreach ($overall as $key) {
	$overall_str .= "$key, ";
}

echo "
</div>
	<div id='main' class='col-md-10'>";
	echo resultBlock($errors,$successes);
	echo "<div id='regbox'>";

ob_start();

		echo"<h1>Course Monitoring Report</h1><script type='text/javascript' src='chart/Chart.js'></script><h3>Number of students who achieved a certain grade:</h3><canvas id='myChart' width='600' height='200'></canvas><br /><br /><h3>Courseworks / Exam means:</h3><canvas id='myChart1' width='600' height='200'></canvas><br /><br />
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var data = {
    labels: ['0 - 9', '10 - 19', '20 - 29', '30 - 39', '40 - 49', '50 - 59', '60 - 69', '70 - 79', '80 - 89', '90 +'],
    datasets: [
        {
            label: 'My First dataset',
            fillColor: 'rgba(220,220,220,0.2)',
            strokeColor: 'rgba(220,220,220,1)',
            pointColor: 'rgba(220,220,220,1)',
            pointStrokeColor: '#fff',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [$overall_str]
        }
    ]
};
var myLineChart = new Chart(ctx).Line(data, {scaleFontColor: '#fff'});

var ctx = document.getElementById('myChart1').getContext('2d');
var data = {
    labels: ['CW1', 'CW2', 'CW3', 'CW4', 'EXAM'],
    datasets: [
        {
            label: 'My First dataset',
            fillColor: 'rgba(220,220,220,0.2)',
            strokeColor: 'rgba(220,220,220,1)',
            pointColor: 'rgba(220,220,220,1)',
            pointStrokeColor: '#fff',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [$cw1mean, $cw2mean, $cw3mean, $cw4mean, $exammean]
        }
    ]
};
var myLineChart1 = new Chart(ctx).Line(data, {
        scaleOverride : true,
        scaleSteps : 10,
        scaleStepWidth : 10,
        scaleStartValue : 0,
        scaleFontColor: '#fff'
    });
</script>
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

if (isset($_POST['send'])) {
	$today = date("Y-m-d");
	$comment = $_POST['comment'];
	$actions = $_POST['actions'];
	$addcmr = $mysqli->prepare("INSERT INTO cmr (`cl_name`, `course_code`, `cmr_timestamp`, `cmr_content`, `comment`, `actions`,`status`,`cm_name`) VALUES ('$loggedInUser->displayname', '$code', '$today', '$content', '$comment', '$actions','pending','$cm');");
	$addcmr->execute();
	$curid = $addcmr->insert_id();
	$addcmr->close();

	$getcmmail = $mysqli->prepare("SELECT email from uc_users where display_name = '$cm'");
	$getcmmail->execute();
	$getcmmail->bind_result($to);
	while ($getcmmail->fetch()) {
		$to = $to;
	}
	$getcmmail->close();

	$subject = "[BT.GA] - CMR for $code from $today";

	$message = "<!DOCTYPE html><html><head><style>table{border:2px dotted grey;}</style></head><body>$content<p><h2>General Comment:</h2>$comment</p><p><h2>Actions to be taken:</h2>$actions</p><p><a href='http://bullytrack.ga/viewcmr?id=$curid'>View CMR in browser</a></p></body></html>";

	$headers = "From: bot@bullytrack.ga\r\nReply-To: bot@bullytrack.ga\r\nContent-type:text/html;charset=UTF-8\r\n";

	$sendcmr = mail($to, $subject, $message, $headers);
}

echo"<form class='form-horizontal' action='".$_SERVER['PHP_SELF']."' method='post'>
		<fieldset>
		<!-- Textarea -->
			<input type='hidden' name='course_code' value='".$code."' />
			<input type='hidden' name='ayear' value='".$year."' />

		<div>
			<h4>When you complete this section, at a minimum, you should address the following:</h4>
			<ol>
			<li>The overview of the Course Leader (to include comments on available statistics, the range of marks,<br />assessment diet and any issues affecting the delivery of the course this year).</li>
			<li>Student Evaluation and Feedback.</li>
			<li>Comments of the External Examiner.</li>
			<li>A review of the previous year’s action plan.</li>
			</ol>
		</div>

		<div class='form-group'>
		  <label class='col-md-12' for='comment'>General comment:</label>
		  <label class='col-md-2' for='comment'></label>
		  <div class='col-md-8'>                     
		    <textarea class='form-control' id='comment' name='comment' rows='10'></textarea>
		  </div>
		</div>

		<div class='form-group'>
		  <label class='col-md-12' for='actions'>Actions to be taken:</label>
		  <label class='col-md-2' for='actions'></label>
		  <div class='col-md-8'>                     
		    <textarea class='form-control' id='actions' name='actions' rows='10'></textarea>
		  </div>
		</div>

		<!-- Button -->
		<div class='form-group'>
		  <label class='col-md-2' for='send'></label>
		  <div class='col-md-4'><br />
		    <button id='send' name='send' class='btn btn-success'>Submit for approval</button>
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