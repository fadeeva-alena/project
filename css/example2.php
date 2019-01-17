<?php
   //==== NOTE ==============================================================
   // Set your Google Maps API key below !
   //
   // Phoogle Maps 2.0 class needed
   // (available @ http://www.phpclasses.org/browse/package/2602.html
   //========================================================================

   include("phoogle.php");

   include("geocode.class.php");
?>
<!-- your Google key -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <title>Geocode class test</title>
      <script src="http://maps.google.com/maps?file=api&v=1&key=<!-- your Google Maps API key -->" type="text/javascript"></script>
   </head>
   <body>
      <H1>Geocode class test</H1>
      <FORM method="POST">
      <TABLE border="1" cellpadding="3" cellspacing="2">
         <TR>
            <TD>Location:</TD>
            <TD><INPUT type="text" name="location" size="100" value="<?php echo $location; ?>" /></TD>
         </TR>
         <TR>
            <TD>Address:</TD>
            <TD><INPUT type="text" name="address" size="100" value="<?php echo $address; ?>" /></TD>
         </TR>
         <TR>
            <TD>City:</TD>
            <TD><INPUT type="text" name="city" size="100" value="<?php echo $city; ?>" /></TD>
         </TR>
         <TR>
            <TD>Country:</TD>
            <TD><INPUT type="text" name="country" size="100" value="<?php echo $country; ?>" /></TD>
         </TR>
         <TR>
            <TD>State:</TD>
            <TD><INPUT type="text" name="state" size="100" value="<?php echo $state; ?>" /></TD>
         </TR>
         <TR>
            <TD>Zip:</TD>
            <TD><INPUT type="text" name="zip" size="100" value="<?php echo $zip; ?>" /></TD>
         </TR>
         <TR>
            <TD>Zoom level:</TD>
            <TD><INPUT type="text" name="level" size="100" value="<?php echo $level; ?>" /></TD>
         </TR>
         <TR>
            <TD align="right" colspan="2"><INPUT type="submit" name="Seek" value="Seek" /></TD>
         </TR>
      </TABLE>
      </FORM>
      <?php
      if( $Seek ) {
         $tmp = new geocode( $location, $address, $city, $country, $state, $zip );
         $coord = $tmp->locate();
         if( $coord["error"] ) {
            echo "<PRE>" . $coord["error"] . "</PRE>";
         } else {
            $map = new PhoogleMap();
            $map->zoomLevel = $level ? $level : 4;
            $map->controlType ='large';
            $map->centerMap( $coord["latitude"], $coord["longitude"] );
            $map->setWidth( 500 );
            $map->setHeight( 500 );
            $map->addGeoPoint( $coord["latitude"], $coord["longitude"], $coord["query"] );
            $map->showMap();
         }
      }
      ?>
   </body>
</html>