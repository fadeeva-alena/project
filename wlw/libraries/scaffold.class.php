<?php
class Scaffold
{

	function radio_arr($options=array(), $values=array(), $name="", $selected_value="", $separator="", $other_attributes="")
	{
		$output = '';
		$id = '';
		$i = 0;
		foreach ($values as $value) {
			$check = $selected_value==$value ? 'checked="checked"' : '';
			$output .= "<input type=\"radio\" name=\"$name\" id=\"$name"."_".$i."\" value=\"$values[$i]\" $check $other_attributes /> ".$options[$i].$separator."\r\n";
			$i++;
		}
		return $output;
	}


	function checkbox_arr($options=array(), $values=array(), $name="", $selected_value="", $separator="", $other_attributes="")
	{
		$output = '';
		$id = '';
		$i = 0;
		foreach ($values as $value) {
			$check = $selected_value==$value ? 'checked="checked"' : '';
			$output .= "<input type=\"checkbox\" name=\"$name\" id=\"$name"."_".$i."\" value=\"$values[$i]\" $check $other_attributes /> ".$options[$i].$separator."\r\n";
			$i++;
		}
		return $output;
	}


	function checkbox($option="",$value="",$name="",$id="",$selected=false,$other_attributes="",$separator="")
	{
		$check = $selected_value==$value ? 'checked="checked"' : '';
		$output .= "<input type=\"checkbox\" name=\"$name\" id=\"$id\" value=\"$value\" $check $other_attributes /> $option $separator\r\n";
		return $output;
	}


	function dropdown_option($option,$value,$selected=false)
	{
		$select_value = $selected==true ? "selected=\"selected\"" : '';
		return "<option value=\"$value\" $select_value >$option</option>\r\n";
	}


	function dropdown($name,$options,$other_attr)
	{
		return "<select name=\"$name\" id=\"$name\" $other_attr >\r\n$options\r\n</select>\r\n";
	}

	
	
	function dropdown_rs($rs,$value_display=array(),$name="",$selected_value="",$select_text="",$other_attributes="")
	{	
		$selectopt_tmp = ($selected_value==0 || $selected_value=='') ? "selected=\"selected\"" : '';		
		$output = "";
		$output .= "<select name=\"$name\" id=\"$name\" $other_attributes >\r\n";	
		$output .= "    <option value=\"\" $selectopt_tmp>- $select_text -</option>\r\n";

		if ($rs)
		{
			foreach ($rs as $row)
			{
				$select_option = "";
				if ($selected_value > 0) {				
					if ($row->$value_display['value'] == $selected_value) {
						$select_option = "selected=\"selected\"";
					}
				}
				//$rowx = str_replace("ü","&#252;",$row->$value_display['display']);
				$output .= "    <option value=\"".$row->$value_display['value']."\" $select_option >".fixEncoding($row->$value_display['display'])."</option>\r\n";	
				//$output .= "    <option value=\"".$row->$value_display['value']."\" $select_option >".fixEncoding($rowx)."</option>\r\n";	
				$i++;
			}
		}
		$output .= "</select>\r\n";
		return $output;
	}
	
	function dropdown_rs2($rs,$value_display=array(),$name="",$selected_value="",$select_text="",$other_attributes="")
	{	
		$selectopt_tmp = ($selected_value==0 || $selected_value=='') ? "selected=\"selected\"" : '';		
		$output = "";
		$output .= "<select name=\"$name\" id=\"$name\" $other_attributes >\r\n";	
		//$output .= "    <option value=\"\" $selectopt_tmp>- $select_text -</option>\r\n";

		if ($rs)
		{
			foreach ($rs as $row)
			{
				$select_option = "";
				if ($selected_value > 0) {				
					if ($row->$value_display['value'] == $selected_value) {
						$select_option = "selected=\"selected\"";
					}
				}
				$output .= "    <option value=\"".$row->$value_display['value']."\" $select_option >".fixEncoding($row->$value_display['display'])."</option>\r\n";	
				$i++;
			}
		}
		$output .= "</select>\r\n";
		return $output;
	}

/*
	function dropdown_rs($rs,$params)
	{	
		
		//$params['value']
		//$params['display']
		//$params['name']
		//$params['opt_default']
		//$params['opt_selected']
		//$params['attributes']					
		//print_r($params);
		
		$selectopt_tmp = ($params['opt_selected']==0 || $params['opt_selected']=='') ? "selected=\"selected\"" : '';		
		$output = "";
		$output .= "<select name=\"".$params['name']."\" id=\"".$params['name']."\" ".$params['attributes']>" >\r\n";	
		$output .= "    <option value=\"\" $selectopt_tmp>- ".$params['opt_default']." -</option>\r\n";

		if ($rs)
		{
			foreach ($rs as $row)
			{
				$select_option = "";
				if ($selected_value > 0) {				
					if ($row->$params['value'] == $params['opt_selected']) {
						$select_option = "selected=\"selected\"";
					}
				}
				$output .= "    <option value=\"".$row->$params['value']."\" $select_option >".$row->$params['display']."</option>\r\n";	
				$i++;
			}
		}
		$output .= "</select>\r\n";
		return $output;

	}
*/	
	
	function dropdown_arr($options=array(), $values=array(), $name="", $selected_value=NULL, $select_text="", $other_attributes="")
	{	
		$selectopt_tmp = ($selected_value==0 || $selected_value=='') ? "selected=\"selected\"" : '';		
		$output = "";
		$output .= "<select name=\"$name\" id=\"$name\" $other_attributes >\r\n";	
		$output .= "    <option value=\"\" $selectopt_tmp>- $select_text -</option>\r\n";
		
		if ($values)
		{
			$i = 0;	
			foreach ($values as $value)
			{
				$select_option = "";
				if (!empty($selected_value)) {				
					if ($values[$i] == $selected_value) {
						$select_option = "selected=\"selected\"";
					}
				}
				$output .= "    <option value=\"$values[$i]\" $select_option >$options[$i]</option>\r\n";	
				$i++;
			}
		}
		$output .= "</select>\r\n";
		return $output;
	}

	// -> time minute function
	function createHours($id='hours_select', $selected=null, $other_attr=' ')
	{
		/*** range of hours ***/
		$r = range(1, 24);
	
		/*** current hour ***/
		$selected = is_null($selected) ? date('h') : $selected;
	
		$select = "<select name=\"$id\" id=\"$id\" $other_attr>\n";
		foreach ($r as $hour)
		{
			$select .= "<option value=\"$hour\"";
			$select .= ($hour==$selected) ? ' selected="selected"' : '';
			$select .= ">$hour</option>\n";
		}
		$select .= '</select>';
		return $select;
	}
	function createMinutes($id='minute_select', $selected=null, $other_attr=' ')
	{
		/*** array of mins ***/
		$minutes = array(00, 15, 30, 45);
	
		$selected = in_array($selected, $minutes) ? $selected : 0;
	
		$select = "<select name=\"$id\" id=\"$id\" $other_attr>\n";
		foreach($minutes as $min)
		{
			$select .= "<option value=\"$min\"";
			$select .= ($min==$selected) ? ' selected="selected"' : '';
			$select .= ">".str_pad($min, 2, '0')."</option>\n";
		}
		$select .= '</select>';
		return $select;
	}
	
}
?>