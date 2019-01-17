<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
require ( '../'.PATH_INCLUDES.'json-headers.php' );

$sqlsessionrights = mysql_query("select * from t_provider p where p.id='".$_SESSION[WEBSITE_ALIAS]['admin_id']
."'");
$rowsessionrights = mysql_fetch_array($sqlsessionrights);

$sqlfield = mysql_query("select * from t_field_names where id=704");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$homepagelinks4 = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$homepagelinks4 =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$homepagelinks4 =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$homepagelinks4 =$rowfield['fieldname_it'];
		}
$sqlfield = mysql_query("select * from t_field_names where id=701");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$homepagelinks1 = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$homepagelinks1 =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$homepagelinks1 =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$homepagelinks1 =$rowfield['fieldname_it'];
		}
$sqlfield = mysql_query("select * from t_field_names where id=702");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$homepagelinks2 = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$homepagelinks2 =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$homepagelinks2 =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$homepagelinks2 =$rowfield['fieldname_it'];
		}
$sqlfield = mysql_query("select * from t_field_names where id=703");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$homepagelinks = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$homepagelinks =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$homepagelinks =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$homepagelinks =$rowfield['fieldname_it'];
		}

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
$search_keyword = utf8_decode($_POST['search_keyword']);
$providername = utf8_decode($_POST['providername']);
	mysql_query("insert into t_values values('$search_keyword')");


$_SESSION['events_searchkeyword']= $search_keyword;
$_SESSION['events_providername']= $providername;

   $column = $_POST['column'];
	$where = '';
	if ( ($search_keyword != '') || ($column != '' || $providername != "") ) {
		
		if ( $column != '' ) {
			$field_names = array($column);
		}else{
			$field_names = array('title','price','company','firstname','lastname','loc_adress1','loc_adress2','short','loc_zip','loc_loc');
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
						$userlevelgainfilter = " and events_start_date>='$today'";
					}else{
						$userlevelgainfilter = "";
					}
				}
			}
		}else{
			$userlevelgain ="";
			if ($_SESSION['optionlistfilter'] == 1){
				$userlevelgainfilter = " and events_start_date>='$today'";
				if ($_SESSION['optionlistfilter'] == 1){
					$userlevelgainfilter = " and events_start_date>='$today'";
				}else{
					$userlevelgainfilter = "";
				}
			}else{
				$userlevelgainfilter = "";
				if ($_SESSION['optionlistfilter'] == 1){
					$userlevelgainfilter = " and events_start_date>='$today'";
				}else{
					$userlevelgainfilter = "";
				}
			}
		}
		if ($providername != ""){
		  $where .=" and e.provider='$providername'";
		}
	}else{
		if ($_GET['optionlist']== 1){
			if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 3)
			{	
				$userlevelgain ="";
			}else{
				$userlevelgain =" where e.provider='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'";
				if ($_SESSION['optionlistfilter'] == 1){
					$userlevelgainfilter = " and events_start_date>='$today'";
				}else{
					$userlevelgainfilter = "";
				}
			}
		}else{
			$userlevelgain ="";
			if ($_SESSION['optionlistfilter'] == 1){
				$userlevelgainfilter = " and events_start_date>='$today'";
			}else{
				$userlevelgainfilter = "";
			}
		}
	}


	

$sql = "SELECT *,c.currency as currencyal,loc.loc_name as locationval,e.id as eid,d.events_start_date FROM $table_name 
		e inner join t_leader l on e.leader=l.id  
		inner join t_currency c on e.currency=c.id  
		inner join t_location loc on e.location=loc.id  
		inner join t_dates d on e.id=d.events_id
		inner join t_country country on country.id=loc.loc_country
		$where $userlevelgain $userlevelgainfilter group by e.id $sort $limit";

$result = mysql_query($sql);

/*$total = $sql_helper->get_var("SELECT count(*) FROM $table_name 
	e inner join t_leader l on e.leader=l.id
	inner join t_currency c on e.currency=c.id 
	inner join t_location loc on e.location=loc.id  
	inner join t_dates d on e.id=d.events_id
 $where $userlevelgain $userlevelgainfilter group by d.id");*/
 $sql2 = "SELECT *,c.currency as currencyal,loc.loc_name as locationval,e.id as eid FROM $table_name 
		e inner join t_leader l on e.leader=l.id  
		inner join t_currency c on e.currency=c.id  
		inner join t_location loc on e.location=loc.id  
		inner join t_dates d on e.id=d.events_id
		inner join t_country country on country.id=loc.loc_country
		$where $userlevelgain $userlevelgainfilter group by e.id";
 $rowsql2 = mysql_query($sql2);
 $total = mysql_num_rows($rowsql2);
$total = $total ? $total : 0;

$json = "";
$json .= "{\n";
$json .= "page: $page,\n";
$json .= "total: $total,\n";
$json .= "rows: [";

//$operation_url = INDEX_PAGE.'events-m&mode=';
$operation_url = INDEX_PAGE.'events-m&providername='.$_REQUEST['providername'].'&search_keyword='.$_REQUEST['search_keyword'].'&mode=';
$rc = false;	
while ($row = mysql_fetch_array($result))
{
	$teachers = "";
	$record_id = $row['eid'];
	
	$action	= '';	
	$action .= '<a class=modalevents href="components/events-maint-view.php?mode=view&view=view&id='.$record_id.'"><img border="0" src="images/icon-view.png" class="ico-action"></a>';
	if ($rowsessionrights['admin'] == 1 or $rowsessionrights['user_w']== 1){
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
				if ($row['quality'] == 1){
					$sqlfield = mysql_query("select * from t_field_names where id=320");
				}elseif ($row['quality'] == 2){
					$sqlfield = mysql_query("select * from t_field_names where id=321");
				}elseif ($row['quality'] == 3){
					$sqlfield = mysql_query("select * from t_field_names where id=322");
				}elseif ($row['quality'] == 4){
					$sqlfield = mysql_query("select * from t_field_names where id=323");
				}elseif ($row['quality'] == 5){
					$sqlfield = mysql_query("select * from t_field_names where id=324");
				}
					$rowfield = mysql_fetch_array($sqlfield);
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						$qualitytext = $rowfield['helptext_de'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						$qualitytext = $rowfield['helptext_eng'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						$qualitytext = $rowfield['helptext_fr'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						$qualitytext = $rowfield['helptext_it'];
					}
			
		
	if ($row['quality'] != "0"){
        	$quality = '<img src=images/'.$row['quality'].'.png width=30px height=30px alt="'.$qualitytext.'" title="'.$qualitytext.'" />';
        }else{
        	$quality = '';
        }
		
	$teachers = "<a class=modalevents href=components/events-popup.php?type=leaders&id=".$record_id.">" . fixEncodingx($row['company'] . "<br />" . $row['firstname'] . " " .$row['lastname']) . "</a>";
	
	
	
	$currency = fixEncodingx($row['price'] . " " . $row['currencyal']);
	
	
	$row1 = "";
	$row1 .= fixEncodingx($row['title']) ."<br />" . "<a class=modalevents href=components/leaders-maint3.php?mode=view&view=view&id=".$row['leader'].">";
	if ($row['company'] !=""){
		$row1 .= fixEncodingx($row['company']) . "<br />";
	}
	$row1 .= fixEncodingx($row['firstname'] . " " .$row['lastname']) . "</a><br />";
	
	if ($row['leader2'] != 0){
		$sqlleaders2 = mysql_query("select * from t_leader where id='".$row['leader2']."'");
		$rowleaders = mysql_fetch_array($sqlleaders2);
		
		$row1 .= "<a class=modalevents href=components/leaders-maint3.php?mode=view&view=view&id=".$row['leader2'].">";
		if ($rowleaders['company'] !=""){
			$row1 .= fixEncodingx($rowleaders['company']) . "<br />";
		}
		$row1 .= fixEncodingx($rowleaders['firstname'] . " " .$rowleaders['lastname']  . "</a><br />");
	}
	
	$row1 .= "<a class=modalevents href=components/locations-maint3.php?mode=view&view=view&id=".$row['location'].">";
	$row1 .= fixEncodingx($row['loc_adress1']) . "<br />";
		if ($row['loc_adress2'] != ""){
			$row1 .=  fixEncodingx($row['loc_adress2']) . "<br />";
		}
		$row1 .= fixEncodingx($row['short']) . " - " . fixEncodingx($row['loc_zip']) . " " . fixEncodingx($row['loc_loc']) . "</a>";
	
	
	if ($rc) $json .= ",";
	$json .= "\n{";
	$json .= "id:'".$record_id."',";
	$json .= "cell:['".$action."'";
	$json .= ",'".$record_id."'";
	$json .= ",'"."<div style=margin:0px;padding:0px;>".$row1."</div>'";
	//$json .= ",'"."<div style=width:80px;margin:0px;padding:0px;word-wrap:break-word;>".$string->grid_safe(fixEncodingx($row['short_desc']))."</div>'";
	
	$datestart = "";
	$dateend = "";
	$sqldate = mysql_query("select * from t_dates where events_id='$record_id'");
	while ($rowdate = mysql_fetch_array($sqldate)){
		$todaystr = date('Y-m-d',strtotime($today));
		$startstr = date('Y-m-d',strtotime($rowdate['events_end_date']));
		$endstr = date('Y-m-d',strtotime($rowdate['events_start_date']));
	
	if ($_GET['optionlistfilter'] == "1"){
	
	 if ($startstr >= $todaystr and $endstr >= $todaystr){
	 	$datestart .= date('d.m.Y',strtotime($rowdate['events_start_date']));
		if ($rowdate['events_start_date'] != $rowdate['events_end_date']){
			$datestart .= " - " .date('d.m.Y',strtotime($rowdate['events_end_date']));
			//$datestart .= " - " .date('d.m.Y',strtotime($rowdate['events_start_date']));
		}else{
			//$datestart .= " - " .date('d.m.Y',strtotime($rowdate['events_start_date']));
			$dateend .= "<br />";
		}
		$datestart .="<br />";
	 }
	 }else{
	 	$datestart .= date('d.m.Y',strtotime($rowdate['events_start_date']));
		if ($rowdate['events_start_date'] != $rowdate['events_end_date']){
			$datestart .= " - " .date('d.m.Y',strtotime($rowdate['events_end_date']));
			//$datestart .= " - " .date('d.m.Y',strtotime($rowdate['events_start_date']));
		}else{
			//$datestart .= " - " .date('d.m.Y',strtotime($rowdate['events_start_date']));
			$dateend .= "<br />";
		}
		$datestart .="<br />";
	 }
		
	}
	
	$homepagelinks = "";
	//eve_contact_url
	if ($row['eve_contact_url'] != ""){
		$homepagelinks .="<a target=_blank href=".$row['eve_contact_url'].">".$homepagelinks1."</a><br>";
	}
	//contact_url
	if ($row['contact_url'] != ""){
		$homepagelinks .="<a target=_blank href=".$row['contact_url'].">".$homepagelinks2."</a><br>";
	}
	//loc_contact_url
	if ($row['loc_contact_url'] != ""){
		$homepagelinks .="<a target=_blank href=".$row['loc_contact_url'].">".$homepagelinks3."</a><br>";
	}
	//
	
	$json .= ",'".$homepagelinks."'";
	$json .= ",'".$currency."'";
	$json .= ",'".$datestart."'";
	//$json .= ",'".$dateend."'";
	$json .= ",'".$quality."'";
	//$json .= ",'".$teachers."'";
	$json .= ",'".$photo_img."']";
	//$json .= ",'".$location."']";
	$json .= "}";
	$rc = true;
}
$json .= "]\n";
$json .= "}";
echo $json;
?>
