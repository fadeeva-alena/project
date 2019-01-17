<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
<HEAD>
    <SCRIPT SRC="libdetect.js"></SCRIPT>
    <SCRIPT SRC="libslider.js"></SCRIPT>
    <SCRIPT SRC="slider.js"></SCRIPT>
</HEAD>
<?php 
$SCALE=$_GET['SCALE'];
if ($SCALE > 5 )
{
$SCALE = 5 ;
}
?>
    <BODY onclick=Javascript:slider_set_value(window.sliders[9]) onload=Javascript:slider_set_value(window.sliders[9])>
<?PHP


	ECHO"<SCRIPT>";
                         echo"window.sliders[9].start_tick =$SCALE - 1;";
	    echo"slider_render(window.sliders[9]);";
                   
	echo"</SCRIPT>";
?>

     <form ID="form1">
     <input type="hidden" ID="slider1"> 




    </form>

    </BODY>
</HTML>
