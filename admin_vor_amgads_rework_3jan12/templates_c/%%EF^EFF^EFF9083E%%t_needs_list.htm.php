<?php /* Smarty version 2.6.13, created on 2011-07-20 04:47:19
         compiled from t_needs_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', 't_needs_list.htm', 9, false),array('function', 'doevent', 't_needs_list.htm', 562, false),)), $this); ?>
<html>
<head>
<title>t_needs</title>
<link REL="stylesheet" href="include/style.css" type="text/css">
</head>
<body topmargin=5 bgcolor=white <?php echo $this->_tpl_vars['onload']; ?>
>
<?php echo $this->_tpl_vars['includes']; ?>


<?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>


<form name="frmSearch" method="GET" action="t_needs_list.php">
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
<a href="t_needs_search.php">Advanced search</a>	


<?php if ($this->_tpl_vars['rowsfound']): ?>


&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
<a target="_blank" href="t_needs_export.php">Export results</a>



&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
<a target="_blank" href="t_needs_print.php">Printer-friendly version</a>
&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
<a target="_blank" href="t_needs_print.php?all=1">Print all pages</a>


<?php endif; ?>


&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
<a href="t_needs_import.php">Import</a>




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
	<td class=td_border_menu2>
	<a class=menu_db href="t_people_list.php">t_people</a></td>
	<td class=body2 colspan=2>
	<img src="include/img/menu_blue_unselect.gif" border=0></td>


		<td width=1px class=border_menu_left></td>
	<td class=td_border_menu2>
	<a class=menu_db href="t_skills_list.php">t_skills</a></td>
	<td class=body2 colspan=2>
	<img src="include/img/menu_blue_unselect.gif" border=0></td>


		<td width=1px class=border_menu_left></td>
	<td class=td_border_menu>
	<a class=menu_db href="t_needs_list.php">t_needs</a></td>
	<td class=body2 colspan=2>
	<img src="include/img/menu_blue_select.gif" border=0></td>


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
<option value="need_id" <?php echo $this->_tpl_vars['search_need_id']; ?>
>need_id</option>
<option value="people_id" <?php echo $this->_tpl_vars['search_people_id']; ?>
>people_id</option>
<option value="need_type_id" <?php echo $this->_tpl_vars['search_need_type_id']; ?>
>need_type_id</option>
<option value="need_subtype_id" <?php echo $this->_tpl_vars['search_need_subtype_id']; ?>
>need_subtype_id</option>
<option value="need_note" <?php echo $this->_tpl_vars['search_need_note']; ?>
>need_note</option>
<option value="need_hourly" <?php echo $this->_tpl_vars['search_need_hourly']; ?>
>need_hourly</option>
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
onChange="javascript: document.location='t_needs_list.php?pagesize='+this.options[this.selectedIndex].value;">
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


	 


<span class=buttonborder><input class=button type=button value="Export selected" onclick="var c=0; if(frmAdmin.elements['selection[]'].length==undefined && frmAdmin.elements['selection[]'].checked) c=1; else for (i=0;i<frmAdmin.elements['selection[]'].length;++i) if (frmAdmin.elements['selection[]'][i].checked) c=1;  if(c==0) return true; frmAdmin.action='t_needs_export.php';frmAdmin.target='_blank';frmAdmin.submit(); frmAdmin.action='t_needs_list.php'; frmAdmin.target='_self';"></span>



<span class=buttonborder><input class=button type=button value="Print selected" onclick="var c=0; if(frmAdmin.elements['selection[]'].length==undefined && frmAdmin.elements['selection[]'].checked) c=1; else for (i=0;i<frmAdmin.elements['selection[]'].length;++i) if (frmAdmin.elements['selection[]'][i].checked) c=1;  if(c==0) return true; frmAdmin.action='t_needs_print.php';frmAdmin.target='_blank';frmAdmin.submit(); frmAdmin.action='t_needs_list.php'; frmAdmin.target='_self';"></span>

</span>
<?php endif; ?>
</span>
</td></tr>

<?php if ($this->_tpl_vars['display_grid']): ?>

<tr><td class=body2 colspan=2><div id="usermessage" class="message"></div></td></tr>
<tr><td colspan=2>

<!-- delete form -->
<form method="POST" action="t_needs_list.php" name="frmAdmin">
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
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_need_id']; ?>
need%5Fid">
need_id</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_need_id']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_people_id']; ?>
people%5Fid">
people_id</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_people_id']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_need_type_id']; ?>
need%5Ftype%5Fid">
need_type_id</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_need_type_id']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_need_subtype_id']; ?>
need%5Fsubtype%5Fid">
need_subtype_id</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_need_subtype_id']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_need_note']; ?>
need%5Fnote">
need_note</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_need_note']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_need_hourly']; ?>
need%5Fhourly">
need_hourly</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_need_hourly']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_prof_provider']; ?>
prof%5Fprovider">
prof_provider</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_prof_provider']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_firstname']; ?>
firstname">
firstname</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_firstname']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_lastname']; ?>
lastname">
lastname</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_lastname']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_image_path']; ?>
image%5Fpath">
image_path</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_image_path']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_street']; ?>
street">
street</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_street']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_house_nr']; ?>
house%5Fnr">
house_nr</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_house_nr']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_zip']; ?>
zip">
zip</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_zip']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_location']; ?>
location">
location</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_location']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_locationarea']; ?>
locationarea">
locationarea</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_locationarea']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_tel_p']; ?>
tel%5Fp">
tel_p</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_tel_p']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_tel_m']; ?>
tel%5Fm">
tel_m</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_tel_m']; ?>
</td>
</table>
</td>
<td class="headerlist_right"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="t_needs_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_email']; ?>
email">
email</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_email']; ?>
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
<a class="tablelinks" href="t_needs_view.php?<?php echo $this->_tpl_vars['row']['1editlink']; ?>
" >
View</a>
</td>


<td align="center" valign=middle class=borderbody>

<input type=checkbox name="selection[]" value="<?php echo $this->_tpl_vars['row']['1keyblock']; ?>
" id="check<?php echo $this->_tpl_vars['row']['1recno']; ?>
">

</td>





<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1need_id_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1need_id_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1people_id_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1people_id_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1need_type_id_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1need_type_id_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1need_subtype_id_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1need_subtype_id_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1need_note_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1need_note_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1need_hourly_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1need_hourly_value']; ?>

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
