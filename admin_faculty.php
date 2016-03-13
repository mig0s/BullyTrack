<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

$fid = $_GET['fid'];

if (!empty($_POST)) {
	$fname = trim($_POST["fname"]);
	$pvcname = trim($_POST["pvcname"]);
	$dltname = trim($_POST["dltname"]);


if (!empty($fname) and !empty($pvcname) and !empty($dltname)){
	$addfac = $mysqli->prepare("UPDATE faculty SET faculty_name='$fname',pvc_name='$pvcname',dlt_name='$dltname' WHERE faculty_id='$fid';");
	$addfac->execute();
	$addfac->close();
	
	$successes[] = lang("FACULTY_UPDATED");
	} else {
		$errors[] = lang("WRONG_DATA");
	}
}
$getpvcs = $mysqli->prepare("SELECT display_name FROM uc_users where id in (select user_id from uc_user_permission_matches where permission_id = '3');");
$getpvcs->execute();
$getpvcs->bind_result($pvc_name);
while ($getpvcs->fetch()){
	$pvcs[] = $pvc_name;
	}
$getpvcs->close();

$getdlts = $mysqli->prepare("SELECT display_name FROM uc_users where id in (select user_id from uc_user_permission_matches where permission_id = '6')");
$getdlts->execute();
$getdlts->bind_result($dlt_name);
while ($getdlts->fetch()){
	$dlts[] = $dlt_name;
	}
$getdlts->close();

$getname = $mysqli->prepare("SELECT faculty_name FROM faculty WHERE faculty_id='$fid'");
$getname->execute();
$getname->bind_result($facname);
while ($getname->fetch()){
	$fname=$facname;}
$getname->close();
echo "
</div>
	<div id='main' class='col-md-10'>";
	echo resultBlock($errors,$successes);
	echo "
		<div id='regbox'><h1>Update Faculty:</h1>

		<form class='form-horizontal' action='".$_SERVER['PHP_SELF']."?fid=$fid' method='post'>
		<fieldset>

		<!-- Text input-->
		<div class='form-group'>
		  <label class='col-md-2 control-label' for='fname'>Faculty name:</label>  
		  <div class='col-md-6'>
		  <input id='fname' name='fname' value='$fname' class='form-control input-md' required=' type='text'>
		    
		  </div>
		</div>

		<!-- Select Basic -->
		<div class='form-group'>
		  <label class='col-md-2 control-label' for='pvcname'>PVC:</label>
		  <div class='col-md-6'>
		    <select id='pvcname' name='pvcname' class='form-control'>
		    <option value=''> - select PVC - </option>";

		    foreach ($pvcs as $pvc) {
		    	echo "<option value='$pvc'>$pvc</option>";
		    }


echo"
		    </select>
		  </div>
		</div>

		<!-- Select Basic -->
		<div class='form-group'>
		  <label class='col-md-2 control-label' for='dltname'>DLT:</label>
		  <div class='col-md-6'>
		    <select id='dltname' name='dltname' class='form-control'>
		    <option value=''> - select DLT - </option>";

		    foreach ($dlts as $dlt) {
		    	echo "<option value='$dlt'>$dlt</option>";
		    }


echo"
		    </select>
		  </div>
		</div>

		<!-- Button -->
		<div class='form-group'>
		  <label class='col-md-2 control-label' for='submit'></label>
		  <div class='col-md-6'>
		    <button id='submit' name='submit' class='btn btn-success'>Submit</button>
		  </div>
		</div>

		</fieldset>
		</form>";
echo"
		</div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>