<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

if (!empty($_POST)) {
	$deletions = $_POST['delete'];
	if ($deletion_count = deleteFaculties($deletions)){
		$successes[] = lang("FACULTY_DELETIONS_SUCCESSFUL", array($deletion_count));
	}
	else {
		$errors[] = lang("SQL_ERROR");
	}
}

$getfaculties = $mysqli->prepare("SELECT
	faculty_id,
	faculty_name, pvc_name, dlt_name FROM faculty");
$getfaculties->execute();
$getfaculties->bind_result($faculty_id, $faculty_name, $pvc_name, $dlt_name);
while ($getfaculties->fetch()){
	$faculties[] = array('faculty_id' => $faculty_id, 'faculty_name' => $faculty_name, 'pvc_name' => $pvc_name, 'dlt_name' => $dlt_name);
	}
$getfaculties->close();

echo "
</div>
	<div id='main' class='col-md-10'>";
	echo resultBlock($errors,$successes);
	echo "
		<div id='regbox'><h1>Faculties of Geylang Academy:</h1>
		<form name='adminFaculties' action='".$_SERVER['PHP_SELF']."' method='post'>
		<table class='table'><thead><tr><th></th><th>ID</th><th>Faculty Name</th><th>PVC</th><th>DLT</th></tr></thead><tbody>";
		if (isset($faculties)) {
			foreach ($faculties as $faculty) {
				echo "<tr><td><input type='checkbox' name='delete[".$faculty['faculty_id']."]' id='delete[".$faculty['faculty_id']."]' value='".$faculty['faculty_id']."'></td><td>".$faculty['faculty_id']."</td><td><a method='GET' href='admin_faculty.php?fid=".$faculty['faculty_id']."'>".$faculty['faculty_name']."</a></td><td>".$faculty['pvc_name']."</td><td>".$faculty['dlt_name']."</td></tr>";
			}
		}
echo"	</tbody></table>
		<input type='submit' name='Submit' value='Delete' class='btn btn-danger' />&nbsp;<a href='admin_create_f.php' class='btn'>Add Faculty</a>
		</form>
		</div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>