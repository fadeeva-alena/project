<?php /* Smarty version 2.6.13, created on 2011-07-20 04:52:03
         compiled from login.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', 'login.htm', 8, false),array('function', 'doevent', 'login.htm', 9, false),)), $this); ?>
<html>
<head>
<title>Login</title>
<link REL="stylesheet" href="include/style.css" type="text/css">
</head>

<body onLoad="javascript:document.forms[0].username.focus();"  text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" link="#0066cc">
<div style="height:25%"><?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>
</div>
<?php echo smarty_function_doevent(array('name' => 'LoginOnLoad'), $this);?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" height="50%">
  <tr>
    <td valign="center" align="middle"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td valign="top" align="right"> 
                  <table width="300" border="0" cellspacing="4" cellpadding="4" align="center">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <form method="POST" action="login.php" id=form1 name=form1>
                  <table width="300" border="0" cellspacing="0" cellpadding="0" align="center" >
                    <tr> 
                      <td align=middle class=upeditmenu height=40 valign=middle>
							 <b><font size=+1>Login</font></b>
				      </td>
                    </tr>
                    <tr> 
                      <td valign="top" class=shade>
                        <table width=100% border=0 align="center" class=shade cellpadding=3 cellspacing=0>
                          <tbody>
								  <tr height=10><td colspan=2>&nbsp;</td></tr>
                          <tr> 
                            <td align=right width="50%" style="padding-left:10px"> 
                              <div align="left">Username:</div>
                            </td>
                            <td width="50%"> 
                              <input name=username <?php echo $this->_tpl_vars['value_username']; ?>
>
                            </td>
                          </tr>
                          <tr> 
                            <td align=right width="50%" style="padding-left:10px"> 
                              <div align="left">Password:</div>
                            </td>
                            <td width="50%"> 
                              <input type=password name=password <?php echo $this->_tpl_vars['value_password']; ?>

							  onkeydown="e=event; if(!e) e = window.event; if (e.keyCode != 13) return; e.cancel = true; document.forms[0].submit();" >
                            </td>
                          </tr>
                          <tr> 
                            <td align=right width="50%" style="padding-left:10px"> 
                              <div align="left">Remember Password:</div>
                            </td>
                            <td width="50%"> 
                              <input type=checkbox name=remember_password value="1" <?php echo $this->_tpl_vars['checked']; ?>
>
                            </td>
                          </tr>
                          <tr height=10><td colspan=2>&nbsp;</td></tr>
                          <tr class=blackshade> 
                            <td colspan=2 align=middle class=blackshade width=100% height=40 valign=middle>
								 <input type=hidden name=btnSubmit value="Login">
								 <span class=buttonborder><input type=submit value="Submit" class=buttonM></span>
                            </td>
                          </tr>

							  <tr class=blackshade> 
                            <td colspan=2 align=middle>
		                            </td>
                          </tr>
						  
                         
								   <tr class=blackshade>
								   <td align=center colspan=2 class=blackshade>
										<font color=red><?php echo $this->_tpl_vars['message']; ?>
</font>&nbsp;
									</td></tr>
									
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </table>
                  </form>
                </td>
              </tr>
            </table>
            
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<?php echo smarty_function_include_if_exists(array('file' => "include/footer.php"), $this);?>


</body>
</html>