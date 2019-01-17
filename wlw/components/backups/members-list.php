<?php
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
require ( '../'.PATH_INCLUDES.'json-headers.php' );

$table_name = DB_TABLE_PREFIX."members";
$page = $_POST['page'];
$rp = $_POST['rp'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];

if (!$sortname) $sortname = $fg_members['sortname'];
if (!$sortorder) $sortorder = $fg_members['sortorder'];

$sort = "ORDER BY $sortname $sortorder";

if (!$page) $page = 1;
if (!$rp) $rp = 10;

$start = (($page-1) * $rp);
$limit = "LIMIT $start, $rp";

$search_keyword = $_POST['search_keyword'];
$where = '';
if ( ($search_keyword != '') || ($column != '') ) {
	if ( $column != '' ) {
		$field_names = array($column);
	}else{
		$field_names = array('category_name');
	}					
	$where = $sql_helper->where_like($field_names, $search_keyword);
}

$sql = "SELECT * FROM $table_name $where $sort $limit";
$result = mysql_query($sql);

$total = $sql_helper->get_var("SELECT count(*) FROM $table_name $where");
$total = $total ? $total : 0;

$json = "";
$json .= "{\n";
$json .= "page: $page,\n";
$json .= "total: $total,\n";
$json .= "rows: [";

$operation_url = INDEX_PAGE.'members-m&mode=';
$rc = false;	
while ($row = mysql_fetch_array($result))
{
	$record_id = $row['member_id'];
	
	$action	= '';	
	$action .= '<a href="'.$operation_url.'view&id='.$record_id.'">'.$config['action']['view'].'</a>';
	$action .= '<a href="'.$operation_url.'edit&id='.$record_id.'">'.$config['action']['edit'].'</a>';
	$action .= '<a href="'.$operation_url.'delete&id='.$record_id.'">'.$config['action']['delete'].'</a>';
	
	if ($row['is_activated'] == "0"){
		$status = "Not Active";
	}elseif ($row['is_activated'] == "1"){
		$status = "Active";
	}elseif ($row['is_activated'] == "2"){
		$status = "Suspended";
	}
	
	if ($rc) $json .= ",";
	$json .= "\n{";
	$json .= "id:'".$record_id."',";
	$json .= "cell:['".$string->grid_safe($row['username'])."'";
	$json .= ",'".$string->grid_safe($row['lastname'])."'";

	$json .= ",'".$string->grid_safe($row['firstname'])."'";
	$json .= ",'".$string->grid_safe($row['email_address'])."'";
	$json .= ",'".$string->grid_safe($row['birthdate'])."'";
	$json .= ",'".$string->grid_safe($row['address'])."'";
	$json .= ",'".$string->grid_safe($row['zipcode'])."'";
	$json .= ",'".$string->grid_safe($status)."']";
	$json .= "}";
	$rc = true;
}
$json .= "]\n";
$json .= "}";
echo $json;
?>