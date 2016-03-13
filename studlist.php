<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

$cCode = $_GET['ccode'];

require_once("models/header.php");

$getstudents = $mysqli->prepare("SELECT student_id, student_name FROM student_particular where student_id in (SELECT student_id FROM student_courses WHERE course_code = '".$cCode."' );");
$getstudents->execute();
$getstudents->bind_result($student_id, $student_name);

while ($getstudents->fetch()){
	$students[] = array('student_id' => $student_id, 'student_name' => $student_name);
	}

$getstudents->close();

echo "
</div>
	<div id='main' class='col-md-10'>
		<div id='regbox'><h1>Students assigned to $cCode:</h1>
		<table class='table table-bordered'><thead><tr><th>ID</th><th>Student name</th></tr></thead><tbody>";

foreach ($students as $student) {
	echo "<tr><td>".$student['student_id']."</td><td><a method='GET' href='cgd.php?stid=".$student['student_id']."&ccode=$cCode'>".$student['student_name']."</a></td></tr>";
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