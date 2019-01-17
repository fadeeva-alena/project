<?php

$tdata=array();
	 $tdata[".NumberOfChars"]=80; 
	$tdata[".ShortName"]="_site_mode";
	$tdata[".OwnerID"]="";
	$tdata[".OriginalTable"]="_site_mode";

	$keys=array();
	$keys[]="ID";
	$tdata[".Keys"]=$keys;

	
//	Status
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Status";
		$fdata["FullName"]= "Status";
	
	
	
	
	$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
					$fdata["FieldPermissions"]=true;
		$tdata["Status"]=$fdata;
	
//	Message
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Message";
		$fdata["FullName"]= "Message";
	
	
	
	
	$fdata["Index"]= 2;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=600";
					$fdata["FieldPermissions"]=true;
		$tdata["Message"]=$fdata;
	
//	Mode
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Mode";
		$fdata["FullName"]= "`Mode`";
	
	
	
	
	$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
					$fdata["FieldPermissions"]=true;
		$tdata["Mode"]=$fdata;
	
//	ID
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
	
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ID";
		$fdata["FullName"]= "ID";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["ID"]=$fdata;
$tables_data["_site_mode"]=$tdata;
?>