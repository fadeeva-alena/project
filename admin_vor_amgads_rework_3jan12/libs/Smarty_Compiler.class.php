<?php
if(substr(PHP_VERSION,0,1)=='4')
	include("Smarty_Compiler.class4.php");
else
	include("Smarty_Compiler.class5.php");
?>