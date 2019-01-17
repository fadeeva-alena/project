<?php
$grid_id = $page_name;
$target_url = INDEX_PAGE.$page_option.'-m&mode=';
?>
<h1><?php echo $page_heading?></h1>
<?php if ( isset($_GET['a']) && $_GET['a'] != '' ) { ?>
<div id="system-message">
    <div class="info">
        <div class="message"><?php echo $helper->operation_msg($_GET['a'], $_GET['success'], "Member")?></div>
    </div>
</div>
<?php } ?>

<?php require(PATH_TEMPLATES.'delete-msg-box.php'); ?>

<!-- Custom Search - Start -->
<div id="custom-search-form" class="align-right">
	<form id="frm_customsearch">
    	<p><a href="<?php echo INDEX_PAGE.$page_option; ?>">Default Listing</a></p>    
  </form>
</div>
<div class="clr"></div>

<?php echo $helper->init_grid($grid_id)?>

<script type="text/javascript">
	$("#<?php echo $grid_id?>").flexigrid
	({
		url: '<?php echo PATH_COMPONENTS.$page_name?>-list.php',
		dataType: 'json',
		colModel : 
			[			
			//{display: 'Action', width : <?php echo $config['grid']['3action'];?>, align: 'center'},
			{display: 'User Name', name : 'username', width : 120, sortable : true, align: 'left'},
			{display: 'Last Name', name : 'lastname', width : 110, sortable : true, align: 'left'},
			{display: 'First Name', name : 'firstname', width : 110, sortable : true, align: 'left'},
			{display: 'Email Address', name : 'email_address', width : 150, sortable : true, align: 'left'},
			{display: 'Birth Date', name : 'birthdate', width : 80, sortable : true, align: 'left'},
			{display: 'Address', name : 'address', width : 130, sortable : true, align: 'left'},
			{display: 'Zip Code', name : 'zipcode', width : 70, sortable : true, align: 'left'},
			{display: 'Status', name : 'is_activated', width : 70, sortable : true, align: 'center'}
			],
		buttons : 
			[
			{name: 'Activate', bclass: 'edit', onpress : buttonAction},
			{name: 'Suspend', bclass: 'edit', onpress : buttonAction},
			{name: 'Delete', bclass: 'delete', onpress : buttonAction},
			{separator: true},
			{name: 'Select All', bclass: 'selectall', onpress : buttonAction},
			{name: 'Deselect All', bclass: 'deselectall', onpress : buttonAction},				
			{separator: true}
			],
		sortname: "<?php echo $fg_members['sortname']?>",
		sortorder: "<?php echo $fg_members['sortorder']?>",
		usepager: true,
		title: '<?php echo $page_heading?>',
		useRp: true,
		rp: <?php echo $fg_members['rp']?>,
		rpOptions: <?php echo $fg_members['rpOptions']?>,
		showTableToggleBtn: <?php echo $fg_members['showTableToggleBtn']?>,
		width: '<?php echo $fg_members['width']?>',
		height: <?php echo $fg_members['height']?>,
		resizable: <?php echo $fg_members['resizable']?>,
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
				if(confirm('Delete ' + $('.trSelected',grid).length + ' member(s)?'))
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
						url: "<?php echo PATH_COMPONENTS?>delete.php?tn=<?php echo urlencode($crypt->encrypt('members'))?>&fn=<?php echo urlencode($crypt->encrypt('member_id'))?>",
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
		else if (com=='Suspend')
		{
			if($('.trSelected',grid).length>0)
			{
				if(confirm('Suspend ' + $('.trSelected',grid).length + ' member(s)?'))
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
						url: "<?php echo PATH_COMPONENTS?>suspend.php?tn=<?php echo urlencode($crypt->encrypt('members'))?>&fn=<?php echo urlencode($crypt->encrypt('member_id'))?>",
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
		else if (com=='Activate')
		{
			if($('.trSelected',grid).length>0)
			{
				if(confirm('Activate ' + $('.trSelected',grid).length + ' member(s)?'))
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
						url: "<?php echo PATH_COMPONENTS?>activate.php?tn=<?php echo urlencode($crypt->encrypt('members'))?>&fn=<?php echo urlencode($crypt->encrypt('member_id'))?>",
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
