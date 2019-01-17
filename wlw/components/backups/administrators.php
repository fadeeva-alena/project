<?php
$grid_id = $page_name;
$target_url = INDEX_PAGE.$page_option.'-m&mode=';
?>
<h1>Users Management</h1>
<?php if ( isset($_GET['a']) && $_GET['a'] != '' ) { ?>
<div id="system-message">
    <div class="info">
        <div class="message"><?php echo $helper->operation_msg($_GET['a'], $_GET['success'], "User")?></div>
    </div>
</div>
<?php } ?>

<?php require(PATH_TEMPLATES.'delete-msg-box.php'); ?>

<!-- Custom Search - Start -->
<div id="custom-search-form" class="align-right">
	<form id="frm_customsearch">
    	<p><a href="<?php echo INDEX_PAGE.$page_option; ?>">Default Listing</a></p>
        <p>
		<?php
		$options_col = array('Last Name', 'First Name', 'Username');
		$values_col = array('lastname', 'firstname', 'username');
		echo "<strong>Column:</strong> &nbsp;" . $scaffold->dropdown_arr($options_col, $values_col,"column","","Any","") . "&nbsp;&nbsp;&nbsp;";
		?>        
   		<strong>Keyword:</strong>&nbsp;&nbsp;<input type="text" name="search_keyword" id="search_keyword">
		<input class="button-search" type="button" value="Search" id="btn_customsearch">
  	    <input class="button-search" type="button" name="btn_reset" id="btn_reset" value="Clear" />
        </p>        
  </form>
</div>
<div class="clr"></div>

<?php echo $helper->init_grid($grid_id); ?>

<script type="text/javascript">
	$("#<?php echo $grid_id; ?>").flexigrid
	({
		url: '<?php echo PATH_COMPONENTS.$page_name; ?>-list.php',
		dataType: 'json',
		colModel : 
			[			
			{display: 'Action', width : <?php echo $config['grid']['3action']?>, align: 'center'},
			{display: 'Last Name', name : 'lastname', width : 160, sortable : true, align: 'left'},
			{display: 'First Name', name : 'firstname', width : 160, sortable : true, align: 'left'},
			{display: 'Username', name : 'username', width : 200, sortable : true, align: 'left'},
			{display: 'Active', name : 'is_active', width : 60, sortable : true, align: 'center'}
			],
		buttons : 
			[
			{name: 'Add', bclass: 'add', onpress : buttonAction},
			{name: 'Edit', bclass: 'edit', onpress : buttonAction},
			{name: 'Delete', bclass: 'delete', onpress : buttonAction},
			{name: 'View', bclass: 'view', onpress : buttonAction},
			{separator: true},
			{name: 'Select All', bclass: 'selectall', onpress : buttonAction},
			{name: 'Deselect All', bclass: 'deselectall', onpress : buttonAction},				
			{separator: true}
			],
		sortname: "<?php echo $fg_admins['sortname']?>",
		sortorder: "<?php echo $fg_admins['sortorder']?>",
		usepager: true,
		title: '<?php echo $page_heading; ?>',
		useRp: true,
		rp: <?php echo $fg_admins['rp']?>,
		rpOptions: <?php echo $fg_admins['rpOptions']?>,
		showTableToggleBtn: <?php echo $fg_admins['showTableToggleBtn']?>,
		width: '<?php echo $fg_admins['width']?>',
		height: <?php echo $fg_admins['height']?>,
		resizable: <?php echo $fg_admins['resizable']?>,
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
						url: "<?php echo PATH_COMPONENTS; ?>delete.php?tn=<?php echo urlencode($crypt->encrypt('administrators'))?>&fn=<?php echo urlencode($crypt->encrypt('administrator_id'))?>",
						data: "items="+itemlist,
						success: function(data) {
							if ( data.total_records > 0 ) {
								$('#system-message').hide();
								$('.system-message').fadeOut(1000);
								$('#del-result').html(data.result);							
								$('.system-message').fadeIn(1000).css({ display:"block" });
							}
							$("#<?php echo $grid_id; ?>").flexReload();
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
