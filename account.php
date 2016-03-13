<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");

echo "
</div>
<div id='main' class='col-md-10'>
<div id='regbox'>
<p class='lead'>
Welcome, $loggedInUser->displayname. You are with us since " . date("M d, Y", $loggedInUser->signupTimeStamp()) . ".
</p>
</div><hr></div></div>
<div id='bottom'></div>
</div>
</body>
</html>";