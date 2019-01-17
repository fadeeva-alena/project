<?php /* Smarty version 2.6.13, created on 2011-07-20 13:29:34
         compiled from t_people_view.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', 't_people_view.htm', 6, false),array('function', 'doevent', 't_people_view.htm', 9, false),)), $this); ?>
<html>
<title>t_people</title>
<link REL="stylesheet" href="include/style.css" type="text/css">
<body>
<script type="text/javascript" src="include/jquery.js"></script>
<?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>



<?php echo smarty_function_doevent(array('name' => 'ViewOnLoad'), $this);?>


<!--startPDFcut-->
<table cellpadding=4 cellspacing=0 class="main_table" border=0 align=center>
<tr><td class=upeditmenu width=100% valign=middle align=center height=35 colspan=2>
t_people, View record [
people_id: <?php echo $this->_tpl_vars['show_key1']; ?>

]
</td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>people_id</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_people_id']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>institution</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_institution']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>prof_provider</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_prof_provider']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>firstname</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_firstname']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>lastname</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_lastname']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>image_path</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_image_path']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>street</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_street']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>house_nr</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_house_nr']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>zip</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_zip']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>location</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_location']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>locationarea</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_locationarea']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>tel_p</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_tel_p']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>tel_m</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_tel_m']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>email</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_email']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>username</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_username']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>password</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_password']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>picture</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_picture']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>picture_2</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_picture_2']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>gender</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_gender']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>adminstatus</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_adminstatus']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>birthdate</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_birthdate']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>enabled</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_enabled']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>temp_sched_from</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_temp_sched_from']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>temp_sched_to</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_temp_sched_to']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>joiningdate</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_joiningdate']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>coord_accuracy</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_coord_accuracy']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>monday</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_monday']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>tuesday</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_tuesday']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>wednesday</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_wednesday']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>thursday</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_thursday']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>friday</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_friday']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>saturday</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_saturday']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>sunday</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_sunday']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>monday_t</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_monday_t']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>tuesday_t</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_tuesday_t']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>wednesday_t</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_wednesday_t']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>thursday_t</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_thursday_t']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>friday_t</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_friday_t']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>saturday_t</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_saturday_t']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>sunday_t</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_sunday_t']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>preferred_contact_by</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_preferred_contact_by']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>date_last_adress_change</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_date_last_adress_change']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>map_in</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_map_in']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>IconPath</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_IconPath']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>Icon</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_Icon']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>note</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_note']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>price_per_hour</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_price_per_hour']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>psych_time_loose_tight</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_psych_time_loose_tight']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>psych_exact_creativ</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_psych_exact_creativ']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>psych_heart_thing</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_psych_heart_thing']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>psych_easy_security</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_psych_easy_security']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>psych_conflict_take_leave</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_psych_conflict_take_leave']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>longitude</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_longitude']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>latitude</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_latitude']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>Agree</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_Agree']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>Sign_date</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_Sign_date']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>Active</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_Active']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>Acode</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_Acode']; ?>
&nbsp;
  </td></tr>

<tr height=40><td colspan=2 align=center valign=middle class=blackshade2>
 <span class=buttonborder><input class=button type=reset value="Back to list" onclick="window.location.href='t_people_list.php?a=return'"></span>
 </td></tr>

</table>
<!--endPDFcut-->

<?php echo smarty_function_include_if_exists(array('file' => "include/footer.php"), $this);?>


</body>
</html>