<?php
error_reporting(0);
session_start();
require_once ( 'includes/config.php' );
require_once ( PATH_LIBRARIES.'libraries.php' );
$q = strtolower($_GET["q"]);
if (!$q) return;
{

		$query = mysql_query("SELECT distinct(ZIP),Location from t_zipch
				WHERE (ZIP LIKE '$q%') order by ZIP asc LIMIT 50 ");
				if($query) {
				while ($result = mysql_fetch_assoc($query)) {
						$value = utf8_encode($result[ZIP].'~'.$result[Location]);
						$key = utf8_encode($result[ZIP] .' '. $result[Location]);
						echo "$key|$value\n";
	         		}

		
	
}
}

?>