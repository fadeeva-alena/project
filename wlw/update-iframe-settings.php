<?php
error_reporting(0);
session_start();
require_once ( 'includes/config.php' );
require_once ( 'libraries/libraries.php' );

$frame_id = $_GET['frame_id'];

$iframe_width = $_GET['width'];
$iframe_height = $_GET['height'];
$iframe_titlecolor = $_GET['titlecolor'];
$iframe_bgcolor = $_GET['bgcolor'];
$iframe_tablegrid = $_GET['tablegrid'];
$iframe_titlebgcolor = $_GET['titlebgcolor'];


/* checking the frame settings here */
$iframesettings = mysql_query("select * from t_iframe_settings where frame_id='$frame_id' and provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	
if (mysql_num_rows($iframesettings) > 0){
	$rowsettings = mysql_fetch_array($iframesettings);
	$id = $rowsettings['id'];
	mysql_query("update t_iframe_settings set width='$iframe_width',height='$iframe_height',titlecolor='$iframe_titlecolor',bgcolor='$iframe_bgcolor',titlebgcolor='$iframe_titlebgcolor',tablegrid='$iframe_tablegrid' where id='$id'");
	echo "update t_iframe_settings set width='$iframe_width',height='$iframe_height',titlecolor='$iframe_titlecolor',bgcolor='$iframe_bgcolor',titlebgcolor='$iframe_titlebgcolor',tablegrid='$iframe_tablegrid' where id='$id'";
	// update
}else{
$iframesettings2 = mysql_query("select * from t_iframe_settings where frame_id=0 and provider_id < 0");
	// add
$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
mysql_query("insert into t_iframe_settings values ('0','$frame_id','$provider_id','$iframe_width','$iframe_height','$iframe_titlecolor','$iframe_bgcolor','$iframe_tablegrid','$iframe_titlebgcolor')");
	
/*
CREATE TABLE IF NOT EXISTS `t_iframe_settings` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `frame_id` int(1) NOT NULL,
  `provider_id` varchar(10) NOT NULL,
  `width` int(10) NOT NULL,
  `height` int(10) NOT NULL,
  `titlecolor` varchar(25) NOT NULL,
  `bgcolor` varchar(25) NOT NULL,
  `tablegrid` varchar(25) NOT NULL,
  `titlebgcolor` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `t_iframe_settings`
--

INSERT INTO `t_iframe_settings` (`id`, `frame_id`, `provider_id`, `width`, `height`, `titlecolor`, `bgcolor`, `tablegrid`, `titlebgcolor`) VALUES
(1, 0, '', 520, 400, '000000', 'FFFFFF', 'CCCCCC', 'CCCCCC'),
(2, 1, '', 520, 1000, '000000', 'FFFFFF', 'CCCCCC', 'CCCCCC');
*/
	
}
?>
