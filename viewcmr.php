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


echo "
</div>
	<div id='main' class='col-md-10'>";
	echo resultBlock($errors,$successes);
	echo "
		<div id='regbox'>";
echo "".$cmr['content']."<br /><h3>General comment:</h3>".$cmr['comment']."<br /><h3>Actions to be taken:</h3>".$cmr['actions']."";
echo"	</div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";