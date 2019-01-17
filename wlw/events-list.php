<?php
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
require ( '../'.PATH_INCLUDES.'json-headers.php' );

$table_name = DB_TABLE_PREFIX."event";
$page = $_POST['page'];
$rp = $_POST['rp'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];

if (!$sortname) $sortname = $fg_events['sortname'];
if (!$sortorder) $sortorder = $fg_events['sortorder'];

$sort = "ORDER BY $sortname $sortorder";

if (!$page) $page = 1;
if (!$rp) $rp = 10;

$start = (($page-1) * $rp);
$limit = "LIMIT $start, $rp";

$search_keyword = $_POST['search_keyword'];
   $column = $_POST['column'];
	$where = '';
	if ( ($search_keyword != '') || ($column != '') ) {
		if ( $column != '' ) {
			$field_names = array($column);
		}else{
			$field_names = array('title','short_desc','date_start','date_end');
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

$operation_url = INDEX_PAGE.'events-m&mode=';
$rc = false;	
while ($row = mysql_fetch_array($result))
{
	$record_id = $row['id'];
	
	$action	= '';	
	$action .= '<a href="'.$operation_url.'view&id='.$record_id.'">'.$config['action']['view'].'</a>';
	$action .= '<a href="'.$operation_url.'edit&id='.$record_id.'">'.$config['action']['edit'].'</a>';
	$action .= '<a href="'.$operation_url.'delete&id='.$record_id.'">'.$config['action']['delete'].'</a>';
	
	if ($row['eve_image_path'] != ""){
        	$path = "../uploads/".$row['eve_image_path'];
			list($widthimage, $heightimage, $type, $attr) = getimagesize($path);
			
			//$image_path = "images/your_image.png";

			//list($width, $height, $type, $attr)= getimagesize($image_path); 
			
			if ($widthimage >= "260"){
				$widthimage = 260;
			}else{
				$widthimage = $widthimage;
			}
			
			
        	$photo_img = '<img src=uploads/'.$row['eve_image_path'].' width='.$widthimage.' />';
        }else{
        	$photo_img = '';
        }
		
	if ($row['quality'] != "0"){
        	$quality = '<img src=images/'.$row['quality'].'.png width=30px height=30px/>';
        }else{
        	$quality = '';
        }
	
	if ($rc) $json .= ",";
	$json .= "\n{";
	$json .= "id:'".$record_id."',";
	$json .= "cell:['".$action."'";
	$json .= ",'".$row['title']."'";
	$json .= ",'".$string->grid_safe($row['short_desc'])."'";
	$json .= ",'".date('d.m.Y',strtotime($row['date_start']))."'";
	$json .= ",'".date('d.m.Y',strtotime($row['date_end']))."'";
	$json .= ",'".$quality."'";
	$json .= ",'".$photo_img."']";
	$json .= "}";
	$rc = true;
}
$json .= "]\n";
$json .= "}";
echo $json;
?>
