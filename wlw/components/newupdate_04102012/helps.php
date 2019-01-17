<?php
error_reporting(0);
session_start();
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){ /// for de language
	?>
		<br /><br />
	<?php 
	}
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==2){ /// for eng language
	?>
		<br /><br />
	<?php 
	}
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==3){ /// for fr language
	?>
		<br /><br />
	<?php 
	}
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==4){ /// for it language
	?>
		<br /><br />
<?php }?>