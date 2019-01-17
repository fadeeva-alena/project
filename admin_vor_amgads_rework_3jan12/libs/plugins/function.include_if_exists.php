<?php 
function smarty_function_include_if_exists($params, &$smarty)
{
	global $data;
	$file=$params["file"];
	$path = pathinfo(__FILE__);
	$filepath = substr($path["dirname"],0,strlen($path["dirname"])-12);	// 12 = strlen("libs/plugins")
	if(file_exists($filepath.$file))
		@include($filepath.$file);
}
?>