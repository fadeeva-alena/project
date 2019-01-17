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
        <div class="message"><?php echo $helper->operation_msg($_GET['a'], $_GET['success'], "Event")?></div>
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
			<p><a href="<?php echo INDEX_PAGE.$page_option; ?>&optionlist=0"<?php if ($_SESSION['optionlist'] == 0){echo " style=font-weight:bold;";}?>>All Lists</a> | <a href="<?php echo INDEX_PAGE.$page_option; ?>&optionlist=1"<?php if ($_SESSION['optionlist'] == 1){echo " style=font-weight:bold;";}?>">Own Lists</a> | <a href="index.php?option=events-calendar">Events Calendar</a></p>
		<?php
			}else{
		?>
			<p><a href="<?php echo INDEX_PAGE.$page_option; ?>">Default Listing</a>
			| <a href="index.php?option=events-calendar">Events Calendar</a>
			</p>
		<?php
			}
		?>
    	
        <p>
		
		<?php
		$options_col = array('Title', 'Short Description', 'Start Date','End Date');
		$values_col = array('title','short_desc','date_start','date_end');
		echo "<strong>Column:</strong> &nbsp;" . $scaffold->dropdown_arr($options_col, $values_col,"column","","Any","onchange='changeoptions(1)'") . "&nbsp;&nbsp;&nbsp;";
		?>        
   		<strong>Keyword:</strong>&nbsp;&nbsp;<input type="text" name="search_keyword" id="search_keyword">
		<input class="button-search" type="button" value="Search" id="btn_customsearch">
  	    <input class="button-search" type="button" name="btn_reset" id="btn_reset" value="Clear" />
        </p>        
  </form>
</div>
<div class="clr"></div>

<?php echo $helper->init_grid($grid_id)?>
<?php
	$sqlfield = mysql_query("select * from t_field_names where id=1");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$title =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$title =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$title =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$title =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=5");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$short =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$short =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$short =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$short =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=12");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$startdate =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$startdate =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$startdate =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$startdate =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=13");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$enddate =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$enddate =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$enddate =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$enddate =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=75");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$quality =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$quality =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$quality =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$quality =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=23");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$leader =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$leader =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$leader =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$leader =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=28");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$photoimg =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$photoimg =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$photoimg =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$photoimg =  $rowfield['fieldname_it'];}
	
	$sqlfield = mysql_query("select * from t_field_names where id=8");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$price =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$price =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$price =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$price =  $rowfield['fieldname_it'];}
	$sqlfield = mysql_query("select * from t_field_names where id=7");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$loction =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$loction =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$loction =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$loction =  $rowfield['fieldname_it'];}
?>

<script type="text/javascript">
	$("#<?php echo $grid_id?>").flexigrid
	({
		url: '<?php echo PATH_COMPONENTS.$page_name?>-list.php?optionlist=<?php echo $_SESSION['optionlist'];?>',
		dataType: 'json',
		colModel : 
			[			
			{display: 'Action', width : <?php echo $config['grid']['3action'];?>, align: 'center'},
			{display: '<?php echo $title;?>', name : 'title', width : 190, sortable : true, align: 'left'},
			//{display: '<?php echo $short;?>', name : 'short_desc', width : 90, sortable : true, align: 'left'},
			{display: '<?php echo $price;?>', name : 'price', width : 55, sortable : true, align: 'left'},
			{display: '<?php echo $startdate;?>', name : 'date_start', width : 88, sortable : true, align: 'center'},
			{display: '<?php echo $enddate;?>', name : 'date_end', width : 60, sortable : true, align: 'center'},
			{display: '<?php echo $quality;?>', name : '', width : 60, sortable : false, align: 'center'},
			{display: '<?php echo $leader;?>', name : '', width : 90, sortable : false, align: 'left'},
			{display: '<?php echo $photoimg;?>', name : '', width :<?php echo $grid_max_x+5;?>, sortable : false, align: 'center'},
			{display: '<?php echo $loction;?>', name : '', width :120, sortable : false, align: 'left'}
			],
		buttons : 
			[
		<?php
			if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 1 or $_SESSION[WEBSITE_ALIAS]['user_level'] == 2){
		?>	
			{name: 'Add', bclass: 'add', onpress : buttonAction},
			
			
		<?php
			}if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 1){
		?>
			{name: 'Delete', bclass: 'delete', onpress : buttonAction},
		<?php
			}
		?>
			{separator: true},
			{name: 'Select All', bclass: 'selectall', onpress : buttonAction},
			{name: 'Deselect All', bclass: 'deselectall', onpress : buttonAction},				
			{separator: true}
			],
		sortname: "<?php echo $fg_events['sortname']?>",
		sortorder: "<?php echo $fg_events['sortorder']?>",
		usepager: true,
		title: '<?php echo $page_heading?>',
		useRp: true,
		rp: <?php echo $fg_events['rp']?>,
		rpOptions: <?php echo $fg_events['rpOptions']?>,
		showTableToggleBtn: <?php echo $fg_events['showTableToggleBtn']?>,
		width: '<?php echo $fg_events['width']?>',
		height: <?php echo $fg_events['height']?>,
		resizable: <?php echo $fg_events['resizable']?>,
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
		if (com=='Delete')
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
						url: "<?php echo PATH_COMPONENTS?>delete.php?tn=<?php echo urlencode($crypt->encrypt('event'))?>&fn=<?php echo urlencode($crypt->encrypt('id'))?>",
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
				alert("<?php echo $messages['fg']['sel_rec_delete']?>");
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
		else if (com=='Add')
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
		else if (com=='Select All')
		{
			$('.bDiv tbody tr',grid).addClass('trSelected');
		}				
		else if (com=='Deselect All')
		{
			$('.bDiv tbody tr',grid).removeClass('trSelected');
		}				
	}
	
	$('b.top').click(function() {
		$(this).parent().toggleClass('fh');
	});
	
	<?php require(PATH_INCLUDES.'customsearch.js.php'); ?>			

</script>
