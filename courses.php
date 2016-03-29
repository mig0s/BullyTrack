<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

$getcourses = $mysqli->prepare("SELECT
	course_code,
	course_name FROM course WHERE `lecturer_name`='".$loggedInUser->displayname."'");
$getcourses->execute();
$getcourses->bind_result($course_code, $course_name);
while ($getcourses->fetch()){
	$courses[] = array('course_code' => $course_code, 'course_name' => $course_name);
	}
$getcourses->close();


echo "
</div>
	<div id='main' class='col-md-10'>
		<div id='regbox'><h1>Courses assigned to $loggedInUser->displayname:</h1>
		<table class='table table-bordered'><thead><tr><th>Course code</th><th>Course name</th></tr></thead><tbody>";
		if (isset($courses)) {
			foreach ($courses as $course) {
				echo "<tr><td>".$course['course_code']."</td><td><a method='GET' href='studlist.php?ccode=".$course['course_code']."'>".$course['course_name']."</a></td></tr>";
			}
		}
echo"	</tbody></table>
		</div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>