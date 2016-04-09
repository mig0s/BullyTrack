<?php
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
    	header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}
//Links for logged in user
if(isUserLoggedIn()) {
	//Links for permission level 2 (default admin)
	if ($loggedInUser->checkPermission(array(2))){
		Redirect('report.php', false);
	}
	if ($loggedInUser->checkPermission(array(3))){
		Redirect('allcmrs.php', false);
	}
	if ($loggedInUser->checkPermission(array(4))){
		Redirect('cllist.php', false);
	}
	if ($loggedInUser->checkPermission(array(5))){
		Redirect('cmlist.php', false);
	}
	if ($loggedInUser->checkPermission(array(6))){
		Redirect('allcmrs.php', false);
	}
	if ($loggedInUser->checkPermission(array(7))){
		Redirect('allcmrs.php', false);
	}
	if ($loggedInUser->checkPermission(array(7))){
		Redirect('courses.php', false);
	}
} 
else {
	Redirect('index.php', false);
}
?>