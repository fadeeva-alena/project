//superfish
$(document).ready(function(){
	// Tabs
	$('#tabs').tabs();
	
	//hover states on the static widgets
	$('#dialog_link, ul#icons li').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);
});


//used to apply alternating row styles
$(document).ready(function() {
  alternateRows('tbody tr:odd td', 'odd');
});
function alternateRows(selector, className)
{
  $(selector).removeClass(className).addClass(className);
}
