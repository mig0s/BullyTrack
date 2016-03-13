<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

$id=$_GET['id'];

$getcmr = $mysqli->prepare("SELECT cmr_content from cmr where cmr_id='$id';");
$getcmr->execute();
$getcmr->bind_result($content);
while ($getcmr->fetch()) {
    $cmr = stripcslashes($content);
}
$getcmr->close();


echo "
</div>
	<div id='main' class='col-md-10'>";
	echo resultBlock($errors,$successes);
	echo "
		<div id='regbox'>";
echo "$cmr";
echo"	</div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";