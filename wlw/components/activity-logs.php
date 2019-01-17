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
			$sqlfield = mysql_query("select * from t_field_names where id=314");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$datefrom = $rowfield['fieldname_de'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$datefrom =$rowfield['fieldname_eng'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$datefrom =$rowfield['fieldname_fr'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$datefrom =$rowfield['fieldname_it'];
			}
			$sqlfield = mysql_query("select * from t_field_names where id=315");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$dateto = $rowfield['fieldname_de'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$dateto =$rowfield['fieldname_eng'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$dateto =$rowfield['fieldname_fr'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$dateto =$rowfield['fieldname_it'];
			}
			
			$sqlfield = mysql_query("select * from t_field_names where id=316");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$show = $rowfield['fieldname_de'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$show =$rowfield['fieldname_eng'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$datefrom =$rowfield['fieldname_fr'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$show =$rowfield['fieldname_it'];
			}
			?>
			<p>
			<b><?php echo $datefrom;?></b>: 
				&nbsp;&nbsp;<input type="text"  style="width:120px;" name="startdate" readonly="readonly" id="startdate"> 
				<label for="startdate"></label> &nbsp;&nbsp;
				<b><?php echo $dateto;?></b>:</b>&nbsp;&nbsp;<input type="text"  style="width:120px;" name="enddate" readonly="readonly" id="enddate">
				<label for="enddate">
				<input class="button-search" type="button" value="<?php echo $show;?>" id="btn_show" name="btn_show" style="width:55px;">
			</p>
	
		
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
		
		$sqlfield = mysql_query("select * from t_field_names where id=306");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$provider = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$provider =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$provider =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$provider =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=307");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$login = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$login =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$login =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$login =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=308");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$logout = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$logout =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$logout =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$logout =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=309");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$sessionid = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$sessionid =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$sessionid =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$sessionid =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=310");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$session_timestamp = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$session_timestamp =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$session_timestamp =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$session_timestamp =$rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=311");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$ipaddress = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$ipaddress =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$ipaddress =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$ipaddress =$rowfield['fieldname_it'];
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
		
		
		$options_col = array($provider, $login, $logout,$sessionid,$session_timestamp,$ipaddress);
		$values_col = array('lastname', 'log_in', 'log_out','session_id','session_time','ip_location');
		echo "<strong>".$column.":</strong> &nbsp;" . $scaffold->dropdown_arr($options_col, $values_col,"column","",$any,"onchange='changeoptions(1)'") . "&nbsp;&nbsp;&nbsp;";
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
		?>:</strong>&nbsp;&nbsp;<input type="text" name="search_keyword" id="search_keyword">
		<input class="button-search" type="button" value="<?php echo $search;?>" id="btn_customsearch">
  	    <input class="button-search" type="button" name="btn_reset" id="btn_reset" value="<?php echo $clear;?>" />
        </p>        
  </form>
</div>
     <div class="clr"></div>
     
     <?php echo $helper->init_grid($grid_id)?>
     
	 <?php
	$sqlfield = mysql_query("select * from t_field_names where id=40");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$loc_name =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$loc_name =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$loc_name =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$loc_name =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=41");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$loc_detail =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$loc_detail =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$loc_detail =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$loc_detail =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=42");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$address1 =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$address1 =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$address1 =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$address1 =  $rowfield['fieldname_it'];}
	
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
	 
     <script type="text/javascript">
     $("#<?php echo $grid_id?>").flexigrid
     ({
     url: '<?php echo PATH_COMPONENTS.$page_name?>-list.php?optionlist=<?php echo $_SESSION['optionlist'];?>',
     dataType: 'json',
     colModel : 
     [			
     {display: '<?php echo $action?>', width : <?php echo $config['grid']['3action'];?>, align: 'center'},
     {display: '<?php echo $provider;?>', name : 'lastname', width : 200, sortable : true, align: 'left'},
     {display: '<?php echo $login;?>', name : 'log_in', width : 110, sortable : true, align: 'left'},
     {display: '<?php echo $logout;?>', name : 'log_out', width : 110, sortable : true, align: 'left'},
     {display: '<?php echo $sessionid;?>', name : 'session_id', width : 110, sortable : true, align: 'center'},
	 {display: '<?php echo $session_timestamp;?>', name : 'session_time', width : 110, sortable : true, align: 'center'},
	 {display: '<?php echo $ipaddress;?>', name : 'ip_location', width :100, sortable : true, align: 'center'}
     ],
     
     sortname: "<?php echo $fg_activitylogs['sortname']?>",
     sortorder: "<?php echo $fg_activitylogs['sortorder']?>",
     usepager: true,
     title: '<?php echo $page_heading?>',
     useRp: true,
     rp: <?php echo $fg_activitylogs['rp']?>,
     rpOptions: <?php echo $fg_activitylogs['rpOptions']?>,
     showTableToggleBtn: <?php echo $fg_activitylogs['showTableToggleBtn']?>,
     width: '<?php echo $fg_activitylogs['width']?>',
     height: 'auto',
     resizable: <?php echo $fg_activitylogs['resizable']?>,
     onSubmit: addFormData,
     onRowSelected: RowSelected,
     multiSelect: true
     });
     
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
	 
	 
     
     <?php require(PATH_INCLUDES.'customsearch.js.php'); ?>			
     //->calendar function
	$(document).ready(function() {
	 	$("#startdate").datepicker({
			changeMonth: true,
			dateFormat: 'yy-mm-dd',
			changeYear: true
	 	})
	 	$("#enddate").datepicker({
			changeMonth: true,
			dateFormat: 'yy-mm-dd',
			changeYear: true
		})
		
		$('#btn_show').click(function ()	{
			$('#system-message').hide();
			$('#<?php echo $grid_id; ?>').flexOptions({newp: 1}).flexReload();
			return false;
		});	
	});	
     </script>