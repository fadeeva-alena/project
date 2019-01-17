<?php

$tdata=array();
	 $tdata[".NumberOfChars"]=80; 
	$tdata[".ShortName"]="t_people";
	$tdata[".OwnerID"]="";
	$tdata[".OriginalTable"]="t_people";

	$keys=array();
	$keys[]="people_id";
	$tdata[".Keys"]=$keys;

	
//	people_id
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "people_id";
		$fdata["FullName"]= "people_id";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["people_id"]=$fdata;
	
//	institution
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "institution";
		$fdata["FullName"]= "institution";
	
	
	
	
	$fdata["Index"]= 2;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["institution"]=$fdata;
	
//	prof_provider
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 2;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "prof_provider";
		$fdata["FullName"]= "prof_provider";
	
	
	
	
	$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["prof_provider"]=$fdata;
	
//	firstname
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "firstname";
		$fdata["FullName"]= "firstname";
	
	
	
	
	$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["firstname"]=$fdata;
	
//	lastname
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "lastname";
		$fdata["FullName"]= "lastname";
	
	
	
	
	$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["lastname"]=$fdata;
	
//	image_path
	$fdata = array();
	
	
	 $fdata["LinkPrefix"]="../images/profile/"; 
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "File-based Image";
	
	
	
				
	$fdata["GoodName"]= "image_path";
		$fdata["FullName"]= "image_path";
	
	
	
	
	$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["image_path"]=$fdata;
	
//	street
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "street";
		$fdata["FullName"]= "street";
	
	
	
	
	$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["street"]=$fdata;
	
//	house_nr
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "house_nr";
		$fdata["FullName"]= "house_nr";
	
	
	
	
	$fdata["Index"]= 8;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["house_nr"]=$fdata;
	
//	zip
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "zip";
		$fdata["FullName"]= "zip";
	
	
	
	
	$fdata["Index"]= 9;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["zip"]=$fdata;
	
//	location
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "location";
		$fdata["FullName"]= "location";
	
	
	
	
	$fdata["Index"]= 10;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["location"]=$fdata;
	
//	locationarea
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "locationarea";
		$fdata["FullName"]= "locationarea";
	
	
	
	
	$fdata["Index"]= 11;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["locationarea"]=$fdata;
	
//	tel_p
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "tel_p";
		$fdata["FullName"]= "tel_p";
	
	
	
	
	$fdata["Index"]= 12;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["tel_p"]=$fdata;
	
//	tel_m
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "tel_m";
		$fdata["FullName"]= "tel_m";
	
	
	
	
	$fdata["Index"]= 13;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["tel_m"]=$fdata;
	
//	email
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "email";
		$fdata["FullName"]= "email";
	
	
	
	
	$fdata["Index"]= 14;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["email"]=$fdata;
	
//	username
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "username";
		$fdata["FullName"]= "username";
	
	
	
	
	$fdata["Index"]= 15;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["username"]=$fdata;
	
//	password
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "password";
		$fdata["FullName"]= "password";
	
	
	
	
	$fdata["Index"]= 16;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["password"]=$fdata;
	
//	picture
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "picture";
		$fdata["FullName"]= "picture";
	
	
	
	
	$fdata["Index"]= 17;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["picture"]=$fdata;
	
//	picture_2
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 128;
	$fdata["EditFormat"]= "Database image";
	$fdata["ViewFormat"]= "Database Image";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "picture_2";
		$fdata["FullName"]= "picture_2";
	
	
	
	
	$fdata["Index"]= 18;
	
						$fdata["FieldPermissions"]=true;
		$tdata["picture_2"]=$fdata;
	
//	gender
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "gender";
		$fdata["FullName"]= "gender";
	
	
	
	
	$fdata["Index"]= 19;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["gender"]=$fdata;
	
	
	
//	birthdate
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 7;
	$fdata["EditFormat"]= "Date";
	$fdata["ViewFormat"]= "Short Date";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "birthdate";
		$fdata["FullName"]= "birthdate";
	
	
	
	
	$fdata["Index"]= 21;
	 $fdata["DateEditType"]=13; 
						$fdata["FieldPermissions"]=true;
		$tdata["birthdate"]=$fdata;
	
//	enabled
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 2;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "enabled";
		$fdata["FullName"]= "enabled";
	
	
	
	
	$fdata["Index"]= 22;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["enabled"]=$fdata;
	
//	temp_sched_from
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 201;
	$fdata["EditFormat"]= "Text area";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "temp_sched_from";
		$fdata["FullName"]= "temp_sched_from";
	
	
	
	
	$fdata["Index"]= 23;
	
		$fdata["EditParams"]="";
			$fdata["EditParams"].= " rows=250";
		$fdata["nRows"] = 250;
			$fdata["EditParams"].= " cols=500";
		$fdata["nCols"] = 500;
					$fdata["FieldPermissions"]=true;
		$tdata["temp_sched_from"]=$fdata;
	
//	temp_sched_to
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 201;
	$fdata["EditFormat"]= "Text area";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "temp_sched_to";
		$fdata["FullName"]= "temp_sched_to";
	
	
	
	
	$fdata["Index"]= 24;
	
		$fdata["EditParams"]="";
			$fdata["EditParams"].= " rows=250";
		$fdata["nRows"] = 250;
			$fdata["EditParams"].= " cols=500";
		$fdata["nCols"] = 500;
					$fdata["FieldPermissions"]=true;
		$tdata["temp_sched_to"]=$fdata;
	
//	joiningdate
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 7;
	$fdata["EditFormat"]= "Date";
	$fdata["ViewFormat"]= "Short Date";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "joiningdate";
		$fdata["FullName"]= "joiningdate";
	
	
	
	
	$fdata["Index"]= 25;
	 $fdata["DateEditType"]=13; 
						$fdata["FieldPermissions"]=true;
		$tdata["joiningdate"]=$fdata;
	
//	coord_accuracy
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "coord_accuracy";
		$fdata["FullName"]= "coord_accuracy";
	
	
	
	
	$fdata["Index"]= 26;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["coord_accuracy"]=$fdata;
	
//	monday
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "monday";
		$fdata["FullName"]= "monday";
	
	
	
	
	$fdata["Index"]= 27;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["monday"]=$fdata;
	
//	tuesday
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "tuesday";
		$fdata["FullName"]= "tuesday";
	
	
	
	
	$fdata["Index"]= 28;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["tuesday"]=$fdata;
	
//	wednesday
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "wednesday";
		$fdata["FullName"]= "wednesday";
	
	
	
	
	$fdata["Index"]= 29;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["wednesday"]=$fdata;
	
//	thursday
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "thursday";
		$fdata["FullName"]= "thursday";
	
	
	
	
	$fdata["Index"]= 30;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["thursday"]=$fdata;
	
//	friday
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "friday";
		$fdata["FullName"]= "friday";
	
	
	
	
	$fdata["Index"]= 31;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["friday"]=$fdata;
	
//	saturday
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "saturday";
		$fdata["FullName"]= "saturday";
	
	
	
	
	$fdata["Index"]= 32;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["saturday"]=$fdata;
	
//	sunday
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "sunday";
		$fdata["FullName"]= "sunday";
	
	
	
	
	$fdata["Index"]= 33;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["sunday"]=$fdata;
	
//	monday_t
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "monday_t";
		$fdata["FullName"]= "monday_t";
	
	
	
	
	$fdata["Index"]= 34;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["monday_t"]=$fdata;
	
//	tuesday_t
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "tuesday_t";
		$fdata["FullName"]= "tuesday_t";
	
	
	
	
	$fdata["Index"]= 35;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["tuesday_t"]=$fdata;
	
//	wednesday_t
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "wednesday_t";
		$fdata["FullName"]= "wednesday_t";
	
	
	
	
	$fdata["Index"]= 36;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["wednesday_t"]=$fdata;
	
//	thursday_t
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "thursday_t";
		$fdata["FullName"]= "thursday_t";
	
	
	
	
	$fdata["Index"]= 37;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["thursday_t"]=$fdata;
	
//	friday_t
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "friday_t";
		$fdata["FullName"]= "friday_t";
	
	
	
	
	$fdata["Index"]= 38;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["friday_t"]=$fdata;
	
//	saturday_t
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "saturday_t";
		$fdata["FullName"]= "saturday_t";
	
	
	
	
	$fdata["Index"]= 39;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["saturday_t"]=$fdata;
	
//	sunday_t
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "sunday_t";
		$fdata["FullName"]= "sunday_t";
	
	
	
	
	$fdata["Index"]= 40;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["sunday_t"]=$fdata;
	
//	preferred_contact_by
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "preferred_contact_by";
		$fdata["FullName"]= "preferred_contact_by";
	
	
	
	
	$fdata["Index"]= 41;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["preferred_contact_by"]=$fdata;
	
//	date_last_adress_change
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 7;
	$fdata["EditFormat"]= "Date";
	$fdata["ViewFormat"]= "Short Date";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "date_last_adress_change";
		$fdata["FullName"]= "date_last_adress_change";
	
	
	
	
	$fdata["Index"]= 42;
	 $fdata["DateEditType"]=13; 
						$fdata["FieldPermissions"]=true;
		$tdata["date_last_adress_change"]=$fdata;
	
//	map_in
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "map_in";
		$fdata["FullName"]= "map_in";
	
	
	
	
	$fdata["Index"]= 43;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["map_in"]=$fdata;
	
//	IconPath
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IconPath";
		$fdata["FullName"]= "IconPath";
	
	
	
	
	$fdata["Index"]= 44;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["IconPath"]=$fdata;
	
//	Icon
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 128;
	$fdata["EditFormat"]= "Database image";
	$fdata["ViewFormat"]= "Database Image";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Icon";
		$fdata["FullName"]= "Icon";
	
	
	
	
	$fdata["Index"]= 45;
	
						$fdata["FieldPermissions"]=true;
		$tdata["Icon"]=$fdata;
	
//	note
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 201;
	$fdata["EditFormat"]= "Text area";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "note";
		$fdata["FullName"]= "note";
	
	
	
	
	$fdata["Index"]= 46;
	
		$fdata["EditParams"]="";
			$fdata["EditParams"].= " rows=250";
		$fdata["nRows"] = 250;
			$fdata["EditParams"].= " cols=500";
		$fdata["nCols"] = 500;
					$fdata["FieldPermissions"]=true;
		$tdata["note"]=$fdata;
	
//	price_per_hour
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 5;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "price_per_hour";
		$fdata["FullName"]= "price_per_hour";
	
	
	
	
	$fdata["Index"]= 47;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["price_per_hour"]=$fdata;
	
//	psych_time_loose_tight
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "psych_time_loose_tight";
		$fdata["FullName"]= "psych_time_loose_tight";
	
	
	
	
	$fdata["Index"]= 48;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["psych_time_loose_tight"]=$fdata;
	
//	psych_exact_creativ
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "psych_exact_creativ";
		$fdata["FullName"]= "psych_exact_creativ";
	
	
	
	
	$fdata["Index"]= 49;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["psych_exact_creativ"]=$fdata;
	
//	psych_heart_thing
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "psych_heart_thing";
		$fdata["FullName"]= "psych_heart_thing";
	
	
	
	
	$fdata["Index"]= 50;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["psych_heart_thing"]=$fdata;
	
//	psych_easy_security
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "psych_easy_security";
		$fdata["FullName"]= "psych_easy_security";
	
	
	
	
	$fdata["Index"]= 51;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["psych_easy_security"]=$fdata;
	
//	psych_conflict_take_leave
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "psych_conflict_take_leave";
		$fdata["FullName"]= "psych_conflict_take_leave";
	
	
	
	
	$fdata["Index"]= 52;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["psych_conflict_take_leave"]=$fdata;
	
//	longitude
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 5;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "longitude";
		$fdata["FullName"]= "longitude";
	
	
	
	
	$fdata["Index"]= 53;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["longitude"]=$fdata;
	
//	latitude
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 5;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "latitude";
		$fdata["FullName"]= "latitude";
	
	
	
	
	$fdata["Index"]= 54;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["latitude"]=$fdata;
	
//	Agree
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Agree";
		$fdata["FullName"]= "Agree";
	
	
	
	
	$fdata["Index"]= 55;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=1";
					$fdata["FieldPermissions"]=true;
		$tdata["Agree"]=$fdata;
	
//	Sign_date
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Sign_date";
		$fdata["FullName"]= "Sign_date";
	
	
	
	
	$fdata["Index"]= 56;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
					$fdata["FieldPermissions"]=true;
		$tdata["Sign_date"]=$fdata;
	
//	Active
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Active";
		$fdata["FullName"]= "Active";
	
	
	
	
	$fdata["Index"]= 57;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=1";
					$fdata["FieldPermissions"]=true;
		$tdata["Active"]=$fdata;
	
//	Acode
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Acode";
		$fdata["FullName"]= "Acode";
	
	
	
	
	$fdata["Index"]= 58;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=5";
					$fdata["FieldPermissions"]=true;
		$tdata["Acode"]=$fdata;
$tables_data["t_people"]=$tdata;
?>
