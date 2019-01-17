<?php
error_reporting(0);
session_start();
     $grid_id = $page_name;
     $target_url = INDEX_PAGE.$page_option.'-m&mode=';
     ?>
     <h1><?php echo $page_heading?></h1>
     <?php if ( isset($_GET['a']) && $_GET['a'] != '' ) { ?>
     <div id="system-message">
     <div class="info">
     <div class="message"><?php echo $helper->operation_msg($_GET['a'], $_GET['success'], "Location")?></div>
     </div>
     </div>
     <?php } ?>
     
     <?php require(PATH_TEMPLATES.'delete-msg-box.php'); ?>
     
     <!-- Custom Search - Start -->
     <div id="custom-search-form" class="align-right">
	<form id="frm_customsearch">
    	<?php
			if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 1 or $_SESSION[WEBSITE_ALIAS]['user_level'] == 2){
		?>	
			<p>
			<table align="left">
				<tr>
					<td align="left">
						<a href="<?php echo INDEX_PAGE.$page_option; ?>&optionlist=0&optionlistfilter=0"<?php if ($_SESSION['optionlist'] == 0 and $_SESSION['optionlistfilter'] == 0){echo " style=font-weight:bold;";}?>><?php
		$sqlfield = mysql_query("select * from t_field_names where id=91");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
	?> </a>
					</td>
					<td rowspan="2" align="center">
						<span style="font-size:20px;size:30px;color:#eeeeee;">|</span>
					</td>
					<td align="left">
						<a href="<?php echo INDEX_PAGE.$page_option; ?>&optionlist=1&optionlistfilter=0"<?php if ($_SESSION['optionlist'] == 1 and $_SESSION['optionlistfilter'] == 0){echo " style=font-weight:bold;";}?>><?php
		$sqlfield = mysql_query("select * from t_field_names where id=93");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
	?> </a>
					</td>
					
				</tr>
				
				
			</table>
			</p>
		<?php
			}else{
		?>
			<p><a href="<?php echo INDEX_PAGE.$page_option; ?>"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=270");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
		?></a></p>
		<?php
			}
		?>
		<?php
	$sqlfield = mysql_query("select * from t_field_names where id=334");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$name =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$name =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$name =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$name =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=335");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$address =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$address =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$address =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$address =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=336");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$contact =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$contact =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$contact =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$contact =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=43");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$address2 =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$address2 =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$address2 =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$address2 =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=44");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$loc_country =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$loc_country =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$loc_country =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$loc_country =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=33");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$photoimg =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$photoimg =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$photoimg =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$photoimg =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=108");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$action =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$action =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$action =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$action =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=105");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$add =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$add =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$add =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$add =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=106");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$selectall =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$selectall =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$selectall =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$selectall =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=107");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$deselectall =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$deselectall =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$deselectall =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$deselectall =  $rowfield['fieldname_it'];}
?>
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=96");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$column = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$column =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$column =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$column =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=97");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$any = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$any =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$any =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$any =$rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=130");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$location_name = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$location_name =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$location_name =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$location_name =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=131");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$location_detail = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$location_detail =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$location_detail =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$location_detail =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=132");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$location_address1 = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$location_address1 =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$location_address1 =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$location_address1 =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=133");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$location_address2 = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$location_address2 =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$location_address2 =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$location_address1 =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=264");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$location_country = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$location_country =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$location_country =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$location_country =$rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=103");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$search = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$search =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$search =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$search =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=104");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$clear = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$clear =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$clear =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$clear =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=273");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$delete = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$delete =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$delete =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$delete =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=274");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$plsselectdel = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$plsselectdel =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$plsselectdel =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$plsselectdel =$rowfield['fieldname_it'];
		}
	?>
		
        <p>
		<?php
		/*
		$options_col = array($title);
		$values_col = array('title');
		echo "<strong>".$providerl.":</strong> &nbsp;" . $scaffold->dropdown_arr($options_col, $values_col,"column","",$any,"onchange='changeoptions(1)'") . "&nbsp;&nbsp;&nbsp;";
		*/

		$sqlfield = mysql_query("select * from t_field_names where id=29");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$providerl = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$providerl =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$providerl =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$providerl =$rowfield['fieldname_it'];
		}
		$value_display['value'] = "id";
		$value_display['display'] = "nick";
				
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."provider order by nick");		
				
		echo "<strong>".$providerl.":</strong> &nbsp;" .  $scaffold->dropdown_rs($rs,$value_display,"providername",$_GET['providername']) . "&nbsp;&nbsp;&nbsp;";
		?>          
   		<strong><?php
		$sqlfield = mysql_query("select * from t_field_names where id=102");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
		?>:</strong>&nbsp;&nbsp;<input type="text" name="search_keyword" id="search_keyword" value="<?php echo $_GET['search_keyword'];?>">
		<input class="button-search" type="button" value="<?php echo $search;?>" id="btn_customsearch">
  	    <input class="button-search" type="button" name="btn_reset" id="btn_reset" value="<?php echo $clear;?>" />
        </p>        
  </form>
</div>
     <div class="clr"></div>
     
     <?php echo $helper->init_grid($grid_id)?>
     
	 <script src="plugins/jquery/fancybox/jquery.fancybox-1.3.1.js" type="text/javascript" language="Javascript"></script>
	 <link href="plugins/jquery/fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" /> 
	 
     <script type="text/javascript">
     $("#<?php echo $grid_id?>").flexigrid
     ({
     url: '<?php echo PATH_COMPONENTS.$page_name?>-list.php?optionlist=<?php echo $_SESSION['optionlist'];?>',
     dataType: 'json',
     colModel : 
     [			
     {display: '<?php echo $action?>', width : <?php echo "80";?>, align: 'center'},
     {display: '<?php echo $name;?>', name : '', width : 250, sortable : true, align: 'left'},
     //{display: '<?php echo $loc_detail;?>', name : 'loc_detail', width : 120, sortable : true, align: 'left'},
     {display: '<?php echo $address;?>', name : '', width : 150, sortable : true, align: 'left'},
    // {display: '<?php echo $address2;?>', name : 'loc_adress2', width : 93, sortable : true, align: 'center'},
	 {display: '<?php echo $contact;?>', name : '', width : 230, sortable : true, align: 'left'},
	 {display: '<?php echo $photoimg;?>', name : '', width :<?php echo $grid_max_x+5;?>, sortable : false, align: 'center'}
     ],
     buttons : 
     [
     <?php
			if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 1 or $_SESSION[WEBSITE_ALIAS]['user_level'] == 2){
		?>	
			{name: '<?php echo $add?>', bclass: 'add', onpress : buttonAction},
			
			
		<?php
			}if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 1){
		?>
			{name: '<?php echo $delete;?>', bclass: 'delete', onpress : buttonAction},
		<?php
			}
		?>
     {separator: true},
     {name: '<?php echo $selectall?>', bclass: 'selectall', onpress : buttonAction},
     {name: '<?php echo $deselectall?>', bclass: 'deselectall', onpress : buttonAction},				
     {separator: true}
     ],
     sortname: "<?php echo $fg_locations['sortname']?>",
     sortorder: "<?php echo $fg_locations['sortorder']?>",
     usepager: true,
     title: '<?php echo $page_heading?>',
     useRp: true,
     rp: <?php echo $fg_locations['rp']?>,
     rpOptions: <?php echo $fg_locations['rpOptions']?>,
     showTableToggleBtn: <?php echo $fg_locations['showTableToggleBtn']?>,
     width: '<?php echo $fg_locations['width']?>',
     height: 'auto',
     resizable: <?php echo $fg_locations['resizable']?>,
     onSubmit: addFormData,
     onRowSelected: RowSelected,
     multiSelect: true,
	 onSuccess: setEventpopup
     });
	 
	 function setEventpopup(){
		$("table#<?php echo $grid_id?> tbody td a.modalevents").fancybox({
		'titlePosition'	: 'inside',
		'transitionIn'	: 'none',
		'transitionOut'	: 'none'
		});
	 }
     
     function RowSelected(id, row, grid)
     {
     //alert("row id is " + id);
     }
     
     function buttonAction(com,grid)
     {
     if (com=='<?php echo $delete;?>')
     {
     if($('.trSelected',grid).length>0)
     {
     if(confirm('Delete ' + $('.trSelected',grid).length + ' record(s)?'))
     {
     var items = $('.trSelected',grid);
     var itemlist ='';
     for(i=0;i<items.length;i++) {
     itemlist+= items[i].id.substr(3)+",";
     }
     
     $.ajax 
     ({
     type: "POST",
     dataType: "json",
     url: "<?php echo PATH_COMPONENTS?>delete.php?tn=<?php echo urlencode($crypt->encrypt('location'))?>&fn=<?php echo urlencode($crypt->encrypt('id'))?>",
     data: "items="+itemlist,
     success: function(data) {
     if ( data.total_records > 0 ) {
     $('#system-message').hide();
     $('.system-message').fadeOut(1000);
     $('#del-result').html(data.result);							
     $('.system-message').fadeIn(1000).css({ display:"block" });
     }
     $("#<?php echo $grid_id?>").flexReload();
     }
     });
     }
     } else {
     alert("<?php echo $plsselectdel;?>");
     return false;
     }
     }					
     else if (com=='Edit')
     {
     var items = $('.trSelected',grid);
     if (items.length > 0) {
     location.href = '<?php echo $target_url?>edit&id='+items[0].id.substr(3)
     }else{
     alert("<?php echo $messages['fg']['sel_rec_edit']?>");
     }
     }			
     else if (com=='<?php echo $add?>')
     {
     location.href = '<?php echo $target_url?>add'
     }
     else if (com=='View')
     {
     var items = $('.trSelected',grid);
     if (items.length > 0) {
     location.href = '<?php echo $target_url?>view&id='+items[0].id.substr(3)
     }else{
     alert("<?php echo $messages['fg']['sel_rec_view']?>");
     }
     }			
     else if (com=='<?php echo $selectall?>')
     {
     $('.bDiv tbody tr',grid).addClass('trSelected');
     }				
     else if (com=='<?php echo $deselectall?>')
     {
     $('.bDiv tbody tr',grid).removeClass('trSelected');
     }				
     }
     
     $('b.top').click(function() {
     $(this).parent().toggleClass('fh');
     });
	 
	 $('#providername').change(function() {
		$('#system-message').hide();
		$('#<?php echo $grid_id?>').flexOptions({newp: 1}).flexReload();            
	});
     
     <?php require(PATH_INCLUDES.'customsearch.js.php'); ?>			
     
     </script>