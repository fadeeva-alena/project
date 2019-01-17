<?php	
	switch ($page_option)
	{
		case 'home':
			$page_heading = "Home";
			$page_name = "Home";
			require('home.php');
			break;  
		case 'pages-m':
			$page_heading = "Page";
			$page_name = "pages";
			require('pages-maint.php');
			break; 
		case 'my-account':
			$page_heading = "My Account";
			$page_name = "my-account";
			require('my-account.php');
			break; 
		case 'home':
			$page_heading = "home";
			$page_name = "home";
			require('home.php');
			break; 

		case 'administrators':
			$page_heading = "Administrators";
			$page_name = "administrators";
			require('administrators.php');
			break;  
		case 'administrators-m':
			$page_heading = "Administrators";
			$page_name = "administrators";
			require('administrators-maint.php');
			break;  
			
		case 'categories':
			$page_heading = "Categories";
			$page_name = "categories";
			require('categories.php');
			break;  
		case 'categories-m':
			$page_heading = "Categories";
			$page_name = "categories";
			require('categories-maint.php');
			break;  
		
case 'events-calendar':
			$page_heading = "Events Calendar";
			$page_name = "events";
			require('events-calendar.php');
			break;  		
			
		case 'events':
			$page_heading = "Events Management";
			$page_name = "events";
			require('events.php');
			break;  
		case 'events-m':
			$page_heading = "Event Editor";
			$page_name = "events";
			require('events-maint.php');
			break;  
			
			 case 'leaders':
     $page_heading = "Leaders Management";
     $page_name = "leaders";
     require('leaders.php');
     break;  
     case 'leaders-m':
     $page_heading = "Leader Editor";
     $page_name = "leaders";
     require('leaders-maint.php');
     break;
	 
	 case 'leaders2-m':
     $page_heading = "Leader Editor";
     $page_name = "leaders";
     require('leaders-maint2.php');
     break;
     
     case 'locations':
     $page_heading = "Locations Management";
     $page_name = "locations";
     require('locations.php');
     break;  
     case 'locations-m':
     $page_heading = "Locations Editor";
     $page_name = "locations";
     require('locations-maint.php');
	 break;
	 case 'locations2-m':
     $page_heading = "Locations Editor";
     $page_name = "locations";
     require('locations-maint2.php');
     break;
		case 'pages-m':
			$page_heading = "Section";
			$page_name = "pages";
			require('pages-maint.php');
			break;	
			
		case 'banners':
			$page_heading = "Banners";
			$page_name = "banners";
			require('banners.php');
			break;  
		case 'banners-m':
			$page_heading = "Banners";
			$page_name = "banners";
			require('banners-maint.php');
			break;
			
		case 'members':
			$page_heading = "Member Management";
			$page_name = "members";
			require('members.php');
			break;  
		case 'members-m':
			$page_heading = "Member Management";
			$page_name = "members";
			require('members-maint.php');
			break;
		case 'logout':
			require('logout.php');
			break;  
		//-> end of commong cases

		default:
			require('events.php');
	}
?>