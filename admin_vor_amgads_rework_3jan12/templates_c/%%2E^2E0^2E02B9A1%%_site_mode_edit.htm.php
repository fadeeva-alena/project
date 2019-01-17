<?php /* Smarty version 2.6.13, created on 2011-07-20 06:11:18
         compiled from _site_mode_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', '_site_mode_edit.htm', 8, false),array('function', 'doevent', '_site_mode_edit.htm', 12, false),array('function', 'build_edit_control', '_site_mode_edit.htm', 26, false),)), $this); ?>
<html>
<head><title>site_mode</title>
<link REL="stylesheet" href="include/style.css" type="text/css">
<?php echo $this->_tpl_vars['includes']; ?>

</head>

<body <?php echo $this->_tpl_vars['bodyonload']; ?>
>
<?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>

<form name="editform" encType="multipart/form-data" method="post" action="_site_mode_edit.php" <?php echo $this->_tpl_vars['onsubmit']; ?>
>


<?php echo smarty_function_doevent(array('name' => 'EditOnLoad'), $this);?>


<table cellpadding=4 class="main_table" align=center cellspacing=0 border=0>
<tr><td class=upeditmenu width=100% valign=middle align=center height=35 colspan=2>
site_mode, Edit record [
ID: <?php echo $this->_tpl_vars['show_key1']; ?>

]
</td></tr>
<input type=hidden name=editid1 value="<?php echo $this->_tpl_vars['key1']; ?>
">

<tr><td colspan=2 align=center class=downedit><?php echo $this->_tpl_vars['message']; ?>
</td></tr>

  <tr><td class=editshade_b width=150 style="padding-left:20px;">Status</td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo smarty_function_build_edit_control(array('field' => 'Status','value' => $this->_tpl_vars['value_Status'],'mode' => 'edit'), $this);?>

    </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;">Message</td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo smarty_function_build_edit_control(array('field' => 'Message','value' => $this->_tpl_vars['value_Message'],'mode' => 'edit'), $this);?>

    </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;">Mode</td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo smarty_function_build_edit_control(array('field' => 'Mode','value' => $this->_tpl_vars['value_Mode'],'mode' => 'edit'), $this);?>

    </td></tr>
<tr><td colspan=2 align=left class=blackshade2 height=30 valign=middle>
   <img src="images/icon_required.gif"> - Required field
   </td></tr>
 <tr height=40><td colspan=2 align=center valign=top class=blackshade2>
 <span class=buttonborder><input class=button type=submit value="Save"  name=submit1></span>
 <span class=buttonborder><input class=button type=reset value="Reset"></span>
 <span class=buttonborder><input class=button type=reset value="Back to list" onclick="window.location.href='_site_mode_list.php?a=return'"></span>
  <input type=hidden name="a" value="edited">
 </td></tr>

</form>
 
   <!-- legend -->

</table>

<?php echo smarty_function_include_if_exists(array('file' => "include/footer.php"), $this);?>


<?php echo $this->_tpl_vars['linkdata']; ?>

<script>SetToFirstControl();</script>
</body>
</html>