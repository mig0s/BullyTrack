<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

$id=$_GET['id'];

$dltc = '';

$getcmr = $mysqli->prepare("SELECT cmr_content, comment, actions from cmr where cmr_id='$id';");
$getcmr->execute();
$getcmr->bind_result($content, $comment, $actions);
while ($getcmr->fetch()) {
	$content = stripcslashes($content);
    $cmr = array('content' => $content, 'comment' => $comment, 'actions' => $actions);
}
$getcmr->close();

if (isset($_POST['approve'])) {
	$decline = $mysqli->prepare("UPDATE cmr SET `status`='approved' WHERE `cmr_id`='$id';");
	$decline->execute();
	$decline->close();
	$successes[] = lang("APPROVED");
} elseif (isset($_POST['decline'])) {
	$approve = $mysqli->prepare("UPDATE cmr SET `status`='declined' WHERE `cmr_id`='$id';");
	$approve->execute();
	$approve->close();
	$successes[] = lang("DECLINED");
} 

if (isset($_POST['dltcomment'])) {
	$getexpiry = $mysqli->prepare("SELECT cmr_timestamp from cmr where cmr_id = '$id';");
	$getexpiry->execute();
	$getexpiry->bind_result($ts);
	while ($getexpiry->fetch()) {
		$ts = new DateTime("$ts");
		$expiry = $ts->add(new DateInterval('P10D'));
	}
	$getexpiry->close();

	$today = new DateTime("now");
	print_r($expiry->format('Y-m-d'));
	print_r($today->format('Y-m-d'));
 	if ($expiry > $today) {
		$dltc = $mysqli->prepare("UPDATE cmr SET `dlt_comment`='".$_POST['dltcomment']."' WHERE `cmr_id`='$id';");
		$dltc->execute();
		$dltc->close();
		$successes[] = lang("DLT_COMMENT");
 	} else {
 		$errors[] = lang("DLT_EXPIRED");
 	}

	$getdltc =$mysqli->prepare("SELECT dlt_comment from cmr where `cmr_id`='$id';");
	$getdltc->execute();
	$getdltc->bind_result($dltc);
	while ($getdltc->fetch()) {
		$dltc = $dltc;
	}
	$getdltc->close();
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
	if ($loggedInUser->checkPermission(array(6))){
		echo "<form class='form-horizontal' action='".$_SERVER['PHP_SELF']."?id=$id' method='post'><fieldset>
				<div class='form-group'>
				  <label class='col-md-12' for='comment'>DLT Comment:</label>
				  <div class='col-md-12'>                     
				    <textarea class='form-control' id='dltcomment' name='dltcomment' rows='5'>$dltc</textarea>
				  </div>
				</div>
				<!-- Button (Double) -->
				<div class='form-group'>
				  <div class='col-md-8'>
				    <button id='dltc' name='dltc' class='btn btn-success'>Submit comment</button>
				  </div>
				</div>
			</fieldset></form>";
	}
echo"	</div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";