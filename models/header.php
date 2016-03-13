<?php

echo "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<link rel='shortcut icon' href='favicon.ico'/>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>".$websiteName."</title>
<link href='".$template."' rel='stylesheet' type='text/css' />
<link rel='stylesheet' href='models/site-templates/bootstrap.min.css' />
<script src='models/jquery-2.1.4.min.js' type='text/javascript'></script>
<script src='models/funcs.js' type='text/javascript'></script>
</head>
<body>
<a href='#content' class='scrollToTop'></a>
<div id='wrapper' class='container'>
	<br /><br /><br />
	<div class='row head'>
		<div class='col-md-3 logodiv'>
			<img class='logo' src='pic/banner.png' />
		</div>
		<div class='col-md-6'>
			<h1 style='text-align: center;'>Geylang Academy<br />Course Monitoring System</h1>
		</div>
		<div class='col-md-3 logodiv'>
			<img class='logo' src='pic/bbanner.png' />
		</div>
	</div>
<div id='content' class='row'>

<div id='left-nav' class='col-md-2 menu'>";

include("left-nav.php");

?>
