<?php
/* INSERT INTO `t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES
(605, 'leitung zusammenlegen', 'leitung zusammenlegen', 'leitung zusammenlegen', 'leitung zusammenlegen', 'leitung zusammenlegen', 'leitung zusammenlegen', 'leitung zusammenlegen', 'leitung zusammenlegen', 'leitung zusammenlegen', 11),
(606, 'unified record', 'unified record', 'unified record', 'unified record', 'unified record', 'unified record', 'unified record', 'unified record', 'unified record', 11),
(607, 'Unified updated', 'Unified updated', 'Unified updated', 'Unified updated', 'Unified updated', 'Unified updated', 'Unified updated', 'Unified updated', 'Unified updated', 11),
(608, 'No duplicate', 'No duplicate', 'No duplicate', 'No duplicate', 'No duplicate', 'No duplicate', 'No duplicate', 'No duplicate', 'No duplicate', 11);
*/

error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$events_id = trim($_GET['eventsid']);

$sql = mysql_query('select * from t_event where id="'.$events_id.'"');
$row = mysql_fetch_array($sql);

$eventsname = $row['title'];

$sqlmore = mysql_query("select * from t_event where title='".$eventsname."' and leader='".$_SESSION['events_providernamexxx']."' and id<>'$events_id'");
if (mysql_num_rows($sqlmore) > 0){
// 607
$sqlfield = mysql_query("select * from t_field_names where id=607");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$message = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$message =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$message =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$message =$rowfield['fieldname_it'];
		}

  $result = $message;
  while ($rowmore = mysql_fetch_array($sqlmore)){
	$roweventsid = $rowmore['id'];

	$sqlupdates = mysql_query("update t_dates set events_id='$events_id' where events_id='".$roweventsid."'");

	$sqldelete = mysql_query("delete from t_event where id='$roweventsid'");

  }

}else{
// 608
$sqlfield = mysql_query("select * from t_field_names where id=608");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$message = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$message =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$message =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$message =$rowfield['fieldname_it'];
		}
  $result = $message;
}

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-type: text/x-json");
?>
{ affected_rows: '<?php echo $total_deleted?>', total_records : '<?php echo $total_ids?>' , result: '<?php echo $result?>' }