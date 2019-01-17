<?php /* Smarty version 2.6.13, created on 2011-07-20 04:58:26
         compiled from t_skills_view.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', 't_skills_view.htm', 6, false),array('function', 'doevent', 't_skills_view.htm', 9, false),)), $this); ?>
<html>
<title>t_skills</title>
<link REL="stylesheet" href="include/style.css" type="text/css">
<body>
<script type="text/javascript" src="include/jquery.js"></script>
<?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>



<?php echo smarty_function_doevent(array('name' => 'ViewOnLoad'), $this);?>


<!--startPDFcut-->
<table cellpadding=4 cellspacing=0 class="main_table" border=0 align=center>
<tr><td class=upeditmenu width=100% valign=middle align=center height=35 colspan=2>
t_skills, View record [
skill_id: <?php echo $this->_tpl_vars['show_key1']; ?>

]
</td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>skill_id</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_skill_id']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>people_id</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_people_id']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>skill_type_id</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_skill_type_id']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>skill_subtype_id</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_skill_subtype_id']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>skill_note</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_skill_note']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>skill_hourly</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_skill_hourly']; ?>
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

<tr height=40><td colspan=2 align=center valign=middle class=blackshade2>
 <span class=buttonborder><input class=button type=reset value="Back to list" onclick="window.location.href='t_skills_list.php?a=return'"></span>
 </td></tr>

</table>
<!--endPDFcut-->

<?php echo smarty_function_include_if_exists(array('file' => "include/footer.php"), $this);?>


</body>
</html>