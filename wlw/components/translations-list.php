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
	 
     $table_name = DB_TABLE_PREFIX."field_names";
     $page = $_POST['page'];
     $rp = $_POST['rp'];
     $sortname = $_POST['sortname'];
     $sortorder = $_POST['sortorder'];
     
     if (!$sortname) $sortname = $fg_translations['sortname'];
     if (!$sortorder) $sortorder = $fg_translations['sortorder'];
     
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
    
   $search_keyword = utf8_decode($_POST['search_keyword']);
   $column = $_POST['column'];
	$where = '';
	if ( ($search_keyword != '') || ($column != '') ) {
		if ( $column != '' ) {
			$field_names = array($column);
		}else{
			$field_names = array('id','fieldname','fieldname_de','fieldname_eng','fieldname_fr','fieldname_it');
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
    
    $sql = "SELECT * FROM $table_name $where  $sort $limit";
    $result = mysql_query($sql);
    
    $total = $sql_helper->sql_count("SELECT count(*) FROM $table_name $where ");
    
    $json = "";
    $json .= "{\n";
    $json .= "page: $page,\n";
    $json .= "total: $total,\n";
    $json .= "rows: [";
    
    $operation_url = INDEX_PAGE.'translations-m&mode=';
    $rc = false;	
    while ($row = mysql_fetch_array($result))
    {
        $record_id = $row['id'];
        
        if ($row['banner_activated'] == 1){
            $status = '<img src="images/check.png" alt="Active" title="Active">';
        }else{
            $status = '<img src="images/x.png" alt="In-active" title="In-active">';
        }
        $action	= '';	
        $action .= '<a href="'.$operation_url.'view&id='.$record_id.'">'.$config['action']['view'].'</a>';
		$action .= '<a href="'.$operation_url.'edit&id='.$record_id.'">'.$config['action']['edit'].'</a>';
        
        
        if ($row['image_path'] != ""){
        	$path = "../uploads/".$row['image_path'];
			list($widthimage, $heightimage, $type, $attr) = getimagesize($path);
			
			//$image_path = "images/your_image.png";

			//list($width, $height, $type, $attr)= getimagesize($image_path); 
			
			if ($widthimage >= $grid_max_x){
				$widthimage = $grid_max_x;
				$heightimage = "";
			}else{
				$widthimage = $widthimage;
			}

        	$photo_img = '<img src=uploads/'.$row['image_path'].' width="'.$widthimage.'" height="'.$heightimage.'" />';
        }else{
        	$photo_img = '';
        }
		
		$email = '<a href=mailto:'.$row['email'].'/>'.$row['email'].'</a>';
		$sqlevents = mysql_query("select * from t_event where provider='".$row['id']."'");
		$rowtotal1 =  mysql_num_rows($sqlevents);
		$countdates = 0;
		$sqlevents1 = mysql_query("select * from t_event where provider='".$row['id']."'");
		while ($rowevents1 = mysql_fetch_array($sqlevents1)){
			
			$sqldates = mysql_query("select * from t_dates where events_id='".$rowevents1['id']."'");
			while ($rowdates = mysql_fetch_array($sqldates)){
				
				$countdates = $countdates + 1;
			}
		}
		$rowtotal2 = $countdates;
			
		
								
		
        if ($rc) $json .= ",";
        $json .= "\n{";
        $json .= "id:'".$record_id."',";
        $json .= "cell:['".$action."'";
		
		
		$fieldname= "";
		$fieldname = str_replace("'","",$row['fieldname']);
		$fieldname = str_replace("(","",$fieldname);
		$fieldname = str_replace(")","",$fieldname);
		$json .= ",'".fixEncodingx($record_id)."'";
        $json .= ",'".fixEncodingx($fieldname)."'";
		
		$fieldname_de= "";
		$fieldname_de = str_replace("'","",$row['fieldname_de']);
		$fieldname_de = str_replace("(","",$fieldname_de);
		$fieldname_de = str_replace(")","",$fieldname_de);
        $json .= ",'".fixEncodingx($fieldname_de)."'";
		
		$fieldname_en= "";
		$fieldname_en = str_replace("(","",$row['fieldname_eng']);
		$fieldname_en = str_replace(")","",$fieldname_en);
		$fieldname_en = str_replace("'","",$fieldname_en);
        $json .= ",'".fixEncodingx($fieldname_en)."'";
		
		$fieldname_fr = "";
		$fieldname_fr = str_replace("(","",$row['fieldname_fr']);
		$fieldname_fr = str_replace(")","",$fieldname_fr);
		$fieldname_fr = str_replace("'","",$fieldname_fr);
		
        $json .= ",'".fixEncodingx($fieldname_fr)."'";
		
		$fieldname_it= "";
		$fieldname_it = str_replace("'","",$row['fieldname_it']);
		$fieldname_it = str_replace("(","",$fieldname_it);
		$fieldname_it = str_replace(")","",$fieldname_it);
        $json .= ",'".fixEncodingx($fieldname_it)."']";
        $json .= "}";
        $rc = true;
    }
    $json .= "]\n";
    $json .= "}";
    echo $json;
    ?>