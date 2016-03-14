<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

$id=$_GET['id'];

$getcmr = $mysqli->prepare("SELECT cmr_content, comment, actions from cmr where cmr_id='$id';");
$getcmr->execute();
$getcmr->bind_result($content, $comment, $actions);
while ($getcmr->fetch()) {
	$content = stripcslashes($content);
    $cmr = array('content' => $content, 'comment' => $comment, 'actions' => $actions);
}
$getcmr->close();

if (isset($_POST['approve'])) {
	$decline = $mysqli->prepare("UPDATE cmr SET `status`='declined' WHERE `cmr_id`='$id';");
	$decline->execute();
	$decline->close();
	$successes[] = lang("APPROVED");
} elseif (isset($_POST['decline'])) {
	$approve = $mysqli->prepare("UPDATE cmr SET `status`='approved' WHERE `cmr_id`='$id';");
	$approve->execute();
	$approve->close();
	$successes[] = lang("DECLINED");
}

echo "
</div>
	<div id='main' class='col-md-10'>";
	echo resultBlock($errors,$successes);
	echo "
		<div id='regbox'>";
echo "".$cmr['content']."<br /><h3>General comment:</h3>".$cmr['comment']."<br /><h3>Actions to be taken:</h3>".$cmr['actions']."";
if ($loggedInUser->checkPermission(array(5))){
echo "<form class='form-horizontal' action='".$_SERVER['PHP_SELF']."?id=$id' method='post'>
		<fieldset>

		<!-- Button (Double) -->
		<div class='form-group'>
		  <label class='col-md-4 control-label' for='approve'></label>
		  <div class='col-md-8'>
		    <button id='approve' name='approve' class='btn btn-success'>Approve</button>
		    <button id='decline' name='decline' class='btn btn-danger'>Decline</button>
		  </div>
		</div>

		</fieldset>
		</form>";
		}
echo"	</div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";