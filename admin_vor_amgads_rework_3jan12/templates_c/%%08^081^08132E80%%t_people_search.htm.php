<?php /* Smarty version 2.6.13, created on 2011-07-20 04:53:43
         compiled from t_people_search.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', 't_people_search.htm', 8, false),array('function', 'doevent', 't_people_search.htm', 15, false),array('function', 'build_edit_control', 't_people_search.htm', 51, false),)), $this); ?>
<html>
<head>
<title>t_people: Advanced search page</title>
</head>
<link REL="stylesheet" href="include/style.css" type="text/css">
<?php echo $this->_tpl_vars['includes']; ?>

<body bgcolor=white <?php echo $this->_tpl_vars['onload']; ?>
>
<?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>

<!-- search form -->
<form method="POST" 
action="t_people_list.php" 
name="editform" <?php if ($this->_tpl_vars['noAJAX']): ?> onkeydown="OnKeyDown(event);" <?php endif; ?> >
	<input type="hidden" id="a" name="a" value="advsearch">

<?php echo smarty_function_doevent(array('name' => 'SearchOnLoad'), $this);?>

	
<table CELLPADDING=4 CELLSPACING=1 align='center' width='750'>
<tr valign=center class=blackshade>
<td colspan=5 class=tableheader>

<table width=100% CELLSPACING=0 CELLPADDING=3><tr>
<td width=200 class=tableheader>t_people</td>
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
	<td class=editshade_b>institution
	<input type="Hidden" name="asearchfield[]" value="institution"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_institution" <?php echo $this->_tpl_vars['not_institution']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_institution']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'institution','value' => $this->_tpl_vars['value_institution'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_institution">
	<?php echo smarty_function_build_edit_control(array('field' => 'institution','second' => true,'value' => $this->_tpl_vars['value1_institution'],'mode' => 'search'), $this);?>

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
		
<tr class=shade>
	<td class=editshade_b>username
	<input type="Hidden" name="asearchfield[]" value="username"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_username" <?php echo $this->_tpl_vars['not_username']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_username']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'username','value' => $this->_tpl_vars['value_username'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_username">
	<?php echo smarty_function_build_edit_control(array('field' => 'username','second' => true,'value' => $this->_tpl_vars['value1_username'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>password
	<input type="Hidden" name="asearchfield[]" value="password"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_password" <?php echo $this->_tpl_vars['not_password']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_password']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'password','value' => $this->_tpl_vars['value_password'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_password">
	<?php echo smarty_function_build_edit_control(array('field' => 'password','second' => true,'value' => $this->_tpl_vars['value1_password'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>picture
	<input type="Hidden" name="asearchfield[]" value="picture"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_picture" <?php echo $this->_tpl_vars['not_picture']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_picture']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'picture','value' => $this->_tpl_vars['value_picture'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_picture">
	<?php echo smarty_function_build_edit_control(array('field' => 'picture','second' => true,'value' => $this->_tpl_vars['value1_picture'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>gender
	<input type="Hidden" name="asearchfield[]" value="gender"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_gender" <?php echo $this->_tpl_vars['not_gender']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_gender']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'gender','value' => $this->_tpl_vars['value_gender'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_gender">
	<?php echo smarty_function_build_edit_control(array('field' => 'gender','second' => true,'value' => $this->_tpl_vars['value1_gender'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>adminstatus
	<input type="Hidden" name="asearchfield[]" value="adminstatus"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_adminstatus" <?php echo $this->_tpl_vars['not_adminstatus']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_adminstatus']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'adminstatus','value' => $this->_tpl_vars['value_adminstatus'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_adminstatus">
	<?php echo smarty_function_build_edit_control(array('field' => 'adminstatus','second' => true,'value' => $this->_tpl_vars['value1_adminstatus'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>birthdate
	<input type="Hidden" name="asearchfield[]" value="birthdate"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_birthdate" <?php echo $this->_tpl_vars['not_birthdate']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_birthdate']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'birthdate','value' => $this->_tpl_vars['value_birthdate'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_birthdate">
	<?php echo smarty_function_build_edit_control(array('field' => 'birthdate','second' => true,'value' => $this->_tpl_vars['value1_birthdate'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>enabled
	<input type="Hidden" name="asearchfield[]" value="enabled"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_enabled" <?php echo $this->_tpl_vars['not_enabled']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_enabled']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'enabled','value' => $this->_tpl_vars['value_enabled'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_enabled">
	<?php echo smarty_function_build_edit_control(array('field' => 'enabled','second' => true,'value' => $this->_tpl_vars['value1_enabled'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>temp_sched_from
	<input type="Hidden" name="asearchfield[]" value="temp_sched_from"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_temp_sched_from" <?php echo $this->_tpl_vars['not_temp_sched_from']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_temp_sched_from']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'temp_sched_from','value' => $this->_tpl_vars['value_temp_sched_from'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_temp_sched_from">
	<?php echo smarty_function_build_edit_control(array('field' => 'temp_sched_from','second' => true,'value' => $this->_tpl_vars['value1_temp_sched_from'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>temp_sched_to
	<input type="Hidden" name="asearchfield[]" value="temp_sched_to"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_temp_sched_to" <?php echo $this->_tpl_vars['not_temp_sched_to']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_temp_sched_to']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'temp_sched_to','value' => $this->_tpl_vars['value_temp_sched_to'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_temp_sched_to">
	<?php echo smarty_function_build_edit_control(array('field' => 'temp_sched_to','second' => true,'value' => $this->_tpl_vars['value1_temp_sched_to'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>joiningdate
	<input type="Hidden" name="asearchfield[]" value="joiningdate"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_joiningdate" <?php echo $this->_tpl_vars['not_joiningdate']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_joiningdate']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'joiningdate','value' => $this->_tpl_vars['value_joiningdate'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_joiningdate">
	<?php echo smarty_function_build_edit_control(array('field' => 'joiningdate','second' => true,'value' => $this->_tpl_vars['value1_joiningdate'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>coord_accuracy
	<input type="Hidden" name="asearchfield[]" value="coord_accuracy"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_coord_accuracy" <?php echo $this->_tpl_vars['not_coord_accuracy']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_coord_accuracy']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'coord_accuracy','value' => $this->_tpl_vars['value_coord_accuracy'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_coord_accuracy">
	<?php echo smarty_function_build_edit_control(array('field' => 'coord_accuracy','second' => true,'value' => $this->_tpl_vars['value1_coord_accuracy'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>monday
	<input type="Hidden" name="asearchfield[]" value="monday"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_monday" <?php echo $this->_tpl_vars['not_monday']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_monday']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'monday','value' => $this->_tpl_vars['value_monday'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_monday">
	<?php echo smarty_function_build_edit_control(array('field' => 'monday','second' => true,'value' => $this->_tpl_vars['value1_monday'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>tuesday
	<input type="Hidden" name="asearchfield[]" value="tuesday"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_tuesday" <?php echo $this->_tpl_vars['not_tuesday']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_tuesday']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'tuesday','value' => $this->_tpl_vars['value_tuesday'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_tuesday">
	<?php echo smarty_function_build_edit_control(array('field' => 'tuesday','second' => true,'value' => $this->_tpl_vars['value1_tuesday'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>wednesday
	<input type="Hidden" name="asearchfield[]" value="wednesday"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_wednesday" <?php echo $this->_tpl_vars['not_wednesday']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_wednesday']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'wednesday','value' => $this->_tpl_vars['value_wednesday'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_wednesday">
	<?php echo smarty_function_build_edit_control(array('field' => 'wednesday','second' => true,'value' => $this->_tpl_vars['value1_wednesday'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>thursday
	<input type="Hidden" name="asearchfield[]" value="thursday"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_thursday" <?php echo $this->_tpl_vars['not_thursday']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_thursday']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'thursday','value' => $this->_tpl_vars['value_thursday'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_thursday">
	<?php echo smarty_function_build_edit_control(array('field' => 'thursday','second' => true,'value' => $this->_tpl_vars['value1_thursday'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>friday
	<input type="Hidden" name="asearchfield[]" value="friday"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_friday" <?php echo $this->_tpl_vars['not_friday']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_friday']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'friday','value' => $this->_tpl_vars['value_friday'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_friday">
	<?php echo smarty_function_build_edit_control(array('field' => 'friday','second' => true,'value' => $this->_tpl_vars['value1_friday'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>saturday
	<input type="Hidden" name="asearchfield[]" value="saturday"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_saturday" <?php echo $this->_tpl_vars['not_saturday']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_saturday']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'saturday','value' => $this->_tpl_vars['value_saturday'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_saturday">
	<?php echo smarty_function_build_edit_control(array('field' => 'saturday','second' => true,'value' => $this->_tpl_vars['value1_saturday'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>sunday
	<input type="Hidden" name="asearchfield[]" value="sunday"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_sunday" <?php echo $this->_tpl_vars['not_sunday']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_sunday']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'sunday','value' => $this->_tpl_vars['value_sunday'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_sunday">
	<?php echo smarty_function_build_edit_control(array('field' => 'sunday','second' => true,'value' => $this->_tpl_vars['value1_sunday'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>monday_t
	<input type="Hidden" name="asearchfield[]" value="monday_t"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_monday_t" <?php echo $this->_tpl_vars['not_monday_t']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_monday_t']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'monday_t','value' => $this->_tpl_vars['value_monday_t'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_monday_t">
	<?php echo smarty_function_build_edit_control(array('field' => 'monday_t','second' => true,'value' => $this->_tpl_vars['value1_monday_t'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>tuesday_t
	<input type="Hidden" name="asearchfield[]" value="tuesday_t"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_tuesday_t" <?php echo $this->_tpl_vars['not_tuesday_t']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_tuesday_t']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'tuesday_t','value' => $this->_tpl_vars['value_tuesday_t'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_tuesday_t">
	<?php echo smarty_function_build_edit_control(array('field' => 'tuesday_t','second' => true,'value' => $this->_tpl_vars['value1_tuesday_t'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>wednesday_t
	<input type="Hidden" name="asearchfield[]" value="wednesday_t"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_wednesday_t" <?php echo $this->_tpl_vars['not_wednesday_t']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_wednesday_t']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'wednesday_t','value' => $this->_tpl_vars['value_wednesday_t'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_wednesday_t">
	<?php echo smarty_function_build_edit_control(array('field' => 'wednesday_t','second' => true,'value' => $this->_tpl_vars['value1_wednesday_t'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>thursday_t
	<input type="Hidden" name="asearchfield[]" value="thursday_t"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_thursday_t" <?php echo $this->_tpl_vars['not_thursday_t']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_thursday_t']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'thursday_t','value' => $this->_tpl_vars['value_thursday_t'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_thursday_t">
	<?php echo smarty_function_build_edit_control(array('field' => 'thursday_t','second' => true,'value' => $this->_tpl_vars['value1_thursday_t'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>friday_t
	<input type="Hidden" name="asearchfield[]" value="friday_t"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_friday_t" <?php echo $this->_tpl_vars['not_friday_t']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_friday_t']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'friday_t','value' => $this->_tpl_vars['value_friday_t'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_friday_t">
	<?php echo smarty_function_build_edit_control(array('field' => 'friday_t','second' => true,'value' => $this->_tpl_vars['value1_friday_t'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>saturday_t
	<input type="Hidden" name="asearchfield[]" value="saturday_t"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_saturday_t" <?php echo $this->_tpl_vars['not_saturday_t']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_saturday_t']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'saturday_t','value' => $this->_tpl_vars['value_saturday_t'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_saturday_t">
	<?php echo smarty_function_build_edit_control(array('field' => 'saturday_t','second' => true,'value' => $this->_tpl_vars['value1_saturday_t'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>sunday_t
	<input type="Hidden" name="asearchfield[]" value="sunday_t"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_sunday_t" <?php echo $this->_tpl_vars['not_sunday_t']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_sunday_t']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'sunday_t','value' => $this->_tpl_vars['value_sunday_t'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_sunday_t">
	<?php echo smarty_function_build_edit_control(array('field' => 'sunday_t','second' => true,'value' => $this->_tpl_vars['value1_sunday_t'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>preferred_contact_by
	<input type="Hidden" name="asearchfield[]" value="preferred_contact_by"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_preferred_contact_by" <?php echo $this->_tpl_vars['not_preferred_contact_by']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_preferred_contact_by']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'preferred_contact_by','value' => $this->_tpl_vars['value_preferred_contact_by'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_preferred_contact_by">
	<?php echo smarty_function_build_edit_control(array('field' => 'preferred_contact_by','second' => true,'value' => $this->_tpl_vars['value1_preferred_contact_by'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>date_last_adress_change
	<input type="Hidden" name="asearchfield[]" value="date_last_adress_change"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_date_last_adress_change" <?php echo $this->_tpl_vars['not_date_last_adress_change']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_date_last_adress_change']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'date_last_adress_change','value' => $this->_tpl_vars['value_date_last_adress_change'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_date_last_adress_change">
	<?php echo smarty_function_build_edit_control(array('field' => 'date_last_adress_change','second' => true,'value' => $this->_tpl_vars['value1_date_last_adress_change'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>map_in
	<input type="Hidden" name="asearchfield[]" value="map_in"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_map_in" <?php echo $this->_tpl_vars['not_map_in']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_map_in']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'map_in','value' => $this->_tpl_vars['value_map_in'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_map_in">
	<?php echo smarty_function_build_edit_control(array('field' => 'map_in','second' => true,'value' => $this->_tpl_vars['value1_map_in'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>IconPath
	<input type="Hidden" name="asearchfield[]" value="IconPath"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_IconPath" <?php echo $this->_tpl_vars['not_IconPath']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_IconPath']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'IconPath','value' => $this->_tpl_vars['value_IconPath'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_IconPath">
	<?php echo smarty_function_build_edit_control(array('field' => 'IconPath','second' => true,'value' => $this->_tpl_vars['value1_IconPath'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>note
	<input type="Hidden" name="asearchfield[]" value="note"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_note" <?php echo $this->_tpl_vars['not_note']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_note']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'note','value' => $this->_tpl_vars['value_note'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_note">
	<?php echo smarty_function_build_edit_control(array('field' => 'note','second' => true,'value' => $this->_tpl_vars['value1_note'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>price_per_hour
	<input type="Hidden" name="asearchfield[]" value="price_per_hour"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_price_per_hour" <?php echo $this->_tpl_vars['not_price_per_hour']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_price_per_hour']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'price_per_hour','value' => $this->_tpl_vars['value_price_per_hour'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_price_per_hour">
	<?php echo smarty_function_build_edit_control(array('field' => 'price_per_hour','second' => true,'value' => $this->_tpl_vars['value1_price_per_hour'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>psych_time_loose_tight
	<input type="Hidden" name="asearchfield[]" value="psych_time_loose_tight"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_psych_time_loose_tight" <?php echo $this->_tpl_vars['not_psych_time_loose_tight']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_psych_time_loose_tight']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'psych_time_loose_tight','value' => $this->_tpl_vars['value_psych_time_loose_tight'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_psych_time_loose_tight">
	<?php echo smarty_function_build_edit_control(array('field' => 'psych_time_loose_tight','second' => true,'value' => $this->_tpl_vars['value1_psych_time_loose_tight'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>psych_exact_creativ
	<input type="Hidden" name="asearchfield[]" value="psych_exact_creativ"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_psych_exact_creativ" <?php echo $this->_tpl_vars['not_psych_exact_creativ']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_psych_exact_creativ']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'psych_exact_creativ','value' => $this->_tpl_vars['value_psych_exact_creativ'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_psych_exact_creativ">
	<?php echo smarty_function_build_edit_control(array('field' => 'psych_exact_creativ','second' => true,'value' => $this->_tpl_vars['value1_psych_exact_creativ'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>psych_heart_thing
	<input type="Hidden" name="asearchfield[]" value="psych_heart_thing"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_psych_heart_thing" <?php echo $this->_tpl_vars['not_psych_heart_thing']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_psych_heart_thing']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'psych_heart_thing','value' => $this->_tpl_vars['value_psych_heart_thing'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_psych_heart_thing">
	<?php echo smarty_function_build_edit_control(array('field' => 'psych_heart_thing','second' => true,'value' => $this->_tpl_vars['value1_psych_heart_thing'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>psych_easy_security
	<input type="Hidden" name="asearchfield[]" value="psych_easy_security"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_psych_easy_security" <?php echo $this->_tpl_vars['not_psych_easy_security']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_psych_easy_security']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'psych_easy_security','value' => $this->_tpl_vars['value_psych_easy_security'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_psych_easy_security">
	<?php echo smarty_function_build_edit_control(array('field' => 'psych_easy_security','second' => true,'value' => $this->_tpl_vars['value1_psych_easy_security'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>psych_conflict_take_leave
	<input type="Hidden" name="asearchfield[]" value="psych_conflict_take_leave"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_psych_conflict_take_leave" <?php echo $this->_tpl_vars['not_psych_conflict_take_leave']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_psych_conflict_take_leave']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'psych_conflict_take_leave','value' => $this->_tpl_vars['value_psych_conflict_take_leave'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_psych_conflict_take_leave">
	<?php echo smarty_function_build_edit_control(array('field' => 'psych_conflict_take_leave','second' => true,'value' => $this->_tpl_vars['value1_psych_conflict_take_leave'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>longitude
	<input type="Hidden" name="asearchfield[]" value="longitude"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_longitude" <?php echo $this->_tpl_vars['not_longitude']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_longitude']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'longitude','value' => $this->_tpl_vars['value_longitude'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_longitude">
	<?php echo smarty_function_build_edit_control(array('field' => 'longitude','second' => true,'value' => $this->_tpl_vars['value1_longitude'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>latitude
	<input type="Hidden" name="asearchfield[]" value="latitude"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_latitude" <?php echo $this->_tpl_vars['not_latitude']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_latitude']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'latitude','value' => $this->_tpl_vars['value_latitude'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_latitude">
	<?php echo smarty_function_build_edit_control(array('field' => 'latitude','second' => true,'value' => $this->_tpl_vars['value1_latitude'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>Agree
	<input type="Hidden" name="asearchfield[]" value="Agree"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_Agree" <?php echo $this->_tpl_vars['not_Agree']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_Agree']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'Agree','value' => $this->_tpl_vars['value_Agree'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_Agree">
	<?php echo smarty_function_build_edit_control(array('field' => 'Agree','second' => true,'value' => $this->_tpl_vars['value1_Agree'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>Sign_date
	<input type="Hidden" name="asearchfield[]" value="Sign_date"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_Sign_date" <?php echo $this->_tpl_vars['not_Sign_date']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_Sign_date']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'Sign_date','value' => $this->_tpl_vars['value_Sign_date'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_Sign_date">
	<?php echo smarty_function_build_edit_control(array('field' => 'Sign_date','second' => true,'value' => $this->_tpl_vars['value1_Sign_date'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>Active
	<input type="Hidden" name="asearchfield[]" value="Active"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_Active" <?php echo $this->_tpl_vars['not_Active']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_Active']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'Active','value' => $this->_tpl_vars['value_Active'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_Active">
	<?php echo smarty_function_build_edit_control(array('field' => 'Active','second' => true,'value' => $this->_tpl_vars['value1_Active'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr class=shade>
	<td class=editshade_b>Acode
	<input type="Hidden" name="asearchfield[]" value="Acode"></td>
	<td align=center class=editshade_lb><input type=CheckBox name="not_Acode" <?php echo $this->_tpl_vars['not_Acode']; ?>
></td>
	
	<td class=editshade_lb>
	<?php echo $this->_tpl_vars['searchtype_Acode']; ?>

	</td>
	
	<td width=270 class=editshade_lb><?php echo smarty_function_build_edit_control(array('field' => 'Acode','value' => $this->_tpl_vars['value_Acode'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb><span id="second_Acode">
	<?php echo smarty_function_build_edit_control(array('field' => 'Acode','second' => true,'value' => $this->_tpl_vars['value1_Acode'],'mode' => 'search'), $this);?>

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