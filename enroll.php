<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

$stid=$_GET['stid'];

if (!empty($_POST['delete'])) {
	$deletions = $_POST['delete'];
	if ($deletion_count = resignFromCourses($deletions)){
		$successes[] = lang("RESIGNED", array($deletion_count));
	}
	else {
		$errors[] = lang("SQL_ERROR");
	}
}

if (!empty($_POST['add'])) {
	$additions = $_POST['add'];
	if ($addition_count = enrollToCourses($additions, $stid)){
		$successes[] = lang("ENROLLED", array($addition_count));
	}
	else {
		$errors[] = lang("SQL_ERROR");
	}
}

$getstudents = $mysqli->prepare("SELECT student_name from student_particular where student_id = '$stid';");
$getstudents->execute();
$getstudents->bind_result($name);
while ($getstudents->fetch()) {
	$name = $name;
}
$getstudents->close();

$getenrolled = $mysqli->prepare("SELECT courses_id, course_code from student_courses where student_id = '$stid';");
$getenrolled->execute();
$getenrolled->bind_result($ecid, $ecode);
while ($getenrolled->fetch()) {
	$enrolled[$ecode] = $ecid;
}
$getenrolled->close();

$getcourses = $mysqli->prepare("SELECT course_code, course_name from course;");
$getcourses->execute();
$getcourses->bind_result($code, $cname);
while ($getcourses->fetch()) {
	$courses[] = array('code' => $code, 'cname' => $cname);
}
$getcourses->close();

echo "
</div>
	<div id='main' class='col-md-10'>";
	echo resultBlock($errors,$successes);

echo "
<div id='regbox'><h3>Resign $name from courses:</h3>
<form action='".$_SERVER['PHP_SELF']."?stid=$stid' method='post'>
<table class='table'><thead><th></th><th>Course Code</th><th>Course Name</th></thead><tbody>";

foreach ($courses as $course) {
	if (isset($enrolled[$course['code']])) {
		echo "<tr><td><input type='checkbox' name='delete[".$enrolled[$course['code']]."]' id='delete[".$enrolled[$course['code']]."]' value='".$enrolled[$course['code']]."'></td><td>".$course['code']."</td><td>".$course['cname']."</td></tr>";
	}
}

echo "<tr><th colspan='3'><h3>Enroll $name to courses:</h3></th></tr><tr><th></th><th>Course Code</th><th>Course Name</th></tr>";

foreach ($courses as $course) {
	if (!isset($enrolled[$course['code']])) {
		echo "<tr><td><input type='checkbox' name='add[".$course['code']."]' id='add[".$course['code']."]' value='".$course['code']."'></td><td>".$course['code']."</td><td>".$course['cname']."</td></tr>";
	}
}

echo"</tbody></table><input type='submit' name='Submit' value='Submit' class='btn btn-info' /></form></div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";
?>