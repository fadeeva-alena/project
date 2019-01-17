<?php /* Smarty version 2.6.13, created on 2011-07-20 04:52:16
         compiled from t_people_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', 't_people_list.htm', 9, false),array('function', 'doevent', 't_people_list.htm', 1026, false),)), $this); ?>
<html>
<head>
<title>t_people</title>
<link REL="stylesheet" href="include/style.css" type="text/css">
</head>
<body topmargin=5 bgcolor=white <?php echo $this->_tpl_vars['onload']; ?>
>
<?php echo $this->_tpl_vars['includes']; ?>


<?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>


<form name="frmSearch" method="GET" action="t_people_list.php">
<input type="Hidden" name="a" value="search">
<input type="Hidden" name="value" value="1">
<input type="Hidden" name="SearchFor" value="">
<input type="Hidden" name="SearchOption" value="">
<input type="Hidden" name="SearchField" value="">
</form>
<table width=99% align=center border=0 cellpadding=0 cellspacing=0><tr><td>

<table class="navigation" cellspacing="0" cellpadding="3" width=100% border=0>

<tr>
<td align=left><font style="FONT-FAMILY: Verdana, Arial;">Logged as</font>&nbsp;<b><?php echo $this->_tpl_vars['userid']; ?>
</b>&nbsp;
<a href="login.php?a=logout" >Log out</a>


</td>

<td align=right>

&nbsp;&nbsp;&nbsp;
<a href="t_people_search.php">Advanced search</a>	


<?php if ($this->_tpl_vars['rowsfound']): ?>


&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
<a target="_blank" href="t_people_export.php">Export results</a>



&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
<a target="_blank" href="t_people_print.php">Printer-friendly version</a>
&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
<a target="_blank" href="t_people_print.php?all=1">Print all pages</a>


<?php endif; ?>


&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
<a href="t_people_import.php">Import</a>




<!--language-->


</tr>
</table>

<br>
<table class="main_table_border" cellspacing="0" cellpadding="0" border=0>
<tr>
<td class=body2 width=10px>&nbsp;</td>

	<td width=1px class=border_menu></td>
	<td class=border_menu>&nbsp;</td>
	<td class=border_menu width=1px></td>
	<td class=body2 width=11px></td>


	<td width=1px class=border_menu></td>
	<td class=border_menu>&nbsp;</td>
	<td class=border_menu width=1px></td>
	<td class=body2 width=11px></td>


	<td width=1px class=border_menu></td>
	<td class=border_menu>&nbsp;</td>
	<td class=border_menu width=1px></td>
	<td class=body2 width=11px></td>


	<td width=1px class=border_menu></td>
	<td class=border_menu>&nbsp;</td>
	<td class=border_menu width=1px></td>
	<td class=body2 width=11px></td>


	<td width=1px class=border_menu></td>
	<td class=border_menu>&nbsp;</td>
	<td class=border_menu width=1px></td>
	<td class=body2 width=11px></td>


	<td width=1px class=border_menu></td>
	<td class=border_menu>&nbsp;</td>
	<td class=border_menu width=1px></td>
	<td class=body2 width=11px></td>


	<td width=1px class=border_menu></td>
	<td class=border_menu>&nbsp;</td>
	<td class=border_menu width=1px></td>
	<td class=body2 width=11px></td>

</tr>
<tr>
<td class=body2 width=10px>&nbsp;</td>

		<td width=1px class=border_menu_left></td>
	<td class=td_border_menu2>
	<a class=menu_db href="_site_mode_list.php">site_mode</a></td>
	<td class=body2 colspan=2>
	<img src="include/img/menu_blue_unselect.gif" border=0></td>


		<td width=1px class=border_menu_left></td>
	<td class=td_border_menu2>
	<a class=menu_db href="t_log_list.php">t_log</a></td>
	<td class=body2 colspan=2>
	<img src="include/img/menu_blue_unselect.gif" border=0></td>


		<td width=1px class=border_menu_left></td>
	<td class=td_border_menu2>
	<a class=menu_db href="_t_search_list.php">t_search</a></td>
	<td class=body2 colspan=2>
	<img src="include/img/menu_blue_unselect.gif" border=0></td>


		<td width=1px class=border_menu_left></td>
	<td class=td_border_menu>
	<a class=menu_db href="t_people_list.php">t_people</a></td>
	<td class=body2 colspan=2>
	<img src="include/img/menu_blue_select.gif" border=0></td>


		<td width=1px class=border_menu_left></td>
	<td class=td_border_menu2>
	<a class=menu_db href="t_skills_list.php">t_skills</a></td>
	<td class=body2 colspan=2>
	<img src="include/img/menu_blue_unselect.gif" border=0></td>


		<td width=1px class=border_menu_left></td>
	<td class=td_border_menu2>
	<a class=menu_db href="t_needs_list.php">t_needs</a></td>
	<td class=body2 colspan=2>
	<img src="include/img/menu_blue_unselect.gif" border=0></td>


		<td width=1px class=border_menu_left></td>
	<td class=td_border_menu2>
	<a class=menu_db href="_taccess_list.php">taccess</a></td>
	<td class=body2 colspan=2>
	<img src="include/img/menu_blue_unselect.gif" border=0></td>

</tr></table>


<table border=0 cellpadding=0 cellspacing=0 class=main_table_border2 width=100%><tr><td>

<table class="main_table_border" cellspacing="0" cellpadding="0" width=100% border=0>


<tr>
    <td height="35" valign=middle align=center style="padding-top:2px;">
<b>Search for </b> &nbsp;&nbsp;&nbsp;
<select id="ctlSearchField">
<option value="">Any field</option>
<option value="people_id" <?php echo $this->_tpl_vars['search_people_id']; ?>
>people_id</option>
<option value="institution" <?php echo $this->_tpl_vars['search_institution']; ?>
>institution</option>
<option value="prof_provider" <?php echo $this->_tpl_vars['search_prof_provider']; ?>
>prof_provider</option>
<option value="firstname" <?php echo $this->_tpl_vars['search_firstname']; ?>
>firstname</option>
<option value="lastname" <?php echo $this->_tpl_vars['search_lastname']; ?>
>lastname</option>
<option value="image_path" <?php echo $this->_tpl_vars['search_image_path']; ?>
>image_path</option>
<option value="street" <?php echo $this->_tpl_vars['search_street']; ?>
>street</option>
<option value="house_nr" <?php echo $this->_tpl_vars['search_house_nr']; ?>
>house_nr</option>
<option value="zip" <?php echo $this->_tpl_vars['search_zip']; ?>
>zip</option>
<option value="location" <?php echo $this->_tpl_vars['search_location']; ?>
>location</option>
<option value="locationarea" <?php echo $this->_tpl_vars['search_locationarea']; ?>
>locationarea</option>
<option value="tel_p" <?php echo $this->_tpl_vars['search_tel_p']; ?>
>tel_p</option>
<option value="tel_m" <?php echo $this->_tpl_vars['search_tel_m']; ?>
>tel_m</option>
<option value="email" <?php echo $this->_tpl_vars['search_email']; ?>
>email</option>
<option value="username" <?php echo $this->_tpl_vars['search_username']; ?>
>username</option>
<option value="password" <?php echo $this->_tpl_vars['search_password']; ?>
>password</option>
<option value="picture" <?php echo $this->_tpl_vars['search_picture']; ?>
>picture</option>
<option value="gender" <?php echo $this->_tpl_vars['search_gender']; ?>
>gender</option>
<option value="adminstatus" <?php echo $this->_tpl_vars['search_adminstatus']; ?>
>adminstatus</option>
<option value="birthdate" <?php echo $this->_tpl_vars['search_birthdate']; ?>
>birthdate</option>
<option value="enabled" <?php echo $this->_tpl_vars['search_enabled']; ?>
>enabled</option>
<option value="temp_sched_from" <?php echo $this->_tpl_vars['search_temp_sched_from']; ?>
>temp_sched_from</option>
<option value="temp_sched_to" <?php echo $this->_tpl_vars['search_temp_sched_to']; ?>
>temp_sched_to</option>
<option value="joiningdate" <?php echo $this->_tpl_vars['search_joiningdate']; ?>
>joiningdate</option>
<option value="coord_accuracy" <?php echo $this->_tpl_vars['search_coord_accuracy']; ?>
>coord_accuracy</option>
<option value="monday" <?php echo $this->_tpl_vars['search_monday']; ?>
>monday</option>
<option value="tuesday" <?php echo $this->_tpl_vars['search_tuesday']; ?>
>tuesday</option>
<option value="wednesday" <?php echo $this->_tpl_vars['search_wednesday']; ?>
>wednesday</option>
<option value="thursday" <?php echo $this->_tpl_vars['search_thursday']; ?>
>thursday</option>
<option value="friday" <?php echo $this->_tpl_vars['search_friday']; ?>
>friday</option>
<option value="saturday" <?php echo $this->_tpl_vars['search_saturday']; ?>
>saturday</option>
<option value="sunday" <?php echo $this->_tpl_vars['search_sunday']; ?>
>sunday</option>
<option value="monday_t" <?php echo $this->_tpl_vars['search_monday_t']; ?>
>monday_t</option>
<option value="tuesday_t" <?php echo $this->_tpl_vars['search_tuesday_t']; ?>
>tuesday_t</option>
<option value="wednesday_t" <?php echo $this->_tpl_vars['search_wednesday_t']; ?>
>wednesday_t</option>
<option value="thursday_t" <?php echo $this->_tpl_vars['search_thursday_t']; ?>
>thursday_t</option>
<option value="friday_t" <?php echo $this->_tpl_vars['search_friday_t']; ?>
>friday_t</option>
<option value="saturday_t" <?php echo $this->_tpl_vars['search_saturday_t']; ?>
>saturday_t</option>
<option value="sunday_t" <?php echo $this->_tpl_vars['search_sunday_t']; ?>
>sunday_t</option>
<option value="preferred_contact_by" <?php echo $this->_tpl_vars['search_preferred_contact_by']; ?>
>preferred_contact_by</option>
<option value="date_last_adress_change" <?php echo $this->_tpl_vars['search_date_last_adress_change']; ?>
>date_last_adress_change</option>
<option value="map_in" <?php echo $this->_tpl_vars['search_map_in']; ?>
>map_in</option>
<option value="IconPath" <?php echo $this->_tpl_vars['search_IconPath']; ?>
>IconPath</option>
<option value="note" <?php echo $this->_tpl_vars['search_note']; ?>
>note</option>
<option value="price_per_hour" <?php echo $this->_tpl_vars['search_price_per_hour']; ?>
>price_per_hour</option>
<option value="psych_time_loose_tight" <?php echo $this->_tpl_vars['search_psych_time_loose_tight']; ?>
>psych_time_loose_tight</option>
<option value="psych_exact_creativ" <?php echo $this->_tpl_vars['search_psych_exact_creativ']; ?>
>psych_exact_creativ</option>
<option value="psych_heart_thing" <?php echo $this->_tpl_vars['search_psych_heart_thing']; ?>
>psych_heart_thing</option>
<option value="psych_easy_security" <?php echo $this->_tpl_vars['search_psych_easy_security']; ?>
>psych_easy_security</option>
<option value="psych_conflict_take_leave" <?php echo $this->_tpl_vars['search_psych_conflict_take_leave']; ?>
>psych_conflict_take_leave</option>
<option value="longitude" <?php echo $this->_tpl_vars['search_longitude']; ?>
>longitude</option>
<option value="latitude" <?php echo $this->_tpl_vars['search_latitude']; ?>
>latitude</option>
<option value="Agree" <?php echo $this->_tpl_vars['search_Agree']; ?>
>Agree</option>
<option value="Sign_date" <?php echo $this->_tpl_vars['search_Sign_date']; ?>
>Sign_date</option>
<option value="Active" <?php echo $this->_tpl_vars['search_Active']; ?>
>Active</option>
<option value="Acode" <?php echo $this->_tpl_vars['search_Acode']; ?>
>Acode</option>
</select>
&nbsp;
<select id="ctlSearchOption">
<option value="Contains" <?php echo $this->_tpl_vars['search_contains_option_selected']; ?>
>Contains</option>
<option value="Equals" <?php echo $this->_tpl_vars['search_equals_option_selected']; ?>
>Equals</option>
<option value="Starts with ..." <?php echo $this->_tpl_vars['search_startswith_option_selected']; ?>
>Starts with ...</option>
<option value="More than ..." <?php echo $this->_tpl_vars['search_more_option_selected']; ?>
>More than ...</option>
<option value="Less than ..." <?php echo $this->_tpl_vars['search_less_option_selected']; ?>
>Less than ...</option>
<option value="Equal or more than ..." <?php echo $this->_tpl_vars['search_equalormore_option_selected']; ?>
>Equal or more than ...</option>
<option value="Equal or less than ..." <?php echo $this->_tpl_vars['search_equalorless_option_selected']; ?>
>Equal or less than ...</option>
<option value="Empty" <?php echo $this->_tpl_vars['search_empty_option_selected']; ?>
>Empty</option>
</select>
&nbsp;
<input type=text size=20  autocomplete="off" onkeydown="return listenEvent(event,this,'ordinary');" onkeyup="searchSuggest(event,this,'ordinary');"  name="ctlSearchFor" id="ctlSearchFor" <?php echo $this->_tpl_vars['search_searchfor']; ?>
>
&nbsp;
<span class=buttonborder><input type=button class="button" value="Search"
onClick="javascript: RunSearch();"></span>
&nbsp;		
<span class=buttonborder><input type=button class=button value="Show all" 
onClick="javascript: frmSearch.a.value = 'showall'; frmSearch.submit();"></span>


&nbsp;&nbsp;&nbsp;
Details found: <?php echo $this->_tpl_vars['records_found']; ?>
&nbsp;
Page <?php echo $this->_tpl_vars['page']; ?>
 of <?php echo $this->_tpl_vars['maxpages']; ?>



&nbsp;&nbsp;&nbsp;Records Per Page:
<select 
onChange="javascript: document.location='t_people_list.php?pagesize='+this.options[this.selectedIndex].value;">
<option value="10" <?php echo $this->_tpl_vars['rpp10_selected']; ?>
>10</option>
<option value="20" <?php echo $this->_tpl_vars['rpp20_selected']; ?>
>20</option>
<option value="30" <?php echo $this->_tpl_vars['rpp30_selected']; ?>
>30</option>
<option value="50" <?php echo $this->_tpl_vars['rpp50_selected']; ?>
>50</option>
<option value="100" <?php echo $this->_tpl_vars['rpp100_selected']; ?>
>100</option>
<option value="500" <?php echo $this->_tpl_vars['rpp500_selected']; ?>
>500</option>
</select>
</strong></td>

</tr>


<tr>
    <td colspan=2>
<table width="100%" cellpadding=0 cellspacing=0>
<tr><td class=body2 align=center style="padding:8px;">

<span style="white-space:nowrap;">
	   
 

<?php if ($this->_tpl_vars['display_grid']): ?>

<span name="record_controls">


	 


<span class=buttonborder><input class=button type=button value="Export selected" onclick="var c=0; if(frmAdmin.elements['selection[]'].length==undefined && frmAdmin.elements['selection[]'].checked) c=1; else for (i=0;i<frmAdmin.elements['selection[]'].length;++i) if (frmAdmin.elements['selection[]'][i].checked) c=1;  if(c==0) return true; frmAdmin.action='t_people_export.php';frmAdmin.target='_blank';frmAdmin.submit(); frmAdmin.action='t_people_list.php'; frmAdmin.target='_self';"></span>



<span class=buttonborder><input class=button type=button value="Print selected" onclick="var c=0; if(frmAdmin.elements['selection[]'].length==undefined && frmAdmin.elements['selection[]'].checked) c=1; else for (i=0;i<frmAdmin.elements['selection[]'].length;++i) if (frmAdmin.elements['selection[]'][i].checked) c=1;  if(c==0) return true; frmAdmin.action='t_people_print.php';frmAdmin.target='_blank';frmAdmin.submit(); frmAdmin.action='t_people_list.php'; frmAdmin.target='_self';"></span>

</span>
<?php endif; ?>
</span>
</td></tr>

<?php if ($this->_tpl_vars['display_grid']): ?>

<tr><td class=body2 colspan=2><div id="usermessage" class="message"></div></td></tr>
<tr><td colspan=2>

<!-- delete form -->
<form method="POST" action="t_people_list.php" name="frmAdmin">
	<input type=hidden id="a" name="a" value="delete">
<table name="maintable" class="data" align="center" width="100%" border="0" cellpadding=3 cellspacing=0>
<!-- table header -->
<tr class="blackshade" valign="top">

<?php if ($this->_tpl_vars['column1show']): ?>




<td width=50 align="center" class="headerlist"><img src="images/icon_view.gif"></td>


<td width=50 align="center" class="headerlist">
<input type=checkbox onClick = "var i; /*this.checked=!this.checked; */
if ((typeof frmAdmin.elements['selection[]'].length)=='undefined')
	frmAdmin.elements['selection[]'].checked=this.checked;
else
for (i=0;i<frmAdmin.elements['selection[]'].length;++i) 
	frmAdmin.elements['selection[]'][i].checked=this.checked;">
</td>



<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_people_id']; ?>
people%5Fid">
people_id</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_people_id']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_institution']; ?>
institution">
institution</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_institution']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_prof_provider']; ?>
prof%5Fprovider">
prof_provider</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_prof_provider']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_firstname']; ?>
firstname">
firstname</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_firstname']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_lastname']; ?>
lastname">
lastname</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_lastname']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_image_path']; ?>
image%5Fpath">
image_path</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_image_path']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_street']; ?>
street">
street</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_street']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_house_nr']; ?>
house%5Fnr">
house_nr</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_house_nr']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_zip']; ?>
zip">
zip</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_zip']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_location']; ?>
location">
location</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_location']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_locationarea']; ?>
locationarea">
locationarea</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_locationarea']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_tel_p']; ?>
tel%5Fp">
tel_p</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_tel_p']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_tel_m']; ?>
tel%5Fm">
tel_m</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_tel_m']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_email']; ?>
email">
email</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_email']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_username']; ?>
username">
username</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_username']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_password']; ?>
password">
password</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_password']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_picture']; ?>
picture">
picture</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_picture']; ?>
</td>
</table>
</td>
<td class="headerlist">picture_2</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_gender']; ?>
gender">
gender</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_gender']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_adminstatus']; ?>
adminstatus">
adminstatus</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_adminstatus']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_birthdate']; ?>
birthdate">
birthdate</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_birthdate']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_enabled']; ?>
enabled">
enabled</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_enabled']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_temp_sched_from']; ?>
temp%5Fsched%5Ffrom">
temp_sched_from</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_temp_sched_from']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_temp_sched_to']; ?>
temp%5Fsched%5Fto">
temp_sched_to</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_temp_sched_to']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_joiningdate']; ?>
joiningdate">
joiningdate</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_joiningdate']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_coord_accuracy']; ?>
coord%5Faccuracy">
coord_accuracy</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_coord_accuracy']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_monday']; ?>
monday">
monday</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_monday']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_tuesday']; ?>
tuesday">
tuesday</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_tuesday']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_wednesday']; ?>
wednesday">
wednesday</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_wednesday']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_thursday']; ?>
thursday">
thursday</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_thursday']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_friday']; ?>
friday">
friday</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_friday']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_saturday']; ?>
saturday">
saturday</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_saturday']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_sunday']; ?>
sunday">
sunday</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_sunday']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_monday_t']; ?>
monday%5Ft">
monday_t</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_monday_t']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_tuesday_t']; ?>
tuesday%5Ft">
tuesday_t</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_tuesday_t']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_wednesday_t']; ?>
wednesday%5Ft">
wednesday_t</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_wednesday_t']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_thursday_t']; ?>
thursday%5Ft">
thursday_t</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_thursday_t']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_friday_t']; ?>
friday%5Ft">
friday_t</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_friday_t']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_saturday_t']; ?>
saturday%5Ft">
saturday_t</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_saturday_t']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_sunday_t']; ?>
sunday%5Ft">
sunday_t</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_sunday_t']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_preferred_contact_by']; ?>
preferred%5Fcontact%5Fby">
preferred_contact_by</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_preferred_contact_by']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_date_last_adress_change']; ?>
date%5Flast%5Fadress%5Fchange">
date_last_adress_change</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_date_last_adress_change']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_map_in']; ?>
map%5Fin">
map_in</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_map_in']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_IconPath']; ?>
IconPath">
IconPath</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_IconPath']; ?>
</td>
</table>
</td>
<td class="headerlist">Icon</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_note']; ?>
note">
note</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_note']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_price_per_hour']; ?>
price%5Fper%5Fhour">
price_per_hour</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_price_per_hour']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_psych_time_loose_tight']; ?>
psych%5Ftime%5Floose%5Ftight">
psych_time_loose_tight</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_psych_time_loose_tight']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_psych_exact_creativ']; ?>
psych%5Fexact%5Fcreativ">
psych_exact_creativ</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_psych_exact_creativ']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_psych_heart_thing']; ?>
psych%5Fheart%5Fthing">
psych_heart_thing</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_psych_heart_thing']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_psych_easy_security']; ?>
psych%5Feasy%5Fsecurity">
psych_easy_security</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_psych_easy_security']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_psych_conflict_take_leave']; ?>
psych%5Fconflict%5Ftake%5Fleave">
psych_conflict_take_leave</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_psych_conflict_take_leave']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_longitude']; ?>
longitude">
longitude</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_longitude']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_latitude']; ?>
latitude">
latitude</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_latitude']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_Agree']; ?>
Agree">
Agree</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_Agree']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_Sign_date']; ?>
Sign%5Fdate">
Sign_date</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_Sign_date']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_Active']; ?>
Active">
Active</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_Active']; ?>
</td>
</table>
</td>
<td class="headerlist_right"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_people_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_Acode']; ?>
Acode">
Acode</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_Acode']; ?>
</td>
</table>
</td>
<?php endif; ?>
</tr>



<!-- table data -->
<!--<?php $_from = $this->_tpl_vars['rowinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>-->


<tr valign="top"
<?php echo $this->_tpl_vars['row']['shadeclass']; ?>
 
onmouseover="this.className = 'rowselected';" onmouseout="this.className = '<?php echo $this->_tpl_vars['row']['shadeclassname']; ?>
';"
<?php echo $this->_tpl_vars['row']['rowstyle']; ?>

> 







<td align="center" valign=middle class=borderbody>
<a class="tablelinks" href="t_people_view.php?<?php echo $this->_tpl_vars['row']['1editlink']; ?>
" >
View</a>
</td>


<td align="center" valign=middle class=borderbody>

<input type=checkbox name="selection[]" value="<?php echo $this->_tpl_vars['row']['1keyblock']; ?>
" id="check<?php echo $this->_tpl_vars['row']['1recno']; ?>
">

</td>





<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1people_id_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1people_id_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1institution_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1institution_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1prof_provider_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1prof_provider_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1firstname_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1firstname_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1lastname_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1lastname_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1image_path_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1image_path_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1street_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1street_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1house_nr_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1house_nr_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1zip_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1zip_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1location_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1location_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1locationarea_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1locationarea_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1tel_p_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1tel_p_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1tel_m_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1tel_m_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1email_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1email_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1username_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1username_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1password_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1password_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1picture_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1picture_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1picture_2_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1picture_2_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1gender_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1gender_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1adminstatus_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1adminstatus_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1birthdate_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1birthdate_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1enabled_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1enabled_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1temp_sched_from_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1temp_sched_from_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1temp_sched_to_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1temp_sched_to_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1joiningdate_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1joiningdate_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1coord_accuracy_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1coord_accuracy_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1monday_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1monday_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1tuesday_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1tuesday_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1wednesday_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1wednesday_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1thursday_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1thursday_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1friday_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1friday_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1saturday_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1saturday_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1sunday_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1sunday_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1monday_t_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1monday_t_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1tuesday_t_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1tuesday_t_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1wednesday_t_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1wednesday_t_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1thursday_t_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1thursday_t_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1friday_t_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1friday_t_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1saturday_t_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1saturday_t_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1sunday_t_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1sunday_t_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1preferred_contact_by_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1preferred_contact_by_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1date_last_adress_change_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1date_last_adress_change_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1map_in_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1map_in_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1IconPath_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1IconPath_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1Icon_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1Icon_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1note_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1note_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1price_per_hour_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1price_per_hour_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1psych_time_loose_tight_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1psych_time_loose_tight_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1psych_exact_creativ_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1psych_exact_creativ_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1psych_heart_thing_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1psych_heart_thing_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1psych_easy_security_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1psych_easy_security_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1psych_conflict_take_leave_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1psych_conflict_take_leave_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1longitude_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1longitude_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1latitude_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1latitude_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1Agree_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1Agree_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1Sign_date_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1Sign_date_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1Active_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1Active_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1Acode_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1Acode_value']; ?>

</td>


</tr>
<!--<?php endforeach; endif; unset($_from); ?>-->
	


</table>
</form> 


</td>
</tr>	

<?php if ($this->_tpl_vars['maxpages'] > 1): ?>
<tr>
<td height=30px colspan=2 align="center"><?php echo $this->_tpl_vars['pagination']; ?>
</td>
</tr>
<?php endif; ?> 
<?php endif; ?> <!-- display_grid -->
<?php if ($this->_tpl_vars['message'] != ""): ?>
<tr name=notfound_message>
<td height=30px colspan=2 align="center">
<b><?php echo $this->_tpl_vars['message']; ?>
</b>
</td>
</tr>
<?php endif; ?> 

</table>

</td></tr></table>
</td></tr></table>
</td></tr></table>
<?php echo smarty_function_doevent(array('name' => 'ListOnLoad'), $this);?>


<?php echo smarty_function_include_if_exists(array('file' => "include/footer.php"), $this);?>

<?php echo $this->_tpl_vars['linkdata']; ?>

</body>
</html>
