 <?php
 	 error_reporting(0);
session_start();
     require ( '../includes/config.php' );
     require ( '../'.PATH_LIBRARIES.'libraries.php' );
     require ( '../'.PATH_INCLUDES.'json-headers.php' );
	 
	 $sqlsessionrights = mysql_query("select * from t_provider p where p.id='".$_SESSION[WEBSITE_ALIAS]['admin_id']
."'");
$rowsessionrights = mysql_fetch_array($sqlsessionrights);
	 
     
	 $sqlfield = mysql_query("select * from t_field_names where id=672");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$eventscalendar =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$eventscalendar =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$eventscalendar =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$eventscalendar =  $rowfield['fieldname_it'];}
	 
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
    
   $search_keyword = utf8_decode($_POST['search_keyword']);
   $column = $_POST['column'];
$providername = utf8_decode($_POST['providername']);
$_SESSION['events_searchkeyword2']= $search_keyword;
$_SESSION['events_providername2']= $providername;
	$where = '';
	if ( ($search_keyword != '') || ($column != '' || $providername != "") ) {
		if ( $column != '' ) {
			$field_names = array($column);
		}else{
			$field_names = array('loc_name','loc_detail','loc_adress1','loc_adress2','loc_zip','loc_loc','loc_shortdesc','loc_contact_name','loc_contact_phone','loc_contact_email','loc_contact_url','short');
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
		if ($providername != ""){
			$where .=" and provider='$providername'";
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
    
    //$operation_url = INDEX_PAGE.'locations-m&mode=';
	$operation_url = INDEX_PAGE.'locations-m&providername='.$_REQUEST['providername'].'&search_keyword='.$_REQUEST['search_keyword'].'&mode=';
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

        	$photo_img = '<img src=uploads/'.$row['loc_image_path'].' width="'.$widthimage.'" />';
			
        }else{
        	$photo_img = '';
        }
        $action	= '';	
		if ($rowsessionrights['admin'] == 1 or $rowsessionrights['user_w']== 1){
        $action .= ' <input type=checkbox class="locationsid" name=locationsid value="'.$record_id.'" />';
	$action .= '<a class=modalevents href="components/events-popup.php?type=locations&id='.$record_id.'" alt="'.fixEncodingx($eventscalendar).'" title="'.fixEncodingx($eventscalendar).'"><img src=images/calendar.gif alt="'.fixEncodingx($eventscalendar).'" title="'.fixEncodingx($eventscalendar).'"></a>';
        }
		
		$row1 = "";
		$row1 .= fixEncodingx($row['loc_name']);
		if ($row['loc_detail'] != ""){
			$row1 .= "<br />" . fixEncodingx($row['loc_detail']);
		}
		
		$row2 = "";
		$row2 .= fixEncodingx($row['loc_adress1']);
		if ($row['loc_adress2'] != ""){
			$row2 .= "<br />" . fixEncodingx($row['loc_adress2']);
		}
		$row2 .= "<br />" . fixEncodingx($row['short']) . " - " . fixEncodingx($row['loc_zip']) . " " . fixEncodingx($row['loc_loc']);
		
		$row3 = "";
		if ($row['loc_contact_name'] != ""){
			$row3 .= fixEncodingx($row['loc_contact_name']) . "<br />";
		}
		if ($row['loc_contact_phone'] != ""){
			$row3 .= fixEncodingx($row['loc_contact_phone']) . "<br />";
		}
		if ($row['loc_contact_email'] != ""){
			$row3 .= "<a href=mailto:".$row['loc_contact_email'].">" . fixEncodingx($row['loc_contact_email']) . "</a><br />";
		}
		if ($row['loc_contact_url'] != ""){
			$row3 .= "<a href=".$row['loc_contact_url'].">" . fixEncodingx($row['loc_contact_url']) . "</a>";	
		}
		
        if ($rc) $json .= ",";
        $json .= "\n{";
        $json .= "id:'".$record_id."',";
        $json .= "cell:['".$action."'";
        $json .= ",'".$row1."'";
        $json .= ",'".$row2."'";
        $json .= ",'".$row3."'";

		$json .= ",'".$photo_img."']";
        $json .= "}";
        $rc = true;
    }
    $json .= "]\n";
    $json .= "}";
    echo $json;
    ?>
