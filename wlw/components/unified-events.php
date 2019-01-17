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
        <div class="message"><?php echo $helper->operation_msg($_GET['a'], $_GET['success'], "")?></div>
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
											</td>
					<td align="left">
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
		?></a>
			| <a href="index.php?option=events-calendar"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=269");
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
		?></a>
			</p>
		<?php
			}
		?>
    	
        <p>
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

		$delete = str_replace('%date_from%','',$delete);
		$delete = str_replace('%date_to%','',$delete);
		$delete = str_replace('- ','',$delete);
		
		$sqlfield = mysql_query("select * from t_field_names where id=98");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$title = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$title =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$title =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$title =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=99");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$short = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$short =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$short =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$short =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=100");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$start = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$start =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$start =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$start =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=101");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$end = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$end =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$end =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$end =$rowfield['fieldname_it'];
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
		$value_display['display'] = "leadername";
				
		$rs = $db->get_results("SELECT id,concat(lastname, ', ', firstname) as leadername FROM ".DB_TABLE_PREFIX."leader order by lastname asc, firstname asc");		
				
		if ($_GET['providername'] != ""){
			$providername_session = $_GET['providername'];
		}else{
			$providername_session = $_SESSION['events_providernamexxx'];
		}	
		
		$sqlfield = mysql_query("select * from t_field_names where id=82");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$leaderx =  $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$leaderx =  $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$leaderx =  $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$leaderx =  $rowfield['fieldname_it'];
		}
	
		echo "<strong>".$leaderx.":</strong> &nbsp;" .  $scaffold->dropdown_rs($rs,$value_display,"providername",$providername_session) . "&nbsp;&nbsp;&nbsp;";
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
		
		if ($_GET['search_keyword'] != ""){
			$search_keyword = $_GET['search_keyword'];
		}else{
			$search_keyword = $_SESSION['events_searchkeyword'];
		}
		?>:</strong>&nbsp;&nbsp;<input type="text" name="search_keyword" id="search_keyword" value="<?php echo $search_keyword;?>">
		<input class="button-search" type="button" value="<?php echo $search;?>" id="btn_customsearch">
  	    <input class="button-search" type="button" name="btn_reset" id="btn_reset" value="<?php echo $clear;?>" />
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
	
	$sqlfield = mysql_query("select * from t_field_names where id=338");
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
	
	$sqlfield = mysql_query("select * from t_field_names where id=33");
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

$sqlfield = mysql_query("select * from t_field_names where id=606");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$unifiededit =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$unifiededit =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$unifiededit =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$unifiededit =  $rowfield['fieldname_it'];}

	
	$sqlfield = mysql_query("select * from t_field_names where id=374");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$add_similar =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$add_similar =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$add_similar =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$add_similar =  $rowfield['fieldname_it'];}
	
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
<script src="plugins/jquery/fancybox/jquery.fancybox-1.3.1.js" type="text/javascript" language="Javascript"></script>
<link href="plugins/jquery/fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript">
	$("#<?php echo $grid_id?>").flexigrid
	({
		url: '<?php echo PATH_COMPONENTS.$page_name?>-list.php?optionlist=<?php echo $_SESSION['optionlist'];?>&optionlistfilter=<?php echo $_SESSION['optionlistfilter'];?>',
		dataType: 'json',
		colModel : 
			[			
			{display: '<?php echo $action;?>', width : <?php echo $config['grid']['3action'];?>, align: 'center'},
			{display: '<?php echo $title;?>', name : 'title', width : 250, sortable : true, align: 'left'},
			//{display: '<?php echo $short;?>', name : 'short_desc', width : 90, sortable : true, align: 'left'},
			{display: '<?php echo $price;?>', name : 'price', width : 55, sortable : true, align: 'left'},
			{display: '<?php echo $startdate;?>', name : 'date_start', width : 120, sortable : true, align: 'center'},
			//{display: '<?php echo $enddate;?>', name : 'date_end', width : 120, sortable : true, align: 'center'},
			{display: '<?php echo $quality;?>', name : '', width : 60, sortable : false, align: 'center'},
			//{display: '<?php echo $leader;?>', name : '', width : 90, sortable : false, align: 'left'},
			{display: '<?php echo $photoimg;?>', name : '', width :<?php echo $grid_max_x+5;?>, sortable : false, align: 'center'}
			//{display: '<?php echo $loction;?>', name : '', width :120, sortable : false, align: 'left'}
			],
		buttons : 
			[
		<?php
			if ($rowsessionrights['admin'] == 1 or $rowsessionrights['user_w']== 1){?>
			
			{name: '<?php echo $unifiededit;?>', bclass: 'edit', onpress : buttonAction},
			
			
		<?php
			}if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 1){
		?>
			
		<?php
			}
		?>
							
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
		height: 'auto',
		resizable: <?php echo $fg_events['resizable']?>,
		onSubmit: addFormData,
		onRowSelected: RowSelected,
		multiSelect: true,
		onSuccess: setEventpopup
	});
	
	/*function setEventpopup(){
		$("table#<?php echo $grid_id?> tbody td a.modalevents").fancybox({
		'titlePosition'	: 'inside',
		'transitionIn'	: 'none',
		'transitionOut'	: 'none'
		});
	 }*/
	function setEventpopup(){ 
	  $('table#<?php echo $grid_id?> tbody td a.modalevents').facebox({
        loadingImage : 'plugins/jquery/facebox/loading.gif',
        closeImage   : 'plugins/jquery/facebox/closelabel.png'
      })
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
				alert("<?php echo $plsselectdel;?>");
				return false;
			}
		}					
		else if (com=='<?php echo $unifiededit;?>')
		{
			var eventsid = $('input[name=eventsid]:radio:checked').val();
			if (eventsid > 0){
				
				$.ajax 
					({
						type: "POST",
						dataType: "json",
						url: "<?php echo PATH_COMPONENTS?>process-unified-events.php?eventsid="+eventsid,
						data: "eventsid="+eventsid,
						success: function(data) {
							
																								alert(data.result);
															
							$("#<?php echo $grid_id?>").flexReload();
						}
					});
			}
			
		}			
		else if (com=='<?php echo $add;?>')
		{
			location.href = '<?php echo $target_url?>add'
		}
		else if (com=='<?php echo $add_similar;?>')
		{
			location.href = '<?php echo $target_url?>add&type=1'
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
		else if (com=='<?php echo $selectall;?>')
		{
			$('.bDiv tbody tr',grid).addClass('trSelected');
		}				
		else if (com=='<?php echo $deselectall;?>')
		{
			$('.bDiv tbody tr',grid).removeClass('trSelected');
		}				
	}
	
	$('b.top').click(function() {
		$(this).parent().toggleClass('fh');
	});
	
	$('#providername').change(function() {
		$('#system-message').hide();
		$('#<?php echo $grid_id;?>').flexOptions({newp: 1}).flexReload();            
	});
	
	
	<?php require(PATH_INCLUDES.'customsearch.js.php'); ?>			

</script>
