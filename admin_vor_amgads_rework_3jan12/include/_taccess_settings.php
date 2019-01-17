<?php

$tdata=array();
	 $tdata[".NumberOfChars"]=80; 
	$tdata[".ShortName"]="_taccess";
	$tdata[".OwnerID"]="";
	$tdata[".OriginalTable"]="_taccess";

	$keys=array();
	$keys[]="ID";
	$tdata[".Keys"]=$keys;

	
//	Country
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Country";
		$fdata["FullName"]= "Country";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
					$fdata["FieldPermissions"]=true;
		$tdata["Country"]=$fdata;
	
//	Zip
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
	
	
		$fdata["LookupType"]=1;
		$fdata["LookupWhere"]="";
	$fdata["LinkField"]="`ZIP`";
	$fdata["LinkFieldType"]=2;
		$fdata["DisplayField"]="`ZIP`";
	$fdata["LookupTable"]="t_zipch";
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Zip";
		$fdata["FullName"]= "Zip";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 2;
	
						$fdata["FieldPermissions"]=true;
		$tdata["Zip"]=$fdata;
	
//	Location
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
	
		$fdata["UseCategory"]=true; 
	$fdata["CategoryControl"]="Zip"; 

		$fdata["LookupType"]=1;
		$fdata["LookupWhere"]="";
	$fdata["LinkField"]="`Location`";
	$fdata["LinkFieldType"]=200;
		$fdata["DisplayField"]="`Location`";
	$fdata["LookupTable"]="t_zipch";
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Location";
		$fdata["FullName"]= "Location";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 3;
	
						$fdata["FieldPermissions"]=true;
		$tdata["Location"]=$fdata;
	
//	Start
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 7;
	$fdata["EditFormat"]= "Date";
	$fdata["ViewFormat"]= "Short Date";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Start";
		$fdata["FullName"]= "`Start`";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 4;
	 $fdata["DateEditType"]=13; 
						$fdata["FieldPermissions"]=true;
		$tdata["Start"]=$fdata;
	
//	End
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 7;
	$fdata["EditFormat"]= "Date";
	$fdata["ViewFormat"]= "Short Date";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "End";
		$fdata["FullName"]= "`End`";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 5;
	 $fdata["DateEditType"]=13; 
						$fdata["FieldPermissions"]=true;
		$tdata["End"]=$fdata;
	
//	Note
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Note";
		$fdata["FullName"]= "Note";
	
	
	
	
	$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=300";
					$fdata["FieldPermissions"]=true;
		$tdata["Note"]=$fdata;
	
//	ID
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ID";
		$fdata["FullName"]= "ID";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["ID"]=$fdata;
$tables_data["_taccess"]=$tdata;
?>