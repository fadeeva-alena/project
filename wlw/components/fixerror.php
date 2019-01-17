<?php

 require ( '../includes/config.php' );
 require ( '../'.PATH_LIBRARIES.'libraries.php' );
 
 
 $sqllocation = mysql_query("select * from t_location");
 while ($rowlocation = mysql_fetch_array($sqllocation)){
	//$post_data['loc_name'] = utf8_encode($rowlocation['loc_name']);
	$post_data['loc_name'] = mb_convert_encoding($rowlocation['loc_name'],  'HTML-ENTITIES','UTF-8');
	$post_data['loc_loc'] = mb_convert_encoding($rowlocation['loc_loc'],  'HTML-ENTITIES','UTF-8');
	$is_updated = $sql_helper->update_all("t_location" ,"id" ,$rowlocation['id'] ,$post_data);
 }

?>