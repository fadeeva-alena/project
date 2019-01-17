<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
require ( '../'.PATH_INCLUDES.'json-headers.php' );

$sql_sys = mysql_query("select * from t_sys");
	$row_sys = mysql_fetch_array($sql_sys);
	
	$grid_max_x = $row_sys['pics_in_grid_max_x'];
	$grid_max_y = $row_sys['pics_in_grid_max_y'];
	$detail_max_x = $row_sys['pics_in_detail_max_x'];
	$detail_max_y = $row_sys['pics_in_detail_max_y'];

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
$today = date('Y-m-d');
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
		if ($_GET['optionlist']== 1){
			if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 3)
			{	
				$userlevelgain ="";
			}else{
				$userlevelgain =" and e.provider='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'";
				if ($_SESSION['optionlistfilter'] == 1){
					if ($_SESSION['optionlistfilter'] == 1){
						$userlevelgainfilter = " and date_start>='$today'";
					}else{
						$userlevelgainfilter = "";
					}
				}
			}
		}else{
			$userlevelgain ="";
			if ($_SESSION['optionlistfilter'] == 1){
				$userlevelgainfilter = " and date_start>='$today'";
				if ($_SESSION['optionlistfilter'] == 1){
					$userlevelgainfilter = " and date_start>='$today'";
				}else{
					$userlevelgainfilter = "";
				}
			}else{
				$userlevelgainfilter = "";
				if ($_SESSION['optionlistfilter'] == 1){
					$userlevelgainfilter = " and date_start>='$today'";
				}else{
					$userlevelgainfilter = "";
				}
			}
		}
		
		
	}else{
		if ($_GET['optionlist']== 1){
			if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 3)
			{	
				$userlevelgain ="";
			}else{
				$userlevelgain =" where e.provider='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'";
				if ($_SESSION['optionlistfilter'] == 1){
					$userlevelgainfilter = " and date_start>='$today'";
				}else{
					$userlevelgainfilter = "";
				}
			}
		}else{
			$userlevelgain ="";
			if ($_SESSION['optionlistfilter'] == 1){
				$userlevelgainfilter = " and date_start>='$today'";
			}else{
				$userlevelgainfilter = "";
			}
		}
	}


	

	$sql = "SELECT *,c.currency as currencyal,loc.loc_name as locationval,e.id as eid FROM $table_name 
		e inner join t_leader l on e.leader=l.id  
		inner join t_currency c on e.currency=c.id  
		inner join t_location loc on e.location=loc.id  
		$where $userlevelgain $userlevelgainfilter $sort $limit";

$result = mysql_query($sql);

$total = $sql_helper->get_var("SELECT count(*) FROM $table_name e inner join t_leader l on e.leader=l.id
	inner join t_currency c on e.currency=c.id 
	inner join t_location loc on e.location=loc.id  
 $where $userlevelgain $userlevelgainfilter");
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
	$record_id = $row['eid'];
	
	$action	= '';	
	$action .= '<a href="'.$operation_url.'view&id='.$record_id.'">'.$config['action']['view'].'</a>';
	if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 1){
		$action .= '<a href="'.$operation_url.'edit&id='.$record_id.'">'.$config['action']['edit'].'</a>';
		$action .= '<a href="'.$operation_url.'delete&id='.$record_id.'">'.$config['action']['delete'].'</a>';
	} if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 2 and $_SESSION[WEBSITE_ALIAS]['admin_id'] == $row['provider']){
			$action .= '<a href="'.$operation_url.'edit&id='.$record_id.'">'.$config['action']['edit'].'</a>';
			$action .= '<a href="'.$operation_url.'delete&id='.$record_id.'">'.$config['action']['delete'].'</a>';
	}
		
	
	if ($row['eve_image_path'] != ""){
        	$path = "../uploads/".$row['eve_image_path'];
			list($widthimage, $heightimage, $type, $attr) = getimagesize($path);
			
			//$image_path = "images/your_image.png";

			//list($width, $height, $type, $attr)= getimagesize($image_path); 
			
			if ($widthimage >= $grid_max_x){
				$widthimage = $grid_max_x;
				$heightimage = "";
			}else{
				$widthimage = $widthimage;
			}

        	$photo_img = '<img src=uploads/'.$row['eve_image_path'].' width="'.$widthimage.'" />';
			
			
        	//$photo_img = '<img src=uploads/'.$row['eve_image_path'].' width='.$widthimage.' />';
        }else{
        	$photo_img = '';
        }
		
	if ($row['quality'] != "0"){
        	$quality = '<img src=images/'.$row['quality'].'.png width=30px height=30px/>';
        }else{
        	$quality = '';
        }
		
	$teachers = $row['company'] . "<br />" . $row['firstname'] . " " .$row['lastname'];
	$currency = $row['price'] . " " . $row['currencyal'];
	$location = $row['loc_name'] . " " . $row['loc_detail'] ."<br/>". $row['loc_zip'] . " " . $row['loc_loc'];
	
	if ($rc) $json .= ",";
	$json .= "\n{";
	$json .= "id:'".$record_id."',";
	$json .= "cell:['".$action."'";
	$json .= ",'"."<div style=margin:0px;padding:0px;>".utf8_encode($row['title'])."</div>'";
	//$json .= ",'"."<div style=width:80px;margin:0px;padding:0px;word-wrap:break-word;>".$string->grid_safe(utf8_encode($row['short_desc']))."</div>'";
	$json .= ",'".$currency."'";
	$json .= ",'".date('d.m.Y',strtotime($row['date_start']))."'";
	$json .= ",'".date('d.m.Y',strtotime($row['date_end']))."'";
	$json .= ",'".$quality."'";
	$json .= ",'".$teachers."'";
	$json .= ",'".$photo_img."'";
	$json .= ",'".utf8_encode($location)."']";
	$json .= "}";
	$rc = true;
}
$json .= "]\n";
$json .= "}";
echo $json;
?>
