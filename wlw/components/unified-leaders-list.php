 <?php
 	 error_reporting(0);
session_start();
     require ( '../includes/config.php' );
     require ( '../'.PATH_LIBRARIES.'libraries.php' );
     require ( '../'.PATH_INCLUDES.'json-headers.php' );
	 
	 $sqlsessionrights = mysql_query("select * from t_provider p where p.id='".$_SESSION[WEBSITE_ALIAS]['admin_id']
."'");
$rowsessionrights = mysql_fetch_array($sqlsessionrights);
     
	 $sql_sys = mysql_query("select * from t_sys");
	$row_sys = mysql_fetch_array($sql_sys);
	
	$grid_max_x = $row_sys['pics_in_grid_max_x'];
	$grid_max_y = $row_sys['pics_in_grid_max_y'];
	$detail_max_x = $row_sys['pics_in_detail_max_x'];
	$detail_max_y = $row_sys['pics_in_detail_max_y'];
	 
     $table_name = DB_TABLE_PREFIX."leader";
     $page = $_POST['page'];
     $rp = $_POST['rp'];
     $sortname = $_POST['sortname'];
     $sortorder = $_POST['sortorder'];
     
     if (!$sortname) $sortname = "lastname";
     if (!$sortorder) $sortorder = $fg_leaders['sortorder'];
     
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
    //if ($_POST['search_keyword'])
	//if ($_POST['search_keyword'] == "test"){
	//	$search_keyword = "tes";
   //}else{
		$search_keyword = $_POST['search_keyword'];
   //}
$providername = utf8_decode($_POST['providername']);
$_SESSION['events_searchkeyword1']= $search_keyword;
$_SESSION['events_providername1']= $providername;
   $column = $_POST['column'];
	$where = '';
	if ( ($search_keyword != '') || ($column != '' || $providername != "") ) {
		if ( $column != '' ) {
			$field_names = array($column);
		}else{
			$field_names = array('company','firstname','lastname','about','contact_tel','contact_email','contact_url');
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
			$where .=" and l.provider='$providername'";
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
   
	$sql = "SELECT * from $table_name 
	$where $userlevelgain $sort $limit";
    $result = mysql_query($sql);
    
    $totalnum = mysql_query("SELECT * from $table_name 
	$where $userlevelgain");
	
	$total = mysql_num_rows($totalnum);
	if ($total != ""){
		$total = $total;
	}else{
		$total = 0;
	}
    
    $json = "";
    $json .= "{\n";
    $json .= "page: $page,\n";
    $json .= "total: $total,\n";
    $json .= "rows: [";
    
    $operation_url = INDEX_PAGE.'leaders-m&providername='.$_REQUEST['providername'].'&search_keyword='.$_REQUEST['search_keyword'].'&mode=';
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
		if ($rowsessionrights['admin'] == 1 or $rowsessionrights['user_w']== 1){
         $action .= ' <input type=checkbox class="leadersid" name=leadersid value="'.$record_id.'" />';
	$action .= '<a class=modalevents href="components/events-popup.php?type=leaders&id='.$record_id.'"><img src=images/calendar.gif></a>';
	}
	
	
	$row1 = "";
		
		if ($row['company'] != ""){
			$row1 .= "<br />" . fixEncodingx($row['company']) . "<br />";
		}
		$row1 .= fixEncodingx($row['firstname']) . " " . fixEncodingx($row['lastname']);
		
		
		
		$row3 = "";
		
		if ($row['contact_tel'] != ""){
			$row3 .= fixEncodingx($row['contact_tel']) . "<br />";
		}
		if ($row['contact_email'] != ""){
			//$row3 .= "<a href=mailto:".$row['contact_email'].">" . fixEncodingx($row['contact_email']) . "</a><br />";
		}
		if ($row['contact_url'] != ""){
			$row3 .= "<a href=".$row['contact_url'].">" . fixEncodingx($row['contact_url']) . "</a>";	
		}
        
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

        	$photo_img = '<img src=uploads/'.$row['image_path'].' width="'.$widthimage.'"  />';
        }else{
        	$photo_img = '';
        }
        if ($rc) $json .= ",";
        $json .= "\n{";
        $json .= "id:'".$record_id."',";
        $json .= "cell:['".$action."'";
        $json .= ",'".$row1."'";
        $json .= ",'".$row3."'";
		$json .= ",'".$photo_img."']";
		//$json .= ",'".$row['counts']."']";
        $json .= "}";
        $rc = true;
    }
    $json .= "]\n";
    $json .= "}";
    echo $json;
    ?>