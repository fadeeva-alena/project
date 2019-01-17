<?php
         error_reporting(0);
         session_start();
         require_once ( '../includes/config.php' );
         require_once ( '../'.PATH_LIBRARIES.'libraries.php' );

function fixEncodingtest($s)
{
	$s = str_replace("Ã¼","ü",$s);	
	
    return $s;
}
		 
		 $sqllocation = mysql_query("select * from t_location");
		 while ($rowlocation = mysql_fetch_array($sqllocation)){
			$loc_name = fixEncodingtest($rowlocation['loc_name']);
			$loc_detail = fixEncodingtest($rowlocation['loc_detail']);
			$loc_adress1 = fixEncodingtest($rowlocation['loc_adress1']);
			$loc_adress2 = fixEncodingtest($rowlocation['loc_adress2']);
			$loc_country = fixEncodingtest($rowlocation['loc_country']);
			$loc_zip = fixEncodingtest($rowlocation['loc_zip']);
			$loc_loc = fixEncodingtest($rowlocation['loc_loc']);
			$loc_shortdesc = fixEncodingtest($rowlocation['loc_shortdesc']);
			$loc_contact_name = fixEncodingtest($rowlocation['loc_contact_name']);
			$loc_contact_gender = fixEncodingtest($rowlocation['loc_contact_gender']);
			$loc_contact_phone = fixEncodingtest($rowlocation['loc_contact_phone']);
			$loc_contact_email = fixEncodingtest($rowlocation['loc_contact_email']);
			$loc_contact_url = fixEncodingtest($rowlocation['loc_contact_url']);
			$id = $rowlocation['id'];
			
			$sqlupdatelocation = mysql_query("update t_location
				set loc_name='$loc_name',
				loc_detail='$loc_detail',
				loc_adress1='$loc_adress1',
				loc_adress2='$loc_adress2',
				loc_country='$loc_country',
				loc_zip='$loc_zip',
				loc_loc='$loc_loc',
				loc_shortdesc='$loc_shortdesc',
				loc_contact_name='$loc_contact_name',
				loc_contact_email='$loc_contact_email'
				where id='$id'
			");
		 }
		 
		////

		$sqlleader = mysql_query("select * from t_leader");
		 while ($rowleader = mysql_fetch_array($sqlleader)){
			$company = fixEncodingtest($rowleader['company']);
			$firstname = fixEncodingtest($rowleader['firstname']);
			$lastname = fixEncodingtest($rowleader['lastname']);
			
			$id = $rowleader['id'];
			
			$sqlupdatelocation = mysql_query("update t_leader
				set company='$company',
				firstname='$firstname',
				lastname='$lastname'
				where id='$id'
			");
		 }
		 
		 $sqlevent = mysql_query("select * from t_event");
		 while ($rowevent = mysql_fetch_array($sqlevent)){
			$title = fixEncodingtest($rowevent['title']);
			$short_desc = fixEncodingtest($rowevent['short_desc']);
			$long_desc = fixEncodingtest($rowevent['long_desc']);
			
			$id = $rowevent['id'];
			
			$sqlupdatelocation = mysql_query("update t_event
				set title='$title',
				short_desc='$short_desc',
				long_desc='$long_desc'
				where id='$id'
			");
		 }
		
		 
?>