<?php
error_reporting();
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$table_name = DB_TABLE_PREFIX."activity_log";
$page = $_POST['page'];
$rp = $_POST['rp'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];

if (!$sortname) $sortname = $fg_activitylogs['sortname'];
if (!$sortorder) $sortorder = $fg_activitylogs['sortorder'];

$sort = "ORDER BY $sortname $sortorder";

if (!$page) $page = 1;
if (!$rp) $rp = 10;

$start = (($page-1) * $rp);
$limit = "LIMIT $start, $rp";
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$search_keyword = $_POST['search_keyword'];
$columns = $_POST['column'];
$location_name = $_POST['location_name'];
$where = '';
if ( ($search_keyword != '') || ($columns != '') || ($startdate != '') ) {
	if ( $columns != '' ) {
		$field_names = array($columns);
		
	}else{
		$field_names = array('lastname', 'provider_id', 'log_in', 'log_out','session_id','session_time','ip_location');
	}	
	$where = $sql_helper->where_like($field_names, $search_keyword);
	if ($startdate!= "" && $enddate!="" ){
		$startdate = $startdate . " 00:00:00";
		$enddate = $enddate . " 23:59:59";
		$ctr_fields = count($field_names);
		$where .= " and ((log_in BETWEEN '{$startdate}' AND '{$enddate}'))";
	}
} 
	if (isset($_GET['display'])){
		$display = $_GET['display'];
		if ($display == "today"){
			$start_date = date("Y-m-d") . " 00:00:00";
			$end_date = date("Y-m-d") . " 23:59:59";
		}elseif ($display == "yesterday"){
			$current_year = date("Y");
			$curr_month = date("m");
            $curr_day = date("d");
			$curr_num_day = date("d");
			$ctr = 0;
			$date = date("Y-m-d",mktime(0,0,0,$curr_month,$curr_day-1,$current_year));
			$start_date = $date . " 00:00:00";
			$end_date = $date . " 23:59:59";
		}elseif ($display == "lastweek"){
			$current_year = date("Y");
			$curr_month = date("m");
            $curr_day = date("d");
			$curr_num_day = date("d");
			$start_date = date("Y-m-d",mktime(0,0,0,$curr_month,$curr_day-8,$current_year));
			$end_date = date("Y-m-d",mktime(0,0,0,$curr_month,$curr_day-1,$current_year));
			$start_date = $start_date . " 00:00:00";
			$end_date = $end_date . " 23:59:59";

		}else{
		
		}
		$where =" WHERE (
			(log_in between '{$start_date}' AND '{$end_date}')
		  ) ";
		
	}

$sql = "SELECT *,al.provider_id as providerid from t_activity_log al left join t_provider p on 
al.provider_id=p.id $where $sort $limit";
$result = mysql_query($sql);
$getcount = mysql_query("SELECT *,al.provider_id as providerid from t_activity_log al left join t_provider p on 
al.provider_id=p.id $where");
$total = mysql_num_rows($getcount);
$total = $total ? $total : 0;
$json = "";
$json .= "{\n";
$json .= "page: $page,\n";
$json .= "total: $total,\n";
$json .= "rows: [";
$operation_url = INDEX_PAGE.'activity-logs-m&mode=';
$rc = false;	
while ($row = mysql_fetch_array($result))
{
	$record_id = $row['activity_log_id'];
	$action	= '';
	$start++;

	$action .= '<a href="'.$operation_url.'view&id='.$record_id.'"><img class="ico-action" src="'.IMAGES.'icon-view.png" alt="View" title="View" border="0" /></a>';

	//$action .= '<a href="'.$operation_url.'delete&id='.$record_id.'"><img class="ico-action" src="'.IMAGES.'icon-delete.png" alt="Delete" title="Delete" border="0" /></a>';
	$username = $row['lastname'] . ", " . $row['firstname'];
	//$guest_name .= $sql;
	if ($rc) $json .= ",";
	$json .= "\n{";
	$json .= "id:'".$record_id."',";
	$json .= "cell:['".$action."'";
	//$json .= ",'".$action."'";

	$json .= ",'".$string->grid_safe($username)."'";
	$json .= ",'".$row['log_in']."'";
	$json .= ",'".$row['log_out']."'";
	$json .= ",'".$string->grid_safe($row['session_id'])."'";
	$json .= ",'".$string->grid_safe($row['session_time'])."'";
	$json .= ",'".$string->grid_safe($row['ip_location'])."']";
	$json .= "}";
	$rc = true;
}
$json .= "]\n";
$json .= "}";
echo $json;
?>