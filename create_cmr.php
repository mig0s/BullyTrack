<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

$getcourses = $mysqli->prepare("SELECT course_code, course_name from course where cl_name = '$loggedInUser->displayname'");
$getcourses->execute();
$getcourses->bind_result($code, $name);
while ($getcourses->fetch()) {
	$courses[] = array('course_code' => $code, 'course_name' => $name);
}
$getcourses->close();

$getyears = $mysqli->prepare("SELECT YEAR(`timestamp`) as year from gradestring");
$getyears->execute();
$getyears->bind_result($y);
while ($getyears->fetch()) {
	$years[] = $y;
}
$getyears->close();
$years = array_unique($years);
echo "
</div>
	<div id='main' class='col-md-10'>";
	echo resultBlock($errors,$successes);
	echo "
		<div id='regbox'><h1>Generate CMR:</h1>
		<form class='form-horizontal' action='clview.php' method='POST'>
		<fieldset>

		<!-- Select Basic -->
		<div class='form-group'>
		  <label class='col-md-2 control-label' for='course_code'>Course:</label>
		  <div class='col-md-4'>
		    <select id='course_code' name='course_code' class='form-control'>
		      <option value=''>- select course -</option>";
		      foreach ($courses as $course) {
		      	echo "<option value='".$course['course_code']."'>".$course['course_name']."</option>";
		      }
		echo "</select>
		  </div>
		</div>

		<!-- Select Basic -->
		<div class='form-group'>
		  <label class='col-md-2 control-label' for='ayear'>Academic year:</label>
		  <div class='col-md-4'>
		    <select id='ayear' name='ayear' class='form-control'>
		      <option value=''>- select year -</option>";
		      foreach ($years as $year) {
		      	echo "<option value='$year'>$year</option>";
		      }

		echo "</select>
		  </div>
		</div>

		<!-- Button -->
		<div class='form-group'>
		  <label class='col-md-2 control-label' for='submit'></label>
		  <div class='col-md-4'>
		    <button id='submit' name='submit' class='btn btn-info'>Generate report</button>
		  </div>
		</div>

		</fieldset>
		</form>
";

echo"	</div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";