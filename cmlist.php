<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

$getcmrs = $mysqli->prepare("SELECT cmr_id, course_code, cmr_timestamp, status from cmr where cm_name='$loggedInUser->displayname';");
$getcmrs->execute();
$getcmrs->bind_result($cmr_id, $coursecode, $timestamp, $status);
while ($getcmrs->fetch()) {
    $cmrs[] = array('id' => $cmr_id, 'code' => $coursecode, 'name' => 'undefined', 'time' => $timestamp, 'status' => $status);
}
$getcmrs->close();

echo "
</div>
    <div id='main' class='col-md-10'>";
    echo resultBlock($errors,$successes);
    echo "
        <div id='regbox'><h1>My reports:</h1>
        <table class='table'><thead><th>CMR ID</th><th>Course Code</th><th>Course Title</th><th>Date</th><th>Status</th></thead><tbody>";
        foreach ($cmrs as $cmr) {
                $ccode = $cmr['code'];
                $getcourses = $mysqli->prepare("SELECT course_name from course where course_code='$ccode'");
                $getcourses->execute();
                $getcourses->bind_result($course_name);
                while ($getcourses->fetch()) {
                    $cmr['name'] = $course_name;
                }
                $getcourses->close();
                $ts = $cmr['time'];
                $time = new DateTime($ts);
                $cmr['time'] = $time->format('Y-m-d');
            echo "<tr><td><a href='viewcmr.php?id=".$cmr['id']."'>".$cmr['id']."</a></td><td><a href='viewcmr.php?id=".$cmr['id']."'>".$cmr['code']."</a></td><td><a href='viewcmr.php?id=".$cmr['id']."'>".$cmr['name']."</a></td><td><a href='viewcmr.php?id=".$cmr['id']."'>".$cmr['time']."</a></td><td>".$cmr['status']."</td></tr>";
        }
echo"   </tbody></table></div>
    </div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";