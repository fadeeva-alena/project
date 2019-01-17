<?php
	require ( '../includes/config.php' );
    require ( '../'.PATH_LIBRARIES.'libraries.php' );
	
	function replace($old){
		$new = str_replace("รค","ไ",$old);	
		$new = str_replace("รถ","๖",$new);	
		$new = str_replace("รผ","ü",$new);	
		$new = str_replace("รฉ","้",$new);	
		$new = str_replace("ำ“","๓",$new);	
		$new = str_replace("รก","แ",$new);	
		$new = str_replace("ร","ไ",$new);	
		$new = str_replace("รจ","แ",$new);	
		return $new;
	}
	
	/// t_leaders
	
	/*$sqlleaders = mysql_query("select * from t_leader");
	while ($rowleaders = mysql_fetch_array($sqlleaders)){
		$company = replace($rowleaders['company']);
		$firstname = replace($rowleaders['firstname']);
		$lastname = replace($rowleaders['lastname']);
		$about = replace($rowleaders['about']);
		$id = replace($rowleaders['id']);
		mysql_query("update t_leader set company='$company', firstname='$firstname', lastname='$lastname',about='$about' where id='$id'");
	}
	
	
	/// t_locations
	$sqllocations = mysql_query("select * from t_location");
	while ($rowlocations = mysql_fetch_array($sqllocations)){
		$loc_name = replace($rowlocations['loc_name']);
		$loc_detail = replace($rowlocations['loc_detail']);
		$loc_adress1 = replace($rowlocations['loc_adress1']);
		$loc_adress2 = replace($rowlocations['loc_adress2']);
		
		$loc_zip = replace($rowlocations['loc_zip']);
		$loc_loc = replace($rowlocations['loc_loc']);
		$loc_shortdesc = replace($rowlocations['loc_shortdesc']);
		$loc_contact_name = replace($rowlocations['loc_contact_name']);
		$id = replace($rowlocations['id']);
		mysql_query("update t_location set loc_name='$loc_name', loc_detail='$loc_detail', loc_adress1='$loc_adress1',loc_adress2='$loc_adress2',loc_zip='$loc_zip', loc_loc='$loc_loc', loc_shortdesc='$loc_shortdesc',loc_contact_name='$loc_contact_name' where id='$id'");
	}
	
	/// t_event
	$sqlevents = mysql_query("select * from t_event");
	while ($rowevents = mysql_fetch_array($sqlevents)){
		$short_desc = replace($rowevents['short_desc']);
		$long_desc = replace($rowevents['long_desc']);
		$location = replace($rowevents['location']);
		$remark_prerequisite = replace($rowevents['remark_prerequisite']);
		
		$date_remark = replace($rowevents['date_remark']);
		$remark_time = replace($rowevents['remark_time']);
		$eve_contact_name = replace($rowevents['eve_contact_name']);
		
		$id = replace($rowevents['id']);
		mysql_query("update t_event set short_desc='$short_desc', long_desc='$long_desc', location='$location',remark_prerequisite='$remark_prerequisite',date_remark='$date_remark', remark_time='$remark_time', eve_contact_name='$eve_contact_name' where id='$id'");
	}*/
	
	/// t_provider
	$sqlproviders = mysql_query("select * from t_provider");
	while ($rowproviders = mysql_fetch_array($sqlproviders)){
		$company = replace($rowproviders['company']);
		$firstname = replace($rowproviders['firstname']);
		$lastname = replace($rowproviders['lastname']);
		$adress1 = replace($rowproviders['adress1']);
		
		$adress2 = replace($rowproviders['adress2']);
		$zip = replace($rowproviders['zip']);
		$location = replace($rowproviders['location']);
		
		$id = replace($rowproviders['id']);
		mysql_query("update t_provider set company='$company', firstname='$firstname', lastname='$lastname',adress1='$adress1',adress2='$adress2', zip='$zip', location='$location' where id='$id'");
	}
	
	/// t_event_kind
	$sqlkind = mysql_query("select * from t_event_kind");
	while ($rowkind = mysql_fetch_array($sqlkind)){
		$kind_de = replace($rowkind['kind_de']);
		$kind_eng = replace($rowkind['kind_eng']);
		$kind_fr = replace($rowkind['kind_fr']);
		$kind_it = replace($rowkind['kind_it']);
	
		$id = replace($rowkind['id']);
		mysql_query("update t_event_kind set kind_de='$kind_de', kind_eng='$kind_eng', kind_fr='$kind_fr',kind_it='$kind_it' where id='$id'");
	}
	
	/// t_event_type
	$sqltype = mysql_query("select * from t_event_type");
	while ($rowtype = mysql_fetch_array($sqltype)){
		$eventtype_de = replace($rowtype['eventtype_de']);
		$eventtype_eng = replace($rowtype['eventtype_eng']);
		$eventtype_fr = replace($rowtype['eventtype_fr']);
		$eventtype_it = replace($rowtype['eventtype_it']);
	
		$id = replace($rowtype['id']);
		mysql_query("update t_event_type set eventtype_de='$eventtype_de', eventtype_eng='$eventtype_eng', eventtype_fr='$eventtype_fr',eventtype_it='$eventtype_it' where id='$id'");
	}
	
	/// t_field_names
	$sqlfieldname = mysql_query("select * from t_field_names");
	while ($rowfieldname = mysql_fetch_array($sqlfieldname)){
		$fieldname_de = replace($rowfieldname['fieldname_de']);
		$fieldname_eng = replace($rowfieldname['fieldname_eng']);
		$fieldname_fr = replace($rowfieldname['fieldname_fr']);
		$fieldname_it = replace($rowfieldname['fieldname_it']);
		
		$helptext_de = replace($rowfieldname['helptext_de']);
		$helptext_eng = replace($rowfieldname['helptext_eng']);
		$helptext_fr = replace($rowfieldname['helptext_fr']);
		$helptext_it = replace($rowfieldname['helptext_it']);
	
		$id = replace($rowfieldname['id']);
		mysql_query("update t_field_names set fieldname_de='$fieldname_de', fieldname_eng='$fieldname_eng', fieldname_fr='$fieldname_fr',fieldname_it='$fieldname_it',helptext_de='$helptext_de', helptext_eng='$helptext_eng', helptext_fr='$helptext_fr',helptext_it='$helptext_it' where id='$id'");
	}
	
?>