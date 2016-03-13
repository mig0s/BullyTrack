<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

if (!empty($_POST)) {
	$deletions = $_POST['delete'];
	print_r($deletions);
	if ($deletion_count = deleteCourses($deletions)){
		$successes[] = lang("COURSE_DELETIONS_SUCCESSFUL", array($deletion_count));
	}
	else {
		$errors[] = lang("SQL_ERROR");
	}
}

$getcourses = $mysqli->prepare("SELECT course_code, lecturer_name, cl_name, cm_name, course_name, faculty_id FROM course");
$getcourses->execute();
$getcourses->bind_result($course_code, $lecturer_name, $cl_name, $cm_name, $course_name, $faculty_id);
while ($getcourses->fetch()){
	$courses[] = array('course_code' => $course_code,'lecturer_name' => $lecturer_name,'cl_name' => $cl_name,'cm_name' => $cm_name, 'course_name' => $course_name, 'faculty_id' => $faculty_id, 'faculty_name' => 'undefined');
	}
$getcourses->close();

echo "
</div>
	<div id='main' class='col-md-10'>";
	echo resultBlock($errors,$successes);
	echo "
		<div id='regbox'><h1>Courses of Geylang Academy:</h1>
		<form name='admincourses' action='".$_SERVER['PHP_SELF']."' method='post'>
		<table class='table'><thead><tr><th></th><th>Code</th><th>Course Name</th><th>Lecturer</th><th>Leader</th><th>Moderator</th><th>Faculty</th></tr></thead><tbody>";
		if (isset($courses)) {
			foreach ($courses as $course) {
			$getfacultyname = $mysqli->prepare("SELECT faculty_name FROM faculty WHERE faculty_id=".$course['faculty_id'].";");
			$getfacultyname->execute();
			$getfacultyname->bind_result($faculty_name);
			while ($getfacultyname->fetch()) {
				$course['faculty_name'] = $faculty_name;
			}
			$getfacultyname->close();
			echo "<tr><td><input type='checkbox' name='delete[".$course['course_code']."]' id='delete[".$course['course_code']."]' value='".$course['course_code']."'></td><td>".$course['course_code']."</td><td><a method='GET' href='admin_course.php?cid=".$course['course_code']."'>".$course['course_name']."</a></td><td>".$course['lecturer_name']."</td><td>".$course['cl_name']."</td><td>".$course['cm_name']."</td><td>".$course['faculty_name']."</td></tr>";
			}
		}
echo"	</tbody></table>
		<input type='submit' name='Submit' value='Delete' class='btn btn-danger' />&nbsp;<a href='admin_create_c.php' class='btn'>Add course</a>
		</form>
		</div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>