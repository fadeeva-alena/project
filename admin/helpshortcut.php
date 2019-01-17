<?php
include("include/dbcommon.php");
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");
add_nocache_headers();
include('include/xtempl.php');
$xt = new Xtempl();
//$templatefile="helpshortcut.htm";
$xt->display($templatefile);
?>