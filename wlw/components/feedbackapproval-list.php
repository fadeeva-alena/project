<?php
/*
INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('606', 'unified record', 'unified record', 'unified record', 'unified record', 'unified record', 'unified record', 'unified record', 'unified record', 'unified record', '11')
*/
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
require ( '../'.PATH_INCLUDES.'json-headers.php' );

$sqlfield = mysql_query("select * from t_field_names where id=684");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$acceptlabel = fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$acceptlabel = fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$acceptlabel = fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$acceptlabel = fixEncodingx($rowfield['fieldname_it']);
			}

$sqlfield = mysql_query("select * from t_field_names where id=685");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$denylabel = fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$denylabel = fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$denylabel = fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$denylabel = fixEncodingx($rowfield['fieldname_it']);
			}
$sqlfield = mysql_query("select * from t_field_names where id=693");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$denied = fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$denied = fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$denied = fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$denied = fixEncodingx($rowfield['fieldname_it']);
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
$_SESSION['events_providernamexxx']= $providername;

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
		  $where .=" and e.leader='$providername'";
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


	

$sql = "SELECT *,f.id as fid,c.currency as currencyal,loc.loc_name as locationval,e.id as eid FROM $table_name 
		e inner join t_leader l on e.leader=l.id  
		inner join t_currency c on e.currency=c.id  
		inner join t_location loc on e.location=loc.id  
		inner join t_dates d on e.id=d.events_id
		inner join t_country country on country.id=loc.loc_country
		inner join t_feedbacks f on e.id=f.events_id
		group by f.id order by feedback_datetime asc $limit";

$result = mysql_query($sql);

 $sql2 = "SELECT *,c.currency as currencyal,loc.loc_name as locationval,e.id as eid FROM $table_name 
		e inner join t_leader l on e.leader=l.id  
		inner join t_currency c on e.currency=c.id  
		inner join t_location loc on e.location=loc.id  
		inner join t_dates d on e.id=d.events_id
		inner join t_country country on country.id=loc.loc_country
		inner join t_feedbacks f on e.id=f.events_id group by f.id";
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
	$record_id = $row['fid'];
	
		
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
	$json .= "cell:['"."<div class=widthfix style=width:150px;>".$row1."</div>'";
	
	$sqlprovider = mysql_query("select * from t_provider where id='".$row['feedback_by']."'");
	$rowprovider = mysql_fetch_array($sqlprovider);

	$feedbackby = $rowprovider['firstname'] . " " . $rowprovider['lastname'];
	
	
	$json .= ",'".$feedbackby."'";
	
	if ($row['feedback_events_accepted'] == 0){
	$feedbackevent = "<div class=widthfix>".fixEncodingx($row['feedback_events']) . " <br /><a style=cursor:pointer; onclick=deny(".$row['fid'].",1,0)>".fixEncodingx($denylabel)."</a> | <a style=cursor:pointer; onclick=accept(".$row['fid'].",1,1)>".fixEncodingx($acceptlabel)."</a></div>";
	}elseif ($row['feedback_events_accepted'] == 1){
	$feedbackevent = "<div class=widthfix>".fixEncodingx($row['feedback_events'])."</div>";
	}else{
	$feedbackevent = "<div class=widthfix>".fixEncodingx($row['feedback_events'])."<br /><span style=color:red;font-color:red;>".fixEncodingx($denied)."</span></div>";
	}
	
	if ($row['feedback_events'] != ""){
		$json .= ",'".fixEncodingx($feedbackevent)."'";
	}else{
		$feedbackevent = "";
		$json .= ",'".fixEncodingx($feedbackevent)."'";
	}

	if ($row['feedback_locations_accepted'] == 0){
	$feedbacklocation = "<div class=widthfix>".fixEncodingx($row['feedback_locations']) . " <br /><a style=cursor:pointer; onclick=deny(".$row['fid'].",2,0)>".fixEncodingx($denylabel)."</a> | <a style=cursor:pointer; onclick=accept(".$row['fid'].",2,1)>".fixEncodingx($acceptlabel)."</a></div>";
	}elseif ($row['feedback_locations_accepted'] == 1){
	$feedbacklocation = "<div class=widthfix>".fixEncodingx($row['feedback_locations'])."</div>";
	}else{
	$feedbacklocation = "<div class=widthfix>".fixEncodingx($row['feedback_locations'])."<br /><span style=color:red;font-color:red;>".fixEncodingx($denied)."</span></div>";
	}

	
	if ($row['feedback_locations'] != ""){
		$json .= ",'".fixEncodingx($feedbacklocation)."'";
	}else{
		$feedbacklocation = "";
		$json .= ",'".fixEncodingx($feedbacklocation)."'";
	}

	if ($row['feedback_leaders_accepted'] == 0){
	$feedbackleader = "<div class=widthfix>".$row['feedback_leaders'] . " <br /><a style=cursor:pointer; onclick=deny(".$row['fid'].",3,0)>".$denylabel."</a> | <a style=cursor:pointer; onclick=accept(".$row['fid'].",3,1)>".$acceptlabel."</a></div>";
	}elseif ($row['feedback_leaders_accepted'] == 1){
	$feedbackleader = "<div class=widthfix>".$row['feedback_leaders']."</div>";
	}else{
	$feedbackleader = "<div class=widthfix>".$row['feedback_leaders']."<br /><span style=color:red;font-color:red;>".$denied."</span></div>";
	}
	//$json .= ",'".fixEncodingx($feedbackleader)."'";
	
	if ($row['feedback_leaders'] != ""){
		$json .= ",'".fixEncodingx($feedbackleader)."'";
	}else{
		$feedbackleader = "";
		$json .= ",'".fixEncodingx($feedbackleader)."'";
	}

	if ($row['feedback_spiritwings_accepted'] == 0){
	$feedbackspiritwings = "<div class=widthfix>".$row['feedback_spiritwings'] . " <br /><a style=cursor:pointer; onclick=deny(".$row['fid'].",4,0)>".$denylabel."</a> | <a style=cursor:pointer; onclick=accept(".$row['fid'].",4,1)>".$acceptlabel."</a></div>";
	}elseif ($row['feedback_spiritwings_accepted'] == 1){
	$feedbackspiritwings = "<div class=widthfix>".$row['feedback_spiritwings']."</div>";
	}else{
	$feedbackspiritwings = "<div class=widthfix>".$row['feedback_spiritwings']."<br /><span style=color:red;font-color:red;>".$denied."</span></div>";
	}
	//$json .= ",'".fixEncodingx($feedbackspiritwings)."']";
	
	if ($row['feedback_spiritwings'] != ""){
		$json .= ",'".fixEncodingx($feedbackspiritwings)."']";
	}else{
		$feedbackspiritwings = "";
		$json .= ",'".fixEncodingx($feedbackspiritwings)."']";
	}
	
	//$json .= ",'".$location."']";
	$json .= "}";
	$rc = true;
}
$json .= "]\n";
$json .= "}";
echo $json;
?>
