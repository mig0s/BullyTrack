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

$userData = fetchAllUsers(); //Fetch information for all users

require_once("models/header.php");

function userCount()
{
	echo "<h2>Statistics:</h2>";
	GLOBAL $mysqli;
	$sql = "SELECT count(id) as result_count FROM uc_users";
	$result = mysqli_query($mysqli,$sql);
	$out = mysqli_fetch_assoc($result);
	echo "<h3>Users registered: ".$out[result_count]."</h3>";
	$sql = "SELECT count(id) as result_count FROM usersachieves";
	$result = mysqli_query($mysqli,$sql);
	$out = mysqli_fetch_assoc($result);
	echo "<h3>Achievements added: ".$out[result_count]."</h3>";
}

echo "
</div>
<div id='main' class='col-md-10'>";
userCount();
echo resultBlock($errors,$successes);

echo "
<form name='adminUsers' action='".$_SERVER['PHP_SELF']."' method='post'>
<h2>Users:</h2>
<table class='admin'>
<tr>
<th>Username</th><th>Display Name</th><th>Title</th><th>Last Sign In</th>
</tr>";

//Cycle through users
foreach ($userData as $v1) {
	echo "
	<tr>
	<td><a href='admin_user.php?id=".$v1['id']."'>".$v1['user_name']."</a></td>
	<td>".$v1['display_name']."</td>
	<td>".$v1['title']."</td>
	<td>
	";
	
	//Interprety last login
	if ($v1['last_sign_in_stamp'] == '0'){
		echo "Never";	
	}
	else {
		echo date("j M, Y", $v1['last_sign_in_stamp']);
	}
	echo "
	</td>
	</tr>";
}

echo "
</table><br />
<input type='submit' name='Submit' value='Delete' class='btn btn-default'/>
</form>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
