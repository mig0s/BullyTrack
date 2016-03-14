<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");


echo "
</div>
	<div id='main' class='col-md-10'>";
	echo resultBlock($errors,$successes);

echo"	</div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";