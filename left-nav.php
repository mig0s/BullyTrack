<?php
if (!securePage($_SERVER['PHP_SELF'])){die();}
//Links for logged in user
if(isUserLoggedIn()) {
	echo "<ul>
	<li><b>Logged in as:</b><br /> $loggedInUser->displayname</li>
	<li>&nbsp</li>";
	if ($loggedInUser->checkPermission(array(2))){
	echo "
	<li><b>Admin Menu:</b></li>
	<li><a href='admin_courses.php'>Courses</a></li>
	<li><a href='admin_faculties.php'>Faculties</a></li>
	<li><a href='admin_users.php'>Users</a></li>
	<li><a href='admin_permissions.php'>Permissions</a></li>
	<li><a href='admin_pages.php'>Pages</a></li>
	<li><a href='admin_st_list.php'>Students</a></li>
	<li><a href='report.php'>Report</a></li>";
	}
	if ($loggedInUser->checkPermission(array(3))){
	echo "
	<li><b>PVC menu:</b></li>
	<li><a href='allcmrs.php'>All CMRs</a></li>";
	}
	if ($loggedInUser->checkPermission(array(4))){
	echo "
	<li><b>CL menu:</b></li>
	<li><a href='cllist.php'>My CMRs</a></li>
	<li><a href='create_cmr.php'>Create CMR</a></li>";
	}
	if ($loggedInUser->checkPermission(array(5))){
	echo "
	<li><b>CM menu:</b></li>
	<li><a href='cmlist.php'>My CMRs</a></li>";
	}
	if ($loggedInUser->checkPermission(array(6))){
	echo "
	<li><b>DLT menu:</b></li>
	<li><a href='allcmrs.php'> All CMRs</a></li>
	<li><a href='pendingcmrs.php'>Pending CMRs</a></li>";
	}
	if ($loggedInUser->checkPermission(array(7))){
	echo "
	<li><b>Lecturer menu:</b></li>
	<li><a href='courses.php'>My courses</a></li>";
	}
	if ($loggedInUser->checkPermission(array(1))){
	echo "
	<li><b>Guest menu:</b></li>
	<li><a href='allcmrs.php'>Approved CMRs</a></li>
	<li><a href='report.php'>Report</a></li>";
	}
	echo "<li>&nbsp</li><li><a href='user_settings.php'>My Settings</a></li>
	<li><a href='logout.php'>Logout</a></li></ul>";
} 
//Links for users not logged in
else {
	echo "<ul>
	<li><i>Menu not applicable</i></li>";
	if ($emailActivation)
	{
	echo "<li><a href='resend-activation.php'>Resend Activation Email</a></li>";
	}
	echo "</ul>";
}
?>
