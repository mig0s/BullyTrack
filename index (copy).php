<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");
if(isUserLoggedIn()) {
	echo '<script type="text/javascript">window.location.href="account.php";</script>';
} else {
echo "
</div>
<div id='main' class='col-md-10'>
<div class='jumbotron'>
<h1>Cool homepage!</h1>
</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";
}
?>
