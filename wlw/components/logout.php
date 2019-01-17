<?php
	$post_data = array();
	$post_data['log_out']	= "now";
	$guest_updated = $sql_helper->update_all("t_activity_log","session_id" ,$_SESSION[WEBSITE_ALIAS]['session_id'],$post_data);
	unset($_SESSION[WEBSITE_NAME]);
	session_destroy();

	header("Location: ".INDEX_PAGE."login");
?>