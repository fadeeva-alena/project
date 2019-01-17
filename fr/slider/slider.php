<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
<HEAD>
    <SCRIPT SRC="libdetect.js"></SCRIPT>
    <SCRIPT SRC="libslider.js"></SCRIPT>
    <SCRIPT SRC="slider.js"></SCRIPT>
</HEAD>
    <BODY>
<?PHP

$SCALE=$_GET['SCALE'];
if ($SCALE > 5 )
{
$SCALE = 5 ;
}
	ECHO"<SCRIPT>";
	    echo"slider_render(window.sliders[$SCALE-1]);";
	echo"</SCRIPT>";
?>
    </BODY>
</HTML>
