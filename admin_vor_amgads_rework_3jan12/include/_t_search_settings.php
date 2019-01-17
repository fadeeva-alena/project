<?php

$tdata=array();
	 $tdata[".NumberOfChars"]=80; 
	$tdata[".ShortName"]="_t_search";
	$tdata[".OwnerID"]="";
	$tdata[".OriginalTable"]="_t_search";

	$keys=array();
	$keys[]="searchid";
	$tdata[".Keys"]=$keys;

	
//	date
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 135;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "date";
		$fdata["FullName"]= "`date`";
	
	
	
	
	$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
					$fdata["FieldPermissions"]=true;
		$tdata["date"]=$fdata;
	
//	searchid
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "searchid";
		$fdata["FullName"]= "searchid";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 2;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["searchid"]=$fdata;
	
//	Search_type
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Search_type";
		$fdata["FullName"]= "Search_type";
	
	
	
	
	$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
					$fdata["FieldPermissions"]=true;
		$tdata["Search_type"]=$fdata;
	
//	Username
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Username";
		$fdata["FullName"]= "Username";
	
	
	
	
	$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
					$fdata["FieldPermissions"]=true;
		$tdata["Username"]=$fdata;
	
//	Skill_type
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
	
	$fdata["GoodName"]= "Skill_type";
		$fdata["FullName"]= "Skill_type";
	
	
	
	
	$fdata["Index"]= 5;
	
						$fdata["FieldPermissions"]=true;
		$tdata["Skill_type"]=$fdata;
	
//	Skill_Subtype
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
	
	$fdata["GoodName"]= "Skill_Subtype";
		$fdata["FullName"]= "Skill_Subtype";
	
	
	
	
	$fdata["Index"]= 6;
	
						$fdata["FieldPermissions"]=true;
		$tdata["Skill_Subtype"]=$fdata;
	
//	Gender
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Gender";
		$fdata["FullName"]= "Gender";
	
	
	
	
	$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
					$fdata["FieldPermissions"]=true;
		$tdata["Gender"]=$fdata;
$tables_data["_t_search"]=$tdata;
?>