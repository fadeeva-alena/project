<?php /* Smarty version 2.6.13, created on 2011-07-20 04:46:20
         compiled from menu.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', 'menu.htm', 6, false),)), $this); ?>
<html>
<head>
<link REL="stylesheet" href="include/style.css" type="text/css">
</head>
<body>
<?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>

<br>
<table cellpadding=5 cellspacing=0 border=0 width=400 align=center>
<tr><td align=center class=upeditmenu>&nbsp;
Logged as <b><?php echo $this->_tpl_vars['username']; ?>
</b> &nbsp;&nbsp;
<a href="login.php?a=logout" class=tablelinks>Log out</a>
</td>
</tr>

<tr><td class=shade style="padding-left:15px">
<a href="_site_mode_list.php" class=tablelinks>
site_mode</a>
</td></tr>


<tr><td class=shade style="padding-left:15px">
<a href="t_log_list.php" class=tablelinks>
t_log</a>
</td></tr>


<tr><td class=shade style="padding-left:15px">
<a href="_t_search_list.php" class=tablelinks>
t_search</a>
</td></tr>


<tr><td class=shade style="padding-left:15px">
<a href="t_people_list.php" class=tablelinks>
t_people</a>
</td></tr>


<tr><td class=shade style="padding-left:15px">
<a href="t_skills_list.php" class=tablelinks>
t_skills</a>
</td></tr>


<tr><td class=shade style="padding-left:15px">
<a href="t_needs_list.php" class=tablelinks>
t_needs</a>
</td></tr>


<tr><td class=shade style="padding-left:15px">
<a href="_taccess_list.php" class=tablelinks>
taccess</a>
</td></tr>

</table>
<?php echo smarty_function_include_if_exists(array('file' => "include/footer.php"), $this);?>

</body>
</html>