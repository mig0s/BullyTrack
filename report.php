<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
	$deletions = $_POST['delete'];
	if ($deletion_count = deleteUsers($deletions)){
		$successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
	}
	else {
		$errors[] = lang("SQL_ERROR");
	}
}

require_once("models/header.php");

function reportCount()
{
	echo "<h2>Statistics:</h2>";
	GLOBAL $mysqli;
	$sql = "SELECT count(id) as result_count FROM uc_users";
	$result = mysqli_query($mysqli,$sql);
	$out = mysqli_fetch_assoc($result);
	echo "<h3>Users registered: ".$out["result_count"]."</h3>";

	$sql = "SELECT count(cmr_id) as result_count FROM cmr";
	$result = mysqli_query($mysqli,$sql);
	$out = mysqli_fetch_assoc($result);
	echo "<h3>CMRs created: ".$out["result_count"]."</h3>";

	$sql = "SELECT count(faculty_id) as result_count FROM faculty";
	$result = mysqli_query($mysqli,$sql);
	$out = mysqli_fetch_assoc($result);
	echo "<h3>Number of faculties: ".$out["result_count"]."</h3>";
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
reportCount();
echo resultBlock($errors,$successes);

echo "<table class='table'><thead><tr><th>ID</th><th>Faculty Name</th><th>PVC</th><th>DLT</th><th>CMRs</th><th>Responded</th></tr></thead><tbody>";
		if (isset($faculties)) {
			foreach ($faculties as $faculty) {
				$sql = "SELECT count(cmr_id) as result_count FROM cmr where course_code in (SELECT course_code from course where faculty_id = '".$faculty['faculty_id']."')";
				$result = mysqli_query($mysqli,$sql);
				$out = mysqli_fetch_assoc($result);

				$sql = "SELECT count(cmr_id) as result_count FROM cmr where comment != '' and course_code in (SELECT course_code from course where faculty_id = '".$faculty['faculty_id']."')";
				$result = mysqli_query($mysqli,$sql);
				$out1 = mysqli_fetch_assoc($result);

				echo "<tr><td>".$faculty['faculty_id']."</td><td>".$faculty['faculty_name']."</td><td>".$faculty['pvc_name']."</td><td>".$faculty['dlt_name']."</td><td>".$out["result_count"]."</td><td>".$out1["result_count"]."</td></tr>";
			}
		}

echo "</tbody></table>
<button type='submit' name='Print' class='btn btn-default' onclick='window.print();'>Print</button>
</div><br />&nbsp;<br />
<div id='bottom'></div>
</div>
</body>
</html>";

?>
