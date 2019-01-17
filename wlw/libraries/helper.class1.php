<?php
function fixEncodingx($s)
{
	$s = str_replace("�","&#196;",$s);
	$s = str_replace("�","&#214;",$s);
	$s = str_replace("�","&#220;",$s);
	$s = str_replace("�","&#228;",$s);
	//� ö
	$s = str_replace("ö","&#246;",$s);
	$s = str_replace("�","&#246;",$s);
	$s = str_replace("�","&#252;",$s);	
	
	$s = str_replace("�","&#232;",$s);	
	$s = str_replace("�","&#233;",$s);	
	$s = str_replace("�","&#234;",$s);	
	$s = str_replace("�","&#235;",$s);

	$s = str_replace("�","&agrave;",$s);	
	$s = str_replace("�","&aacute;",$s);	
	$s = str_replace("�","&aring;",$s);	
	
	
	$s = str_replace("�","&ograve;",$s);	
	$s = str_replace("�","&oacute;",$s);	
	$s = str_replace("�","&ocirc;",$s);
	$s = str_replace("�","&otilde;",$s);	
	
	
	$s = str_replace("�","&ugrave;",$s);	
	$s = str_replace("�","&uacute;",$s);	
	$s = str_replace("�","&ucirc;",$s);	
	
	$s = str_replace("�","&#241;",$s);	
	$s = str_replace("�","&#253;",$s);	
	$s = str_replace("�","&#8216;",$s);	
	
	$s = str_replace("�","&#8216;",$s);	
	$s = str_replace("�","&#8217;",$s);	
	$s = str_replace("�","&#8218;",$s);	
	$s = str_replace("�","&#8220;",$s);	
	$s = str_replace("�","&#8221;",$s);	
	$s = str_replace("�","&#8222;",$s);	
	
	$s = str_replace("�","&#174;",$s);	
	$s = str_replace("�","&#8211;",$s);	
	$s = str_replace("�","&#8482;",$s);	
	
	$s = str_replace("�","&#8226;",$s);	
	$s = str_replace("�","&#8364;",$s);	
	$s = str_replace("�","&#353;",$s);	
	$s = str_replace("�","&#168;",$s);	
	
	
	$s = str_replace("�","&#231;",$s);	
	$s = str_replace("�","&#238;",$s);	
	//$s = str_replace("ü","�",$s);	
	$s = str_replace("ü","&#252;",$s);	
	$s = str_replace("�","&#168;",$s);	
	//$s = str_replace("ä","�",$s);	
	$s = str_replace("ä","&#228;",$s);	
	$s = str_replace("�","&#195;",$s);	
	$s = str_replace("�","&#182;",$s);	
	
	$s = str_replace("'","",$s);	
	
    return $s;
}

function fixEncoding($s)
{
	$s = str_replace("�","&#196;",$s);
	$s = str_replace("�","&#214;",$s);
	$s = str_replace("�","&#220;",$s);
	$s = str_replace("�","&#228;",$s);
	//� ö
	$s = str_replace("ö","&#246;",$s);
	$s = str_replace("�","&#246;",$s);
	$s = str_replace("�","&#252;",$s);	
	
	$s = str_replace("�","&#232;",$s);	
	$s = str_replace("�","&#233;",$s);	
	$s = str_replace("�","&#234;",$s);	
	$s = str_replace("�","&#235;",$s);

	$s = str_replace("�","&agrave;",$s);	
	$s = str_replace("�","&aacute;",$s);	
	$s = str_replace("�","&aring;",$s);	
	
	
	$s = str_replace("�","&ograve;",$s);	
	$s = str_replace("�","&oacute;",$s);	
	$s = str_replace("�","&ocirc;",$s);
	$s = str_replace("�","&otilde;",$s);	
	
	
	$s = str_replace("�","&ugrave;",$s);	
	$s = str_replace("�","&uacute;",$s);	
	$s = str_replace("�","&ucirc;",$s);	
	
	$s = str_replace("�","&#241;",$s);	
	$s = str_replace("�","&#253;",$s);	
	$s = str_replace("�","&#8216;",$s);	
	
	$s = str_replace("�","&#8216;",$s);	
	$s = str_replace("�","&#8217;",$s);	
	$s = str_replace("�","&#8218;",$s);	
	$s = str_replace("�","&#8220;",$s);	
	$s = str_replace("�","&#8221;",$s);	
	$s = str_replace("�","&#8222;",$s);	
	
	$s = str_replace("�","&#174;",$s);	
	$s = str_replace("�","&#8211;",$s);	
	$s = str_replace("�","&#8482;",$s);	
	
	$s = str_replace("�","&#8226;",$s);	
	$s = str_replace("�","&#8364;",$s);	
	$s = str_replace("�","&#353;",$s);	
	$s = str_replace("�","&#168;",$s);	
	
	
	$s = str_replace("�","&#231;",$s);	
	$s = str_replace("�","&#238;",$s);	
	//$s = str_replace("ü","�",$s);	
	$s = str_replace("ü","&#252;",$s);	
	$s = str_replace("�","&#168;",$s);	
	//$s = str_replace("ä","�",$s);	
	$s = str_replace("ä","&#228;",$s);	
	$s = str_replace("�","&#195;",$s);	
	$s = str_replace("�","&#182;",$s);	
	
	//� �
    return $s;
}

class Helper
{
	function init_grid($grid_id="")
	{
		$grid = '	<table id="'.strtolower($grid_id).'" style="display:none"></table>';
		return $grid;
	}
	
	function button_val($mode, $button_name) 
	{	
		switch ($mode)
		{
			case 'add':
				return "Add New " . $button_name;
				break;
			case 'edit':
				return "Update " . $button_name;
				break;
			case "delete":
				return "Delete " . $button_name;
				break;
			default: 
				return "&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;";
		}	
	}

	function operation_msg($action="", $result="", $record="")
	{			
		$result_msg = "";
		$is_successful = true;
		if ( $result != "true" ) {
			$is_successful = false;
		}
		
		switch ($action) 
		{
			case 'add':
				$sqlfield = mysql_query("select * from t_field_names where id=277");
				$rowfield = mysql_fetch_array($sqlfield);
				if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
					$add = $rowfield['fieldname_de'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
					$add = $rowfield['fieldname_eng'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
					$add = $rowfield['fieldname_fr'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
					$add = $rowfield['fieldname_it'];
				}
				$result_msg = $add;
				if ( $is_successful == false ) {
					$result_msg = "Adding " & $record & " failed!";
				}
				break;
			case 'edit':
				$sqlfield = mysql_query("select * from t_field_names where id=278");
				$rowfield = mysql_fetch_array($sqlfield);
				if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
					$update = $rowfield['fieldname_de'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
					$update = $rowfield['fieldname_eng'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
					$update = $rowfield['fieldname_fr'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
					$update = $rowfield['fieldname_it'];
				}
				$result_msg = $update;
				if ( $is_successful == false ) {
					if ( $result == '' ) {
						$sqlfield = mysql_query("select * from t_field_names where id=286");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$update = $rowfield['fieldname_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$update = $rowfield['fieldname_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$update = $rowfield['fieldname_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$update = $rowfield['fieldname_it'];
						}
						$result_msg = $update;
					} else {
						$result_msg = $record . " update failed!";
					}
				}
				break;
			case 'delete':
				$sqlfield = mysql_query("select * from t_field_names where id=285");
				$rowfield = mysql_fetch_array($sqlfield);
				if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
					$update = $rowfield['fieldname_de'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
					$update = $rowfield['fieldname_eng'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
					$update = $rowfield['fieldname_fr'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
					$update = $rowfield['fieldname_it'];
				}
				$result_msg = $update;
				if ( $is_successful == false ) {
					$sqlfield = mysql_query("select * from t_field_names where id=287");
					$rowfield = mysql_fetch_array($sqlfield);
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						$update = $rowfield['fieldname_de'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						$update = $rowfield['fieldname_eng'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						$update = $rowfield['fieldname_fr'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						$update = $rowfield['fieldname_it'];
					}
					$result_msg = $update;
				}
				break;
			default:
				$result_msg = "";
		}			
		return $result_msg;		
	}
	
	
	function is_editable($mode)
	{		
		switch ($mode)
		{
			case 'view':
				return false;
				break;
			case 'add':
				return true;
				break;
			case 'edit':
				return true;
				break;
			case 'delete':
				return false;
				break;
			default:
				return false;
		}
	}
	
	function pre_print_r($array)
	{
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}


	function unique_id()
	{
		list($usec, $sec) = explode(" ", microtime());
		list($int, $dec) = explode(".", $usec);
		return $sec.$dec;   
	}


	function get_photo_size($file, $postfix="")
	{
		$dot = strrpos($file, '.');
		$ext = substr($file, $dot);		
		$basename = preg_replace('#\.[^.]*$#', '', $file);
		$filename = $basename.$postfix.$ext;

//		$ext = strtolower(strrchr($file,'.'));		
//		$pos = strrpos($file, ".");
//		$filename = substr($file, 0, $pos).$postfix.$ext;
		
		return $filename;	
	}

	function readable_date($var,$format="d-M-Y")
	{
		return date($format, strtotime($var));
	}

	function readable_daydate($var,$format="D, M d, Y")
	{
		return date($format, strtotime($var));
	}

	function readable_datetime($var,$format="d-M-Y, h:i A")
	{
		return date($format, strtotime($var));
	}
	function return_date_format($var,$format="Y-m-d")
	{
		return date($format, strtotime($var));
	}
	function display_date_format($var,$format="m/d/Y")
	{
		return date($format, strtotime($var));
	}

	function dispaly_date_diff($departure_date, $arrival_date)
	{
		$arrival_date = strtotime($arrival_date);
		$departure_date = strtotime($departure_date);

		$datediff = ($departure_date - $arrival_date);
		return round($datediff / 86400);
	}

	function readable_MDdate($var,$format="M d")
	{
		return date($format, strtotime($var));
	}
	
}
?>