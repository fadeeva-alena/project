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
	 
     $table_name = DB_TABLE_PREFIX."location";
     $page = $_POST['page'];
     $rp = $_POST['rp'];
     $sortname = $_POST['sortname'];
     $sortorder = $_POST['sortorder'];
     
     if (!$sortname) $sortname = $fg_locations['sortname'];
     if (!$sortorder) $sortorder = $fg_locations['sortorder'];
     
     $sort = "ORDER BY $sortname $sortorder";
     
     if (!$page) $page = 1;
     if (!$rp) $rp = 10;
     
     $start = (($page-1) * $rp);
     $limit = "LIMIT $start, $rp";
     
     /* 
     $query = $_POST['query'];
     $qtype = $_POST['qtype'];
     
     $where = "";
     if ($query) $where = " WHERE $qtype LIKE '%$query%' ";
     */
    
   $search_keyword = $_POST['search_keyword'];
   $column = $_POST['column'];
	$where = '';
	if ( ($search_keyword != '') || ($column != '') ) {
		if ( $column != '' ) {
			$field_names = array($column);
		}else{
			$field_names = array('loc_name','loc_detail','loc_adress1','loc_adress2','c.long');
		}					
		$where = $sql_helper->where_like($field_names, $search_keyword);
		if ($_GET['optionlist']== 1){
			if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 3)
			{	
				$userlevelgain ="";
			}else{
				$userlevelgain =" and provider='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'";
			}
		}else{
			$userlevelgain ="";
		}
	}else{
		if ($_GET['optionlist']== 1){
			if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 3)
			{	
				$userlevelgain ="";
			}else{
				$userlevelgain =" where provider='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'";
			}
		}else{
			$userlevelgain ="";
		}
	}
    
    $sql = "SELECT *,l.id as lid FROM $table_name l inner join t_country c
		on l.loc_country=c.id
		$where $userlevelgain $sort $limit";
    $result = mysql_query($sql);
    
    $total = $sql_helper->sql_count("SELECT count(*) FROM $table_name l inner join t_country c
		on l.loc_country=c.id $where $userlevelgain");
    
    $json = "";
    $json .= "{\n";
    $json .= "page: $page,\n";
    $json .= "total: $total,\n";
    $json .= "rows: [";
    
    $operation_url = INDEX_PAGE.'locations-m&mode=';
    $rc = false;	
    while ($row = mysql_fetch_array($result))
    {
        $record_id = $row['lid'];
        
        if ($row['banner_activated'] == 1){
            $status = '<img src="images/check.png" alt="Active" title="Active">';
        }else{
            $status = '<img src="images/x.png" alt="In-active" title="In-active">';
        }
		if ($row['loc_image_path'] != ""){
			$path = "../uploads/".$row['loc_image_path'];
			list($widthimage, $heightimage, $type, $attr) = getimagesize($path);
			
			//$image_path = "images/your_image.png";

			//list($width, $height, $type, $attr)= getimagesize($image_path); 
			
			
			

			if ($widthimage >= $grid_max_x){
				$widthimage = $grid_max_x;
				$heightimage = "";
			}else{
				$widthimage = $widthimage;
			}

        	$photo_img = '<img src=uploads/'.$row['loc_image_path'].' width="'.$widthimage.'" height="'.$heightimage.'" />';
			
        }else{
        	$photo_img = '';
        }
        $action	= '';	
        $action .= '<a href="'.$operation_url.'view&id='.$record_id.'">'.$config['action']['view'].'</a>';
       if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 1){
		$action .= '<a href="'.$operation_url.'edit&id='.$record_id.'">'.$config['action']['edit'].'</a>';
		$action .= '<a href="'.$operation_url.'delete&id='.$record_id.'">'.$config['action']['delete'].'</a>';
	} if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 2 and $_SESSION[WEBSITE_ALIAS]['admin_id'] == $row['provider']){
			$action .= '<a href="'.$operation_url.'edit&id='.$record_id.'">'.$config['action']['edit'].'</a>';
			$action .= '<a href="'.$operation_url.'delete&id='.$record_id.'">'.$config['action']['delete'].'</a>';
	}
        
        if ($rc) $json .= ",";
        $json .= "\n{";
        $json .= "id:'".$record_id."',";
        $json .= "cell:['".$action."'";
        $json .= ",'".$string->grid_safe(utf8_encode($row['loc_name']))."'";
        $json .= ",'".$string->grid_safe(utf8_encode($row['loc_detail']))."'";
        $json .= ",'".$string->grid_safe(utf8_encode($row['loc_adress1']))."'";
		$json .= ",'".$string->grid_safe(utf8_encode($row['loc_adress2']))."'";
		$json .= ",'".$string->grid_safe($row['long'])."'";
		$json .= ",'".$photo_img."']";
        $json .= "}";
        $rc = true;
    }
    $json .= "]\n";
    $json .= "}";
    echo $json;
    ?>
