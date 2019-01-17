<?php /* Smarty version 2.6.13, created on 2011-07-20 06:11:07
         compiled from _site_mode_view.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', '_site_mode_view.htm', 6, false),array('function', 'doevent', '_site_mode_view.htm', 9, false),)), $this); ?>
<html>
<title>site_mode</title>
<link REL="stylesheet" href="include/style.css" type="text/css">
<body>
<script type="text/javascript" src="include/jquery.js"></script>
<?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>



<?php echo smarty_function_doevent(array('name' => 'ViewOnLoad'), $this);?>


<!--startPDFcut-->
<table cellpadding=4 cellspacing=0 class="main_table" border=0 align=center>
<tr><td class=upeditmenu width=100% valign=middle align=center height=35 colspan=2>
site_mode, View record [
ID: <?php echo $this->_tpl_vars['show_key1']; ?>

]
</td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>Status</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_Status']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>Message</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_Message']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>Mode</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_Mode']; ?>
&nbsp;
  </td></tr>
  <tr><td class=editshade_b width=150 style="padding-left:20px;"><b>ID</b></td>
  <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_ID']; ?>
&nbsp;
  </td></tr>

<tr height=40><td colspan=2 align=center valign=middle class=blackshade2>
 <span class=buttonborder><input class=button type=reset value="Back to list" onclick="window.location.href='_site_mode_list.php?a=return'"></span>
 </td></tr>

</table>
<!--endPDFcut-->

<?php echo smarty_function_include_if_exists(array('file' => "include/footer.php"), $this);?>


</body>
</html>