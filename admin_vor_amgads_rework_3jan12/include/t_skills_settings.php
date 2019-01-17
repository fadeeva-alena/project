<?php

$tdata=array();
	 $tdata[".NumberOfChars"]=80; 
	$tdata[".ShortName"]="t_skills";
	$tdata[".OwnerID"]="";
	$tdata[".OriginalTable"]="t_skills";

	$keys=array();
	$keys[]="skill_id";
	$tdata[".Keys"]=$keys;

	
//	skill_id
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "skill_id";
		$fdata["FullName"]= "t_skills.skill_id";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["skill_id"]=$fdata;
	
//	people_id
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "people_id";
		$fdata["FullName"]= "t_skills.people_id";
	
	
	
	
	$fdata["Index"]= 2;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["people_id"]=$fdata;
	
//	skill_type_id
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
	
	
		$fdata["LookupType"]=1;
		$fdata["LookupWhere"]="";
	$fdata["LinkField"]="`skilltype_id`";
	$fdata["LinkFieldType"]=3;
		$fdata["DisplayField"]="`skilltype`";
	$fdata["LookupTable"]="t_skill_types";
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "skill_type_id";
		$fdata["FullName"]= "t_skills.skill_type_id";
	
	
	
	
	$fdata["Index"]= 3;
	
						$fdata["FieldPermissions"]=true;
		$tdata["skill_type_id"]=$fdata;
	
//	skill_subtype_id
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
	
	
		$fdata["LookupType"]=1;
		$fdata["LookupWhere"]="";
	$fdata["LinkField"]="`skill_subtype_id`";
	$fdata["LinkFieldType"]=3;
		$fdata["DisplayField"]="`skill_subtype`";
	$fdata["LookupTable"]="t_skill_subtype";
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "skill_subtype_id";
		$fdata["FullName"]= "t_skills.skill_subtype_id";
	
	
	
	
	$fdata["Index"]= 4;
	
						$fdata["FieldPermissions"]=true;
		$tdata["skill_subtype_id"]=$fdata;
	
//	skill_note
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 201;
	$fdata["EditFormat"]= "Text area";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "skill_note";
		$fdata["FullName"]= "t_skills.skill_note";
	
	
	
	
	$fdata["Index"]= 5;
	
		$fdata["EditParams"]="";
			$fdata["EditParams"].= " rows=250";
		$fdata["nRows"] = 250;
			$fdata["EditParams"].= " cols=500";
		$fdata["nCols"] = 500;
					$fdata["FieldPermissions"]=true;
		$tdata["skill_note"]=$fdata;
	
//	skill_hourly
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "skill_hourly";
		$fdata["FullName"]= "t_skills.skill_hourly";
	
	
	
	
	$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["skill_hourly"]=$fdata;
	
//	prof_provider
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 2;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "prof_provider";
		$fdata["FullName"]= "t_people.prof_provider";
	
	
	
	
	$fdata["Index"]= 7;
	
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
		$fdata["FullName"]= "t_people.firstname";
	
	
	
	
	$fdata["Index"]= 8;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["firstname"]=$fdata;
	
//	lastname
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "lastname";
		$fdata["FullName"]= "t_people.lastname";
	
	
	
	
	$fdata["Index"]= 9;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["lastname"]=$fdata;
	
//	image_path
	$fdata = array();
	
	
	 $fdata["LinkPrefix"]="../images/profile/"; 
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "File-based Image";
	
	
	
				
	$fdata["GoodName"]= "image_path";
		$fdata["FullName"]= "t_people.image_path";
	
	
	
	
	$fdata["Index"]= 10;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["image_path"]=$fdata;
	
//	street
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "street";
		$fdata["FullName"]= "t_people.street";
	
	
	
	
	$fdata["Index"]= 11;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["street"]=$fdata;
	
//	house_nr
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "house_nr";
		$fdata["FullName"]= "t_people.house_nr";
	
	
	
	
	$fdata["Index"]= 12;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["house_nr"]=$fdata;
	
//	zip
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "zip";
		$fdata["FullName"]= "t_people.zip";
	
	
	
	
	$fdata["Index"]= 13;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["zip"]=$fdata;
	
//	location
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "location";
		$fdata["FullName"]= "t_people.location";
	
	
	
	
	$fdata["Index"]= 14;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["location"]=$fdata;
	
//	locationarea
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "locationarea";
		$fdata["FullName"]= "t_people.locationarea";
	
	
	
	
	$fdata["Index"]= 15;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["locationarea"]=$fdata;
	
//	tel_p
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "tel_p";
		$fdata["FullName"]= "t_people.tel_p";
	
	
	
	
	$fdata["Index"]= 16;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["tel_p"]=$fdata;
	
//	tel_m
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "tel_m";
		$fdata["FullName"]= "t_people.tel_m";
	
	
	
	
	$fdata["Index"]= 17;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["tel_m"]=$fdata;
	
//	email
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "email";
		$fdata["FullName"]= "t_people.email";
	
	
	
	
	$fdata["Index"]= 18;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["email"]=$fdata;
$tables_data["t_skills"]=$tdata;
?>