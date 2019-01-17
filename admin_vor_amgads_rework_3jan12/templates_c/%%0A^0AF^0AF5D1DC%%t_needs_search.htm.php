<?php /* Smarty version 2.6.13, created on 2011-07-20 04:48:07
         compiled from t_needs_search.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', 't_needs_search.htm', 8, false),array('function', 'doevent', 't_needs_search.htm', 15, false),array('function', 'build_edit_control', 't_needs_search.htm', 51, false),)), $this); ?>
<html>
<head>
<title>t_needs: Advanced search page</title>
</head>
<link REL="stylesheet" href="include/style.css" type="text/css">
<?php echo $this->_tpl_vars['includes']; ?>

<body bgcolor=white <?php echo $this->_tpl_vars['onload']; ?>
>
<?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>

<!-- search form -->
<form method="POST" 
action="t_needs_list.php" 
name="editform" <?php if ($this->_tpl_vars['noAJAX']): ?> onkeydown="OnKeyDown(event);" <?php endif; ?> >
	<input type="hidden" id="a" name="a" value="advsearch">

<?php echo smarty_function_doevent(array('name' => 'SearchOnLoad'), $this);?>

	
<table CELLPADDING=4 CELLSPACING=1 align='center' width='750'>
<tr valign=center class=blackshade>
<td colspan=5 class=tableheader>

<table width=100% CELLSPACING=0 CELLPADDING=3><tr>
<td width=200 class=tableheader>t_needs</td>
<td align=center class=tableheader>
Advanced search</td>
<td width=200 class=tableheader>&nbsp;</td>
</tr></table>

</td></tr>

<tr><td colspan=5 align=center valign=middle class=header2>
<span class=fieldname>Search for: </span>
<input type="radio" name="type" value="and" <?php echo $this->_tpl_vars['all_checked']; ?>
>All conditions
&nbsp;&nbsp;&nbsp;
<input type="radio" name="type" value="or" <?php echo $this->_tpl_vars['any_checked']; ?>
>Any condition
</div>
</td></tr>
<tr valign=center class=blackshade>
<td align=center valign=middle>&nbsp;</td><td width=30 align=center valign=middle class=fieldname>NOT</td>
<td colspan=3 align=center valign=middle>&nbsp; </td></tr>

		
<tr class=shade>
	<td class=editshade_b>need_id
	<input type="Hidden" name="asearchfield[]" value="need_id"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_need_id" <?php echo $this->_tpl_vars['not_need_id']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_need_id']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'need_id','value' => $this->_tpl_vars['value_need_id'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_need_id">
	<?php echo smarty_function_build_edit_control(array('field' => 'need_id','second' => true,'value' => $this->_tpl_vars['value1_need_id'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>people_id
	<input type="Hidden" name="asearchfield[]" value="people_id"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_people_id" <?php echo $this->_tpl_vars['not_people_id']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_people_id']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'people_id','value' => $this->_tpl_vars['value_people_id'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_people_id">
	<?php echo smarty_function_build_edit_control(array('field' => 'people_id','second' => true,'value' => $this->_tpl_vars['value1_people_id'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>need_type_id
	<input type="Hidden" name="asearchfield[]" value="need_type_id"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_need_type_id" <?php echo $this->_tpl_vars['not_need_type_id']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_need_type_id']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'need_type_id','value' => $this->_tpl_vars['value_need_type_id'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_need_type_id">
	<?php echo smarty_function_build_edit_control(array('field' => 'need_type_id','second' => true,'value' => $this->_tpl_vars['value1_need_type_id'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>need_subtype_id
	<input type="Hidden" name="asearchfield[]" value="need_subtype_id"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_need_subtype_id" <?php echo $this->_tpl_vars['not_need_subtype_id']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_need_subtype_id']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'need_subtype_id','value' => $this->_tpl_vars['value_need_subtype_id'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_need_subtype_id">
	<?php echo smarty_function_build_edit_control(array('field' => 'need_subtype_id','second' => true,'value' => $this->_tpl_vars['value1_need_subtype_id'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>need_note
	<input type="Hidden" name="asearchfield[]" value="need_note"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_need_note" <?php echo $this->_tpl_vars['not_need_note']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_need_note']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'need_note','value' => $this->_tpl_vars['value_need_note'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_need_note">
	<?php echo smarty_function_build_edit_control(array('field' => 'need_note','second' => true,'value' => $this->_tpl_vars['value1_need_note'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>need_hourly
	<input type="Hidden" name="asearchfield[]" value="need_hourly"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_need_hourly" <?php echo $this->_tpl_vars['not_need_hourly']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_need_hourly']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'need_hourly','value' => $this->_tpl_vars['value_need_hourly'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_need_hourly">
	<?php echo smarty_function_build_edit_control(array('field' => 'need_hourly','second' => true,'value' => $this->_tpl_vars['value1_need_hourly'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>prof_provider
	<input type="Hidden" name="asearchfield[]" value="prof_provider"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_prof_provider" <?php echo $this->_tpl_vars['not_prof_provider']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_prof_provider']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'prof_provider','value' => $this->_tpl_vars['value_prof_provider'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_prof_provider">
	<?php echo smarty_function_build_edit_control(array('field' => 'prof_provider','second' => true,'value' => $this->_tpl_vars['value1_prof_provider'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>firstname
	<input type="Hidden" name="asearchfield[]" value="firstname"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_firstname" <?php echo $this->_tpl_vars['not_firstname']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_firstname']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'firstname','value' => $this->_tpl_vars['value_firstname'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_firstname">
	<?php echo smarty_function_build_edit_control(array('field' => 'firstname','second' => true,'value' => $this->_tpl_vars['value1_firstname'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>lastname
	<input type="Hidden" name="asearchfield[]" value="lastname"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_lastname" <?php echo $this->_tpl_vars['not_lastname']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_lastname']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'lastname','value' => $this->_tpl_vars['value_lastname'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_lastname">
	<?php echo smarty_function_build_edit_control(array('field' => 'lastname','second' => true,'value' => $this->_tpl_vars['value1_lastname'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>image_path
	<input type="Hidden" name="asearchfield[]" value="image_path"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_image_path" <?php echo $this->_tpl_vars['not_image_path']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_image_path']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'image_path','value' => $this->_tpl_vars['value_image_path'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_image_path">
	<?php echo smarty_function_build_edit_control(array('field' => 'image_path','second' => true,'value' => $this->_tpl_vars['value1_image_path'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>street
	<input type="Hidden" name="asearchfield[]" value="street"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_street" <?php echo $this->_tpl_vars['not_street']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_street']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'street','value' => $this->_tpl_vars['value_street'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_street">
	<?php echo smarty_function_build_edit_control(array('field' => 'street','second' => true,'value' => $this->_tpl_vars['value1_street'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>house_nr
	<input type="Hidden" name="asearchfield[]" value="house_nr"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_house_nr" <?php echo $this->_tpl_vars['not_house_nr']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_house_nr']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'house_nr','value' => $this->_tpl_vars['value_house_nr'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_house_nr">
	<?php echo smarty_function_build_edit_control(array('field' => 'house_nr','second' => true,'value' => $this->_tpl_vars['value1_house_nr'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>zip
	<input type="Hidden" name="asearchfield[]" value="zip"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_zip" <?php echo $this->_tpl_vars['not_zip']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_zip']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'zip','value' => $this->_tpl_vars['value_zip'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_zip">
	<?php echo smarty_function_build_edit_control(array('field' => 'zip','second' => true,'value' => $this->_tpl_vars['value1_zip'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>location
	<input type="Hidden" name="asearchfield[]" value="location"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_location" <?php echo $this->_tpl_vars['not_location']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_location']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'location','value' => $this->_tpl_vars['value_location'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_location">
	<?php echo smarty_function_build_edit_control(array('field' => 'location','second' => true,'value' => $this->_tpl_vars['value1_location'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>locationarea
	<input type="Hidden" name="asearchfield[]" value="locationarea"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_locationarea" <?php echo $this->_tpl_vars['not_locationarea']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_locationarea']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'locationarea','value' => $this->_tpl_vars['value_locationarea'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_locationarea">
	<?php echo smarty_function_build_edit_control(array('field' => 'locationarea','second' => true,'value' => $this->_tpl_vars['value1_locationarea'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>tel_p
	<input type="Hidden" name="asearchfield[]" value="tel_p"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_tel_p" <?php echo $this->_tpl_vars['not_tel_p']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_tel_p']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'tel_p','value' => $this->_tpl_vars['value_tel_p'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_tel_p">
	<?php echo smarty_function_build_edit_control(array('field' => 'tel_p','second' => true,'value' => $this->_tpl_vars['value1_tel_p'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>tel_m
	<input type="Hidden" name="asearchfield[]" value="tel_m"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_tel_m" <?php echo $this->_tpl_vars['not_tel_m']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_tel_m']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'tel_m','value' => $this->_tpl_vars['value_tel_m'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_tel_m">
	<?php echo smarty_function_build_edit_control(array('field' => 'tel_m','second' => true,'value' => $this->_tpl_vars['value1_tel_m'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>email
	<input type="Hidden" name="asearchfield[]" value="email"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_email" <?php echo $this->_tpl_vars['not_email']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_email']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'email','value' => $this->_tpl_vars['value_email'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_email">
	<?php echo smarty_function_build_edit_control(array('field' => 'email','second' => true,'value' => $this->_tpl_vars['value1_email'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>

<tr class=tableheader><td colspan=5 align=center>
<span class=buttonborder><input type=button class=button name="SearchButton" value="Search"
onClick="javascript:document.forms.editform.submit();"></span>
<span class=buttonborder><input class=button type=button value="Reset" onclick="return ResetControls();"></span>
<span class=buttonborder><input type=button class=button value="Back to list" onClick="javascript: document.forms.editform.a.value='return'; document.forms.editform.submit();"></span>
</td></tr>
</table>

</form>
<?php echo smarty_function_include_if_exists(array('file' => "include/footer.php"), $this);?>

<?php echo $this->_tpl_vars['linkdata']; ?>


</body>
</html>