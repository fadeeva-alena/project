<?php
/**
*  Application Define
*/

// Global definitions

//ini_set("error_reporting",		"on");
define( 'PATH_LIBRARIES',	 	'libraries/' );
define( 'PATH_INCLUDES',		'includes/'   );
define( 'PATH_COMPONENTS',		'components/'   );
define( 'PATH_TEMPLATES',		'templates/' );
define( 'PATH_UPLOADS',			'../uploads/' );

define( 'IMAGES',	 			'images/' );
define( 'CSS',					'css/' );
define( 'JS',					'js/' );
define( 'PLUGINS',				'plugins/' );
define( 'ENCRYPT_KEY',			'r3cyc13' );

define( 'WEBSITE_NAME',			'satsunfun.com' );
define( 'WEBSITE_ALIAS',		'tgh' );
define( 'INDEX_PAGE',			'index.php?option=' );

$location = "";
switch ($location) {
	case "LIVE":
		define( 'DB_HOST',				'mysql.satsunfun.com' );
		define( 'DB_USER',				'satsunfun' );
		define( 'DB_PASSWORD',			'satsunfun' );
		define( 'DB_NAME',				'satsunfun' );				
		define( 'WEBSITE_EMAIL',		'' );
		break;

	
	default:
		define( 'DB_HOST',				'localhost' );
		define( 'DB_USER',				'root' );
		define( 'DB_PASSWORD',			'' );
		define( 'DB_NAME',				'satsunfun' );		
}

define( 'DB_TABLE_PREFIX',		'tbl_' );

$page_option = "";

define( 'PWD_MIN_LEN',			6 );
define( 'REQ_FIELD',			'<span class="required">*</span>' );
define( 'CONFIRM_DELETE',		'Are you sure you want to DELETE the selected ' );


$config = array();
$config['website']['copyright'] = "Copyright &copy ".date('Y')." ".WEBSITE_NAME;

$config['room_type']['img_ext'] = array('.jpg', '.jpeg');
$config['room_type']['img_width'] = 260;
$config['room_type']['img_height'] = 195;
$config['room_type']['img_thumb_width'] = 100;
$config['room_type']['img_thumb_height'] = 75;
$config['room_type']['img_thumb_postfix'] = '_s';

// Grid Settings
$config['grid']['1action'] 	= '30';
$config['grid']['2action'] 	= '44';
$config['grid']['3action'] 	= '60';
$config['grid']['4action'] 	= '80';

// Actions
$config['action']['view'] 	= '<img class="ico-action" src="'.IMAGES.'icon-view.png" alt="View" title="View" border="0" />';
$config['action']['add'] 	= '<img class="ico-action" src="'.IMAGES.'icon-add.png" alt="Add" title="Add" border="0" />';
$config['action']['edit']	= '<img class="ico-action" src="'.IMAGES.'icon-edit.png" alt="Edit" title="Edit" border="0" />';
$config['action']['delete']	= '<img class="ico-action" src="'.IMAGES.'icon-delete.png" alt="Delete" title="Delete" border="0" />';

// Messages
$messages = array();
$messages['fg']['sel_rec_delete'] = "Please select record(s) to DELETE!";
$messages['fg']['sel_rec_edit'] = "Please select a record to EDIT!";
$messages['fg']['sel_rec_view'] = "Please select a record to VIEW!";

$messages['validate']['required'] = "";
$messages['validate']['pwd_mismatch'] = "Password mismatch";
$messages['validate']['min_len'] = "Required minimun length: ";
$messages['validate']['unavailable'] = " is already in use";
$messages['validate']['accept'] = "Invalid file format";
$messages['validate']['accept_jpg'] = "Must be in JPG format";
$messages['validate']['accept_video'] = "Must be in FLV format";
$messages['validate']['number'] = "Must be numeric";
$messages['validate']['digits'] = "Must be digits";
$messages['validate']['amount'] = "Invalid Amount";

$messages['system']['exists'] = " already exists!&nbsp;&nbsp;Please choose another.";

$fgrid_rp_options 					= "[5, 10,15,20,25,40]";	
// Administrators
$fg_admins = array();
$fg_admins['sortname'] 				= "lastname";
$fg_admins['sortorder'] 			= "asc";
$fg_admins['rp'] 					= "20";
$fg_admins['rpOptions'] 			= $fgrid_rp_options;
$fg_admins['showTableToggleBtn'] 	= "false";
$fg_admins['width'] 				= "955";
$fg_admins['height'] 				= "500";
$fg_admins['resizable'] 			= "false";
// Categories
$fg_categories = array();
$fg_categories['sortname'] 			= "category_name";
$fg_categories['sortorder'] 			= "asc";
$fg_categories['rp'] 				= "20";
$fg_categories['rpOptions'] 			= $fgrid_rp_options;
$fg_categories['showTableToggleBtn']	= "false";
$fg_categories['width'] 				= "955";
$fg_categories['height'] 			= "536";
$fg_categories['resizable'] 			= "false";

// advertisement events
$fg_events = array();
$fg_events['sortname'] 			= "advertiser asc, event_title";
$fg_events['sortorder'] 			= "asc";
$fg_events['rp'] 				= "20";
$fg_events['rpOptions'] 			= $fgrid_rp_options;
$fg_events['showTableToggleBtn']	= "false";
$fg_events['width'] 				= "955";
$fg_events['height'] 			= "536";
$fg_events['resizable'] 			= "false";

// Banners
$fg_banners = array();
$fg_banners['sortname'] 			= "banner_id";
$fg_banners['sortorder'] 			= "asc";
$fg_banners['rp'] 				= "20";
$fg_banners['rpOptions'] 			= $fgrid_rp_options;
$fg_banners['showTableToggleBtn']	= "false";
$fg_banners['width'] 				= "955";
$fg_banners['height'] 			= "536";
$fg_banners['resizable'] 			= "false";

// members
$fg_members = array();
$fg_members['sortname'] 			= "username";
$fg_members['sortorder'] 			= "asc";
$fg_members['rp'] 				= "20";
$fg_members['rpOptions'] 			= $fgrid_rp_options;
$fg_members['showTableToggleBtn']	= "false";
$fg_members['width'] 				= "955";
$fg_members['height'] 			= "536";
$fg_members['resizable'] 			= "false";

?>