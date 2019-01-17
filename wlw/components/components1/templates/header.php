<div id="header1" style="height:50px;">
	
    <img src="images/header-logo.png" style="padding-top:80px;padding-left:10px;"/>
    
    <div id="logged-user" style="padding-bottom:5px;">
    <div style="float:right;font-weight:bold;font-color:#FFFD5F;color:#FFFD5F;font-size:19px;margin-bottom:10px;">Admin Panel</div><br style="clear:both;">
    Welcome! You are logged in as <strong><?php echo $_SESSION[WEBSITE_ALIAS]['admin_name']?></strong>.
    
    
    &nbsp;&nbsp;|&nbsp;&nbsp;<!--<a href="<?php echo INDEX_PAGE; ?>my-account" style="color:#FFFD5F;font-weight:bold;">My Account</a>&nbsp;&nbsp;|&nbsp;&nbsp;--><a href="<?php echo INDEX_PAGE; ?>logout"  style="color:#FFFD5F;font-weight:bold;">Logout</a> </div>
    
    
    </div>
    
    
    <div id="navigation">
    
    
    <ul class="sf-menu">
    
    <li class="current"><a href="<?php echo INDEX_PAGE; ?>home">Home</a></li>
    <li><a href="<?php echo INDEX_PAGE; ?>events">Events Management</a></li>
    
    <li><a href="<?php echo INDEX_PAGE; ?>locations">Locations Management</a></li>
    <li><a href="<?php echo INDEX_PAGE; ?>leaders">Leaders Management</a></li>
       
    </ul>
    
    
    </div>
    
    
    <div id="content" style="border:0px solid #eeeeee;padding-bottom:20px;">