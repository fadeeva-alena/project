<?php
if(substr(PHP_VERSION,0,1)=='4')
	include("Config_File.class4.php");
else
	include("Config_File.class5.php");
?>