<?php
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
require ( '../'.PATH_INCLUDES.'json-headers.php' );

$table_name = DB_TABLE_PREFIX."categories";
$page = $_POST['page'];
$rp = $_POST['rp'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];

if (!$sortname) $sortname = $fg_categories['sortname'];
if (!$sortorder) $sortorder = $fg_categories['sortorder'];

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

$operation_url = INDEX_PAGE.'categories-m&mode=';
$rc = false;	
while ($row = mysql_fetch_array($result))
{
	$record_id = $row['category_id'];
	$for_transfer_service = $row['for_transfer_service'] == 1 ? "Yes" : "No" ;
	
	$status = $row['category_activated'] == 1 ? "Yes" : "No" ;
	$action	= '';	
	$action .= '<a href="'.$operation_url.'view&id='.$record_id.'">'.$config['action']['view'].'</a>';
	$action .= '<a href="'.$operation_url.'edit&id='.$record_id.'">'.$config['action']['edit'].'</a>';
	$action .= '<a href="'.$operation_url.'delete&id='.$record_id.'">'.$config['action']['delete'].'</a>';
	
	if ($rc) $json .= ",";
	$json .= "\n{";
	$json .= "id:'".$record_id."',";
	$json .= "cell:['".$action."'";
	$json .= ",'".$string->grid_safe($row['category_name'])."'";
	$json .= ",'".$status."']";
	$json .= "}";
	$rc = true;
}
$json .= "]\n";
$json .= "}";
echo $json;
?>