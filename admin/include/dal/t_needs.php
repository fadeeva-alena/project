<?php
$dalTablet_needs = array();
$dalTablet_needs["need_id"] = array("type"=>3,"varname"=>"need_id");
$dalTablet_needs["people_id"] = array("type"=>3,"varname"=>"people_id");
$dalTablet_needs["need_type_id"] = array("type"=>3,"varname"=>"need_type_id");
$dalTablet_needs["need_subtype_id"] = array("type"=>3,"varname"=>"need_subtype_id");
$dalTablet_needs["need_note"] = array("type"=>201,"varname"=>"need_note");
$dalTablet_needs["need_hourly"] = array("type"=>3,"varname"=>"need_hourly");
	$dalTablet_needs["need_id"]["key"]=true;
$dal_info["t_needs"]=&$dalTablet_needs;

?>