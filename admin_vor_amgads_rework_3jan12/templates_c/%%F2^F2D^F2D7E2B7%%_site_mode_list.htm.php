<?php /* Smarty version 2.6.13, created on 2011-07-20 06:11:00
         compiled from _site_mode_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', '_site_mode_list.htm', 9, false),array('function', 'doevent', '_site_mode_list.htm', 471, false),)), $this); ?>
<html>
<head>
<title>site_mode</title>
<link REL="stylesheet" href="include/style.css" type="text/css">
</head>
<body topmargin=5 bgcolor=white <?php echo $this->_tpl_vars['onload']; ?>
>
<?php echo $this->_tpl_vars['includes']; ?>


<?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>


<form name="frmSearch" method="GET" action="_site_mode_list.php">
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
<a href="_site_mode_search.php">Advanced search</a>	


<?php if ($this->_tpl_vars['rowsfound']): ?>


&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
<a target="_blank" href="_site_mode_export.php">Export results</a>



&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
<a target="_blank" href="_site_mode_print.php">Printer-friendly version</a>
&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
<a target="_blank" href="_site_mode_print.php?all=1">Print all pages</a>


<?php endif; ?>


&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
<a href="_site_mode_import.php">Import</a>




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
	<td class=td_border_menu>
	<a class=menu_db href="_site_mode_list.php">site_mode</a></td>
	<td class=body2 colspan=2>
	<img src="include/img/menu_blue_select.gif" border=0></td>


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
<option value="Status" <?php echo $this->_tpl_vars['search_Status']; ?>
>Status</option>
<option value="Message" <?php echo $this->_tpl_vars['search_Message']; ?>
>Message</option>
<option value="Mode" <?php echo $this->_tpl_vars['search_Mode']; ?>
>Mode</option>
<option value="ID" <?php echo $this->_tpl_vars['search_ID']; ?>
>ID</option>
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
onChange="javascript: document.location='_site_mode_list.php?pagesize='+this.options[this.selectedIndex].value;">
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
	   
 

<span id="inline_add" class=buttonborder><input class=button type=button value="Inline Add" onclick="return inlineAdd(newrecord_id++);"></span>



<span name="record_controls">




<span name="edit_selected" class=buttonborder><input name="edit_selected" class=button type=button value="Edit selected" onclick=""javascript:void(0);""></span>

<span name="saveall_edited" style="display:none;" class=buttonborder><input class=button name="saveall_edited" type=button value="Save all" onclick=""javascript:void(0);""></span>
<span name="revertall_edited" style="display:none;" class=buttonborder><input class=button name="revertall_edited" type=button value="Cancel" onclick=""javascript:void(0);""></span>

	 


<span class=buttonborder><input class=button type=button value="Export selected" onclick="var c=0; if(frmAdmin.elements['selection[]'].length==undefined && frmAdmin.elements['selection[]'].checked) c=1; else for (i=0;i<frmAdmin.elements['selection[]'].length;++i) if (frmAdmin.elements['selection[]'][i].checked) c=1;  if(c==0) return true; frmAdmin.action='_site_mode_export.php';frmAdmin.target='_blank';frmAdmin.submit(); frmAdmin.action='_site_mode_list.php'; frmAdmin.target='_self';"></span>



<span class=buttonborder><input class=button type=button value="Print selected" onclick="var c=0; if(frmAdmin.elements['selection[]'].length==undefined && frmAdmin.elements['selection[]'].checked) c=1; else for (i=0;i<frmAdmin.elements['selection[]'].length;++i) if (frmAdmin.elements['selection[]'][i].checked) c=1;  if(c==0) return true; frmAdmin.action='_site_mode_print.php';frmAdmin.target='_blank';frmAdmin.submit(); frmAdmin.action='_site_mode_list.php'; frmAdmin.target='_self';"></span>

</span>
</span>
</td></tr>


<tr><td class=body2 colspan=2><div id="usermessage" class="message"></div></td></tr>
<tr><td colspan=2>

<!-- delete form -->
<form method="POST" action="_site_mode_list.php" name="frmAdmin">
	<input type=hidden id="a" name="a" value="delete">
<table name="maintable" class="data" align="center" width="100%" border="0" cellpadding=3 cellspacing=0>
<!-- table header -->
<tr class="blackshade" valign="top">

<?php if ($this->_tpl_vars['column1show']): ?>


<td width=100 align="center" class="headerlist"><img src="images/icon_edit.gif"></td>



<td width=50 align="center" class="headerlist"><img src="images/icon_edit.gif"></td>



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
href="_site_mode_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_Status']; ?>
Status">
Status</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_Status']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="_site_mode_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_Message']; ?>
Message">
Message</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_Message']; ?>
</td>
</table>
</td>
<td class="headerlist"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="_site_mode_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_Mode']; ?>
Mode">
Mode</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_Mode']; ?>
</td>
</table>
</td>
<td class="headerlist_right"><table cellpadding=0 cellspacing=0 border=0 align=center><tr><td>
<a class="tablelinks" 
href="_site_mode_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_ID']; ?>
ID">
ID</a>
</td>
<td><?php echo $this->_tpl_vars['order_image_ID']; ?>
</td>
</table>
</td>
<?php endif; ?>
</tr>


<!-- inline add area -->
<tr class="addarea"> 


<?php if ($this->_tpl_vars['column1show']): ?>


<td align="center" valign=middle class=borderbody>
<a class="tablelinks" href="_site_mode_edit.php?" id="editlink_add" >
Edit</a>
</td>



<td align="center" valign=middle class=borderbody>
<a class="tablelinks" href="_site_mode_edit.php?" id="ieditlink_add">
Inline Edit</a>
</td>



<td align="center" valign=middle class=borderbody>
<a class="tablelinks" href="_site_mode_view.php?" id="viewlink_add">
View</a>
</td>


<td align="center" valign=middle class=borderbody>
<input type=checkbox name="selection[]" value="" id="check_add">
</td>



<td valign=middle class=borderbody>
<span id="add_Status"></span>&nbsp;
</td>
<td valign=middle class=borderbody>
<span id="add_Message"></span>&nbsp;
</td>
<td valign=middle class=borderbody>
<span id="add_Mode"></span>&nbsp;
</td>
<td valign=middle class=borderbody>
<span id="add_ID"></span>&nbsp;
</td>
<?php endif; ?>
</tr>
<!-- end inline add area -->
<?php if ($this->_tpl_vars['display_records']): ?>

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

<a class="tablelinks" href="_site_mode_edit.php?<?php echo $this->_tpl_vars['row']['1editlink']; ?>
"  id="editlink<?php echo $this->_tpl_vars['row']['1recno']; ?>
" >
Edit</a>

</td>



<td align="center" valign=middle class=borderbody>

<a class=tablelinks href="_site_mode_edit.php?<?php echo $this->_tpl_vars['row']['1editlink']; ?>
" onclick="return inlineEdit('<?php echo $this->_tpl_vars['row']['1recno']; ?>
','<?php echo $this->_tpl_vars['row']['1editlink']; ?>
');" id="ieditlink<?php echo $this->_tpl_vars['row']['1recno']; ?>
">Inline Edit</a>

</td>



<td align="center" valign=middle class=borderbody>
<a class="tablelinks" href="_site_mode_view.php?<?php echo $this->_tpl_vars['row']['1editlink']; ?>
"  id="viewlink<?php echo $this->_tpl_vars['row']['1recno']; ?>
" >
View</a>
</td>


<td align="center" valign=middle class=borderbody>

<input type=checkbox name="selection[]" value="<?php echo $this->_tpl_vars['row']['1keyblock']; ?>
" id="check<?php echo $this->_tpl_vars['row']['1recno']; ?>
">

</td>





<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1Status_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1Status_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1Message_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1Message_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1Mode_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1Mode_value']; ?>

</td>
<td align=center valign=middle class=borderbody <?php echo $this->_tpl_vars['row']['1ID_style']; ?>
>
<?php echo $this->_tpl_vars['row']['1ID_value']; ?>

</td>


</tr>
<!--<?php endforeach; endif; unset($_from); ?>-->
	

<?php endif; ?> <!-- display_records -->

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
