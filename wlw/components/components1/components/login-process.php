<?php
	session_start();
	require ( '../includes/config.php' );
	require ( '../'.PATH_LIBRARIES.'libraries.php' );
	$is_valid = 'no';	
	if(isset($_POST['username'])) 
	{		
		$username = $string->sql_safe($_POST['username']);
		$password = $string->sql_safe($_POST['password']);
		
		$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE `nick` = '{$username}' AND `pw` = '{$password}'") ;	
		
		if( $row->id > 0 ) 
		{
			$_SESSION[WEBSITE_ALIAS]['language']    	= $row->language;
			$_SESSION['optionlist']    	= "0";
			$_SESSION[WEBSITE_ALIAS]['user_level']    	= $row->user_level;
			$_SESSION[WEBSITE_ALIAS]['admin_id']    	= $row->id;
			$_SESSION[WEBSITE_ALIAS]['user_level']    	= $row->user_level;
			$_SESSION[WEBSITE_ALIAS]['admin_name']   	= $row->firstname.' '.$row->lastname;
			
			$is_valid = 'yes';
			$datenow = date("Y-m-d");
			mysql_query("update t_provider set last_login='$datenow' where id='".$row->id."'");
		}
	}	
	echo $is_valid;	
?>