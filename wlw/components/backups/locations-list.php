 <?php
 	 error_reporting(0);
     require ( '../includes/config.php' );
     require ( '../'.PATH_LIBRARIES.'libraries.php' );
     require ( '../'.PATH_INCLUDES.'json-headers.php' );
     
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
	}
    
    $sql = "SELECT *,l.id as lid FROM $table_name l inner join t_country c
		on l.loc_country=c.id
		$where $sort $limit";
    $result = mysql_query($sql);
    
    $total = $sql_helper->sql_count("SELECT count(*) FROM $table_name l inner join t_country c
		on l.loc_country=c.id $where");
    
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
			
			if ($widthimage >= "260"){
				$widthimage = 260;
			}else{
				$widthimage = $widthimage;
			}
			
			
        	$photo_img = '<img src=uploads/'.$row['loc_image_path'].' width='.$widthimage.' />';
        }else{
        	$photo_img = '';
        }
        $action	= '';	
        $action .= '<a href="'.$operation_url.'view&id='.$record_id.'">'.$config['action']['view'].'</a>';
        $action .= '<a href="'.$operation_url.'edit&id='.$record_id.'">'.$config['action']['edit'].'</a>';
        $action .= '<a href="'.$operation_url.'delete&id='.$record_id.'">'.$config['action']['delete'].'</a>';
        
        if ($rc) $json .= ",";
        $json .= "\n{";
        $json .= "id:'".$record_id."',";
        $json .= "cell:['".$action."'";
        $json .= ",'".$string->grid_safe($row['loc_name'])."'";
        $json .= ",'".$string->grid_safe($row['loc_detail'])."'";
        $json .= ",'".$string->grid_safe($row['loc_adress1'])."'";
		$json .= ",'".$string->grid_safe($row['loc_adress2'])."'";
		$json .= ",'".$string->grid_safe($row['long'])."'";
		$json .= ",'".$photo_img."']";
        $json .= "}";
        $rc = true;
    }
    $json .= "]\n";
    $json .= "}";
    echo $json;
    ?>
