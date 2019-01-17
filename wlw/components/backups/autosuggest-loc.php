<?php
error_reporting(0);
session_start();
require_once ( '../includes/config.php' );
require_once ( '../'.PATH_LIBRARIES.'libraries.php' );
	
	
		if(isset($_POST['queryString'])) {
			$queryString = mysql_real_escape_string($_POST['queryString']);
			
			if(strlen($queryString) >0) {

				$query = mysql_query("SELECT distinct(Location),ZIP from t_zipch
				WHERE (Location LIKE '$queryString%') order by Location asc LIMIT 10 ");
				if($query) {
				echo '<ul>';
					while ($result = mysql_fetch_assoc($query)) {
	         			//echo '<li onClick="fill1(\''.addslashes($result[Location]).'\');">'.$result[Location] .'</li>';
						echo '<li onClick="fill(\''.addslashes($result[ZIP].'~'.$result[Location]).'\');">'.$result[Location] .' '. $result[ZIP] .'</li>';
	         		}
				echo '</ul>';
					
				} else {
					echo 'There are no record found.';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	
?>