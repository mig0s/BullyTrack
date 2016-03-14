<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

if (!empty($_POST)) {
	$deletions = $_POST['delete'];
	if ($deletion_count = deleteStudents($deletions)){
		$successes[] = lang("STUDENT_DELETIONS_SUCCESSFUL", array($deletion_count));
	}
	else {
		$errors[] = lang("SQL_ERROR");
	}
}

$getstudents = $mysqli->prepare("SELECT * from student_particular");
$getstudents->execute();
$getstudents->bind_result($id, $name, $dob, $gender, $nationality, $disability);
while ($getstudents->fetch()) {
	$students[] = array('id' => $id, 'name' => $name, 'dob' => $dob, 'gender' => $gender, 'nationality' => $nationality, 'disability' => $disability);
}
$getstudents->close();

echo "
</div>
	<div id='main' class='col-md-10'><h2>Students of Geylang Academy:</h2>
	<form name='adminStudents' action='".$_SERVER['PHP_SELF']."' method='post'><table class='table'>
	<thead><th></th><th>ID</th><th>Name</th><th>Date of birth</th><th>Gender</th><th>Nationality</th><th>Disabilities</th><th></th></thead><tbody>";
	echo resultBlock($errors,$successes);

foreach ($students as $student) {

	echo "<tr><td><input type='checkbox' name='delete[".$student['id']."]' id='delete[".$student['id']."]' value='".$student['id']."'></td><td>".$student['id']."</td><td><a href='admin_edit_s.php?stid=".$student['id']."'>".$student['name']."</a></td><td>".$student['dob']."</td><td>".$student['gender']."</td><td>".$student['nationality']."</td><td>".$student['disability']."</td><td><a href='enroll.php?stid=".$student['id']."'>Enroll</a></td></tr>";
}

echo"	</tbody></table>
		<input type='submit' name='Submit' value='Delete' class='btn btn-danger' />&nbsp;
		<a href='admin_addstudent.php' class='btn'>Add Student</a><h4><br /></h4>
		</form></div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";